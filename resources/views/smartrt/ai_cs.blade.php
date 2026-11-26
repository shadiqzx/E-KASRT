@extends('layouts.app')

@section('title', 'AI Customer Service E-KASRT')

@section('content')
<style>
.ai-hero {
    background: linear-gradient(135deg, #0f172a 0%, #0284c7 55%, #0ea5e9 100%);
    border-radius: 24px;
    padding: 30px 34px;
    color: #ffffff;
    box-shadow: 0 20px 45px -12px rgba(2, 132, 199, 0.4);
    margin-bottom: 24px;
    position: relative;
    overflow: hidden;
}
.ai-bento-card {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid #eef2f6;
    padding: 20px 24px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
    height: 100%;
}
.badge-intent {
    padding: 5px 10px;
    border-radius: 14px;
    font-size: 11px;
    font-weight: 700;
    background: #e0f2fe;
    color: #0369a1;
}
</style>

<div class="ai-hero">
    <div class="d-flex flex-wrap justify-content-between align-items-center" style="gap: 18px;">
        <div>
            <div class="d-flex align-items-center mb-2" style="gap: 8px;">
                <span class="badge badge-light px-3 py-1 font-weight-bold text-primary" style="border-radius: 20px; font-size: 11px;">
                    <i class="fas fa-robot mr-1"></i> ASISTEN VIRTUAL 24/7
                </span>
                @if(!empty($settings['gemini_api_key']))
                    <span class="badge badge-success px-3 py-1 font-weight-bold" style="border-radius: 20px; font-size: 11px;">
                        <i class="fas fa-bolt mr-1"></i> MODE: GEMINI AI + LIVE DB
                    </span>
                @else
                    <span class="badge px-3 py-1 font-weight-bold" style="border-radius: 20px; font-size: 11px; background: rgba(255,255,255,0.2); color: #fff;">
                        <i class="fas fa-brain mr-1"></i> MODE: SMART E-KASRT NLP + LIVE DB
                    </span>
                @endif
            </div>
            <h2 class="font-weight-bold text-white mb-1">AI Customer Service Website E-KASRT</h2>
            <p class="mb-0 text-white-50" style="font-size: 14px; max-width: 660px;">
                Pantau pertanyaan warga secara real-time, kelola sambutan &amp; kontak eskalasi RT, serta hubungkan API Key Google Gemini (opsional) untuk jawaban generatif lanjutan.
            </p>
        </div>
        <div class="d-flex flex-wrap" style="gap: 10px;">
            <button type="button" class="btn btn-light font-weight-bold text-primary px-3 py-2 shadow-sm" style="border-radius: 12px;" onclick="if(window.KasCsWidget) window.KasCsWidget.open();">
                <i class="fas fa-comments mr-1"></i> Uji Chat AI Sekarang
            </button>
        </div>
    </div>
</div>

{{-- KPI CARDS --}}
<div class="row mb-4">
    <div class="col-md-4 mb-3 mb-md-0">
        <div class="ai-bento-card" style="border-left: 4px solid #0284c7;">
            <small class="text-muted text-uppercase font-weight-bold" style="font-size: 11.5px;">Total Percakapan Tersimpan</small>
            <h3 class="font-weight-bold text-dark mt-1 mb-0">{{ number_format($totalChats, 0, ',', '.') }}</h3>
            <small class="text-muted">Pertanyaan warga &amp; pengunjung portal</small>
        </div>
    </div>
    <div class="col-md-4 mb-3 mb-md-0">
        <div class="ai-bento-card" style="border-left: 4px solid #10b981;">
            <small class="text-muted text-uppercase font-weight-bold" style="font-size: 11.5px;">Pertanyaan Hari Ini</small>
            <h3 class="font-weight-bold text-success mt-1 mb-0">{{ number_format($todayChats, 0, ',', '.') }}</h3>
            <small class="text-muted">Status Widget: {{ $settings['is_enabled'] ? '🟢 Aktif' : '🔴 Nonaktif' }}</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="ai-bento-card" style="border-left: 4px solid #8b5cf6;">
            <small class="text-muted text-uppercase font-weight-bold" style="font-size: 11.5px;">Topik Terpopuler</small>
            <div class="mt-2 d-flex flex-wrap" style="gap: 6px;">
                @forelse($topIntents as $ti)
                    <span class="badge-intent">{{ $ti->detected_intent }} ({{ $ti->total }})</span>
                @empty
                    <span class="text-muted" style="font-size: 13px;">Belum ada data percakapan</span>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- KOLOM KIRI: KONFIGURASI AI CS --}}
    <div class="col-lg-5 mb-4">
        <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <h5 class="font-weight-bold text-dark mb-0">
                    <i class="fas fa-sliders-h text-primary mr-2"></i> Pengaturan Asisten AI CS
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('smartrt.ai_cs.settings') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark" style="font-size: 13px;">Status Layanan Widget Chat</label>
                        <div class="custom-control custom-switch mt-1">
                            <input type="checkbox" class="custom-control-input" id="isEnabledSwitch" name="is_enabled" value="1" {{ $settings['is_enabled'] ? 'checked' : '' }}>
                            <label class="custom-control-label font-weight-bold text-dark" for="isEnabledSwitch">Aktifkan Widget AI Customer Service di Website</label>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark" style="font-size: 13px;">Nama Bot / Asisten Virtual</label>
                        <input type="text" name="bot_name" class="form-control" value="{{ $settings['bot_name'] }}" required style="border-radius: 10px;">
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark" style="font-size: 13px;">Pesan Sambutan Awal</label>
                        <textarea name="welcome_message" rows="3" class="form-control" required style="border-radius: 10px; font-size: 13px;">{{ $settings['welcome_message'] }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark" style="font-size: 13px;">No. WhatsApp Pengurus (Eskalasi Manual)</label>
                        <input type="text" name="whatsapp_cs" class="form-control" value="{{ $settings['whatsapp_cs'] }}" placeholder="Contoh: 081234567890" style="border-radius: 10px;">
                    </div>

                    <hr>

                    <div class="alert alert-info border-0 mb-3" style="border-radius: 12px; font-size: 12.5px; background: #f0f9ff; color: #0369a1;">
                        <strong><i class="fas fa-info-circle mr-1"></i> Mode Hybrid Otomatis:</strong>
                        Tanpa API Key, mesin <strong>Smart E-KASRT NLP + Live Database</strong> tetap menjawab otomatis 24/7. Isi API Key Google Gemini di bawah jika ingin mengaktifkan respon AI generatif penuh.
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark" style="font-size: 13px;">
                            Google Gemini API Key (Opsional)
                            @if(!empty($settingRow?->gemini_api_key))
                                <span class="badge badge-success ml-1">Tersimpan</span>
                            @endif
                        </label>
                        <input type="password" name="gemini_api_key" class="form-control" placeholder="{{ !empty($settingRow?->gemini_api_key) ? '•••••••• (kosongkan jika tidak diubah)' : 'AIzaSy...' }}" style="border-radius: 10px;">
                        @if(!empty($settingRow?->gemini_api_key))
                            <div class="custom-control custom-checkbox mt-2">
                                <input type="checkbox" class="custom-control-input" id="clearApiKey" name="clear_api_key" value="1">
                                <label class="custom-control-label text-danger" for="clearApiKey" style="font-size: 12px;">Hapus API Key tersimpan (kembali ke mode Smart NLP)</label>
                            </div>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark" style="font-size: 13px;">Model Gemini</label>
                        <select name="gemini_model" class="form-control" style="border-radius: 10px;">
                            <option value="gemini-2.5-flash" {{ ($settings['gemini_model'] ?? '') === 'gemini-2.5-flash' ? 'selected' : '' }}>gemini-2.5-flash (Cepat &amp; Hemat)</option>
                            <option value="gemini-2.5-pro" {{ ($settings['gemini_model'] ?? '') === 'gemini-2.5-pro' ? 'selected' : '' }}>gemini-2.5-pro (Penalaran Tinggi)</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-dark" style="font-size: 13px;">Instruksi Khusus Tambahan (Khusus Mode Gemini)</label>
                        <textarea name="system_prompt" rows="2" class="form-control" placeholder="Contoh: Jadwal kerja bakti setiap Minggu pagi jam 07:00 WIB..." style="border-radius: 10px; font-size: 13px;">{{ $settings['system_prompt'] }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block font-weight-bold py-2 shadow-sm" style="border-radius: 12px;">
                        <i class="fas fa-save mr-1"></i> Simpan Pengaturan AI CS
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- KOLOM KANAN: LOG PERCAKAPAN WARGA --}}
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header bg-white border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="font-weight-bold text-dark mb-0">
                    <i class="fas fa-history text-info mr-2"></i> Riwayat Tanya-Jawab Warga
                </h5>
                @if($totalChats > 0)
                    <form action="{{ route('smartrt.ai_cs.clear_logs') }}" method="POST" onsubmit="return confirm('Bersihkan seluruh riwayat percakapan AI CS?');">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger font-weight-bold" style="border-radius: 8px;">
                            <i class="fas fa-trash-alt mr-1"></i> Bersihkan Log
                        </button>
                    </form>
                @endif
            </div>
            <div class="table-responsive" style="max-height: 620px; overflow-y: auto;">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Waktu &amp; Pengirim</th>
                            <th>Pertanyaan Warga</th>
                            <th>Jawaban AI</th>
                            <th>Topik</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                        <tr>
                            <td style="min-width: 135px;">
                                <strong class="text-dark d-block" style="font-size: 13px;">{{ $log->sender_name ?: 'Tamu' }}</strong>
                                <small class="text-muted">{{ date('d M H:i', strtotime($log->created_at)) }}</small>
                            </td>
                            <td style="font-size: 13px; max-width: 200px;">{{ \Illuminate\Support\Str::limit($log->user_message, 120) }}</td>
                            <td style="font-size: 12.5px; color: #475569; max-width: 240px;">{{ \Illuminate\Support\Str::limit(strip_tags($log->bot_reply), 140) }}</td>
                            <td>
                                <span class="badge-intent d-inline-block mb-1">{{ $log->detected_intent }}</span>
                                <small class="d-block text-muted" style="font-size: 10.5px;">{{ $log->engine_used }}</small>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="fas fa-robot fa-3x mb-3" style="opacity: 0.25;"></i>
                                <h6>Belum Ada Riwayat Percakapan</h6>
                                <p style="font-size: 13px;">Klik tombol <strong>Uji Chat AI Sekarang</strong> atau ajukan pertanyaan lewat tombol CS di pojok kanan bawah.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

