<?php

namespace App\Http\Controllers;

use App\Models\AiChatLog;
use App\Models\AiSetting;
use App\Services\AiCustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AiCsController extends Controller
{
    public function __construct(private readonly AiCustomerService $aiService)
    {
    }

    /**
     * Handle chat pesan masuk dari Floating AI Customer Service Widget atau API.
     */
    public function chat(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:600',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Pesan tidak boleh kosong (maksimal 600 karakter).',
            ], 422);
        }

        $settings = $this->aiService->getSettings();
        if (!$settings['is_enabled']) {
            $waHint = !empty($settings['whatsapp_cs'])
                ? " Silakan hubungi WhatsApp Pengurus RT di {$settings['whatsapp_cs']}."
                : ' Silakan hubungi Pengurus RT secara langsung.';

            return response()->json([
                'success'     => true,
                'reply'       => "Maaf, layanan Asisten AI Customer Service sedang dalam pemeliharaan sementara.{$waHint}",
                'intent'      => 'maintenance',
                'engine'      => 'disabled',
                'suggestions' => [],
                'actions'     => [],
                'time'        => date('H:i'),
            ]);
        }

        $message = trim((string) $request->input('message'));
        $sessionId = $request->hasSession() ? $request->session()->getId() : ('api-' . md5($request->ip() ?? 'guest'));
        $history = $request->hasSession() ? (array) $request->session()->get('ai_cs_history', []) : [];
        $lastIntent = $request->hasSession() ? $request->session()->get('ai_cs_last_intent') : null;

        $result = $this->aiService->answer(
            $message,
            $sessionId,
            Auth::user(),
            $history,
            $lastIntent
        );

        $timeText = date('H:i');

        if ($request->hasSession()) {
            $history[] = [
                'user'        => $message,
                'bot'         => $result['reply'],
                'time'        => $timeText,
                'intent'      => $result['intent'],
                'suggestions' => $result['suggestions'],
                'actions'     => $result['actions'],
            ];
            if (count($history) > 15) {
                $history = array_slice($history, -15);
            }
            $request->session()->put('ai_cs_history', $history);
            $request->session()->put('ai_cs_last_intent', $result['intent']);
        }

        return response()->json([
            'success'     => true,
            'reply'       => $result['reply'],
            'intent'      => $result['intent'],
            'engine'      => $result['engine'],
            'suggestions' => $result['suggestions'],
            'actions'     => $result['actions'],
            'time'        => $timeText,
        ]);
    }

    /**
     * Ambil riwayat chat sesi & info konfigurasi bot untuk inisialisasi widget.
     */
    public function history(Request $request): JsonResponse
    {
        $settings = $this->aiService->getSettings();
        $messages = $request->hasSession() ? (array) $request->session()->get('ai_cs_history', []) : [];
        $isLoggedIn = Auth::check();

        $defaultSuggestions = $isLoggedIn
            ? ['Saldo Kas RT sekarang', 'Cek iuran saya', 'Jadwal Posyandu', 'Cara ajukan surat']
            : ['Saldo Kas RT sekarang', 'Cara daftar warga baru', 'Cek status pendaftaran', 'Cara bayar iuran'];

        return response()->json([
            'bot_name'            => $settings['bot_name'],
            'welcome_message'     => $settings['welcome_message'],
            'is_enabled'          => $settings['is_enabled'],
            'engine_mode'         => !empty($settings['gemini_api_key']) ? 'Gemini AI + Smart DB' : 'Smart E-KASRT NLP',
            'messages'            => $messages,
            'default_suggestions' => $defaultSuggestions,
        ]);
    }

    /**
     * Reset percakapan sesi pengguna di widget CS.
     */
    public function reset(Request $request): JsonResponse
    {
        if ($request->hasSession()) {
            $request->session()->forget(['ai_cs_history', 'ai_cs_last_intent']);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Halaman Admin / Pengurus RT untuk memantau riwayat tanya-jawab AI CS & konfigurasi.
     */
    public function index()
    {
        $settings = $this->aiService->getSettings();
        $settingRow = Schema::hasTable('ai_settings') ? AiSetting::first() : null;

        $logs = Schema::hasTable('ai_chat_logs')
            ? AiChatLog::orderBy('id', 'DESC')->limit(100)->get()
            : collect();

        $totalChats = Schema::hasTable('ai_chat_logs') ? AiChatLog::count() : 0;
        $todayChats = Schema::hasTable('ai_chat_logs')
            ? AiChatLog::whereDate('created_at', date('Y-m-d'))->count()
            : 0;

        $topIntents = Schema::hasTable('ai_chat_logs')
            ? AiChatLog::select('detected_intent', DB::raw('COUNT(*) as total'))
                ->groupBy('detected_intent')
                ->orderBy('total', 'DESC')
                ->limit(5)
                ->get()
            : collect();

        return view('smartrt.ai_cs', compact(
            'settings',
            'settingRow',
            'logs',
            'totalChats',
            'todayChats',
            'topIntents'
        ));
    }

    /**
     * Simpan pengaturan AI Customer Service oleh Admin/Pengurus RT.
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'bot_name'        => 'required|string|max:80',
            'welcome_message' => 'required|string|max:1000',
            'gemini_model'    => 'nullable|string|max:80',
            'whatsapp_cs'     => 'nullable|string|max:30',
            'system_prompt'   => 'nullable|string|max:2000',
            'gemini_api_key'  => 'nullable|string|max:255',
        ]);

        $row = AiSetting::first() ?: new AiSetting();
        $row->bot_name = $request->bot_name;
        $row->welcome_message = $request->welcome_message;
        $row->gemini_model = $request->gemini_model ?: 'gemini-2.5-flash';
        $row->whatsapp_cs = $request->whatsapp_cs;
        $row->system_prompt = $request->system_prompt;
        $row->is_enabled = $request->boolean('is_enabled');
        $row->updated_at = now();

        if ($request->boolean('clear_api_key')) {
            $row->gemini_api_key = null;
        } elseif (!empty(trim((string) $request->gemini_api_key))) {
            $row->gemini_api_key = trim((string) $request->gemini_api_key);
        }

        $row->save();

        return redirect()->route('smartrt.ai_cs')->with('success', 'Pengaturan AI Customer Service berhasil disimpan!');
    }

    /**
     * Bersihkan seluruh log percakapan AI Customer Service.
     */
    public function clearLogs()
    {
        if (Schema::hasTable('ai_chat_logs')) {
            AiChatLog::truncate();
        }

        return redirect()->route('smartrt.ai_cs')->with('success', 'Seluruh riwayat percakapan AI Customer Service berhasil dibersihkan.');
    }
}
