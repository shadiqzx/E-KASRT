@php
    $aiCsEnabled = true;
    $aiBotName = 'KasBot AI (CS E-KASRT)';
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('ai_settings')) {
            $aiCfg = \App\Models\AiSetting::first();
            if ($aiCfg) {
                $aiCsEnabled = (bool) $aiCfg->is_enabled;
                $aiBotName = $aiCfg->bot_name ?: $aiBotName;
            }
        }
    } catch (\Throwable $e) {
        $aiCsEnabled = true;
    }
@endphp

@if($aiCsEnabled)
<style>
#kas-ai-cs-root * {
    box-sizing: border-box;
    font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}
#kas-ai-cs-root {
    position: fixed;
    right: 22px;
    bottom: 22px;
    z-index: 9990;
}
.kas-cs-launcher {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #0f172a 0%, #0284c7 65%, #0ea5e9 100%);
    color: #ffffff;
    border: 1px solid rgba(56, 189, 248, 0.45);
    border-radius: 999px;
    padding: 11px 18px 11px 13px;
    box-shadow: 0 14px 32px rgba(2, 132, 199, 0.45), 0 0 0 1px rgba(255,255,255,0.08) inset;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    outline: none;
}
.kas-cs-launcher:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 36px rgba(2, 132, 199, 0.55);
}
.kas-cs-launcher-icon {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.16);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    position: relative;
}
.kas-cs-online-dot {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 9px;
    height: 9px;
    background: #10b981;
    border: 2px solid #0f172a;
    border-radius: 50%;
}
.kas-cs-launcher-text {
    text-align: left;
    line-height: 1.15;
}
.kas-cs-launcher-title {
    display: block;
    font-size: 13px;
    font-weight: 800;
    color: #ffffff;
}
.kas-cs-launcher-sub {
    display: block;
    font-size: 10.5px;
    font-weight: 600;
    color: #bae6fd;
}
.kas-cs-window {
    display: none;
    flex-direction: column;
    width: 385px;
    height: 550px;
    max-height: calc(100vh - 96px);
    background: #ffffff;
    border-radius: 22px;
    box-shadow: 0 24px 60px -12px rgba(15, 23, 42, 0.45), 0 0 0 1px rgba(148, 163, 184, 0.25);
    overflow: hidden;
    margin-bottom: 12px;
    animation: kasCsPop 0.22s cubic-bezier(0.22, 1, 0.36, 1);
}
.kas-cs-window.open {
    display: flex;
}
@keyframes kasCsPop {
    from { opacity: 0; transform: translateY(14px) scale(0.96); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}
.kas-cs-header {
    background: linear-gradient(135deg, #0b1329 0%, #0369a1 70%, #0284c7 100%);
    color: #ffffff;
    padding: 15px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-shrink: 0;
}
.kas-cs-header-left {
    display: flex;
    align-items: center;
    gap: 11px;
}
.kas-cs-avatar {
    width: 38px;
    height: 38px;
    border-radius: 12px;
    background: rgba(56, 189, 248, 0.2);
    border: 1px solid rgba(255,255,255,0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: #ffffff;
}
.kas-cs-header-title {
    font-size: 14.5px;
    font-weight: 800;
    margin: 0;
    color: #ffffff;
}
.kas-cs-header-sub {
    font-size: 11px;
    color: #bae6fd;
    display: flex;
    align-items: center;
    gap: 5px;
}
.kas-cs-header-actions {
    display: flex;
    align-items: center;
    gap: 6px;
}
.kas-cs-icon-btn {
    background: rgba(255, 255, 255, 0.14);
    border: none;
    color: #ffffff;
    width: 30px;
    height: 30px;
    border-radius: 9px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    transition: background 0.15s;
}
.kas-cs-icon-btn:hover {
    background: rgba(255, 255, 255, 0.26);
}
.kas-cs-messages {
    flex: 1;
    padding: 16px;
    overflow-y: auto;
    background: #f8fafc;
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.kas-cs-msg {
    display: flex;
    flex-direction: column;
    max-width: 88%;
}
.kas-cs-msg.bot {
    align-self: flex-start;
}
.kas-cs-msg.user {
    align-self: flex-end;
    align-items: flex-end;
}
.kas-cs-bubble {
    padding: 11px 14px;
    border-radius: 16px;
    font-size: 13px;
    line-height: 1.5;
    word-wrap: break-word;
}
.kas-cs-msg.bot .kas-cs-bubble {
    background: #ffffff;
    color: #1e293b;
    border: 1px solid #e2e8f0;
    border-top-left-radius: 4px;
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
}
.kas-cs-msg.user .kas-cs-bubble {
    background: linear-gradient(135deg, #0284c7, #2563eb);
    color: #ffffff;
    border-top-right-radius: 4px;
    box-shadow: 0 4px 12px rgba(2, 132, 199, 0.25);
}
.kas-cs-bubble code {
    background: #f1f5f9;
    color: #0369a1;
    padding: 1px 5px;
    border-radius: 5px;
    font-family: 'JetBrains Mono', monospace;
    font-size: 11.5px;
}
.kas-cs-time {
    font-size: 10px;
    color: #94a3b8;
    margin-top: 4px;
}
.kas-cs-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-top: 8px;
}
.kas-cs-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 11px;
    background: #eff6ff;
    color: #1d4ed8 !important;
    border: 1px solid #bfdbfe;
    border-radius: 10px;
    font-size: 11.5px;
    font-weight: 700;
    text-decoration: none !important;
    transition: all 0.15s;
}
.kas-cs-action-btn:hover {
    background: #dbeafe;
}
.kas-cs-suggestions {
    padding: 8px 14px;
    background: #ffffff;
    border-top: 1px solid #f1f5f9;
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    gap: 6px;
    flex-shrink: 0;
}
.kas-cs-suggestions::-webkit-scrollbar {
    height: 4px;
}
.kas-cs-chip {
    white-space: nowrap;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    color: #0f172a;
    border-radius: 999px;
    padding: 5px 11px;
    font-size: 11.5px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.15s;
}
.kas-cs-chip:hover {
    background: #e0f2fe;
    border-color: #38bdf8;
    color: #0369a1;
}
.kas-cs-input-area {
    padding: 10px 12px;
    background: #ffffff;
    border-top: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
}
.kas-cs-input {
    flex: 1;
    border: 1.5px solid #e2e8f0;
    border-radius: 12px;
    padding: 9px 12px;
    font-size: 13px;
    color: #0f172a;
    background: #f8fafc;
    outline: none;
    transition: border-color 0.15s;
}
.kas-cs-input:focus {
    border-color: #0284c7;
    background: #ffffff;
}
.kas-cs-send {
    width: 38px;
    height: 38px;
    border-radius: 12px;
    border: none;
    background: linear-gradient(135deg, #0284c7, #2563eb);
    color: #ffffff;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
}
.kas-cs-send:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}
.kas-cs-typing {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 2px;
}
.kas-cs-typing span {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #94a3b8;
    animation: kasCsBounce 1.1s infinite ease-in-out;
}
.kas-cs-typing span:nth-child(2) { animation-delay: 0.15s; }
.kas-cs-typing span:nth-child(3) { animation-delay: 0.3s; }
@keyframes kasCsBounce {
    0%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-5px); }
}
@media (max-width: 576px) {
    #kas-ai-cs-root {
        right: 14px;
        bottom: 14px;
    }
    .kas-cs-window {
        width: calc(100vw - 28px);
        height: 72vh;
    }
}
</style>

<div id="kas-ai-cs-root">
    <div class="kas-cs-window" id="kasCsWindow" role="dialog" aria-label="AI Customer Service E-KASRT">
        <div class="kas-cs-header">
            <div class="kas-cs-header-left">
                <div class="kas-cs-avatar">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="3" y="8" width="18" height="12" rx="4"/>
                        <path d="M12 2v4"/><circle cx="12" cy="2" r="1.2" fill="currentColor"/>
                        <circle cx="9" cy="14" r="1.4" fill="currentColor"/>
                        <circle cx="15" cy="14" r="1.4" fill="currentColor"/>
                    </svg>
                </div>
                <div>
                    <h4 class="kas-cs-header-title" id="kasCsBotTitle">{{ $aiBotName }}</h4>
                    <div class="kas-cs-header-sub">
                        <span style="width:7px;height:7px;background:#34d399;border-radius:50%;display:inline-block;"></span>
                        <span id="kasCsEngineLabel">Customer Service E-KASRT &bull; Online</span>
                    </div>
                </div>
            </div>
            <div class="kas-cs-header-actions">
                <button type="button" class="kas-cs-icon-btn" onclick="window.KasCsWidget.reset()" title="Mulai Percakapan Baru">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M21 12a9 9 0 1 1-9-9c2.52 0 4.93 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/>
                    </svg>
                </button>
                <button type="button" class="kas-cs-icon-btn" onclick="window.KasCsWidget.close()" title="Tutup Chat">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="kas-cs-messages" id="kasCsMessages"></div>

        <div class="kas-cs-suggestions" id="kasCsSuggestions"></div>

        <form class="kas-cs-input-area" onsubmit="window.KasCsWidget.sendFromForm(event)">
            <input type="text" id="kasCsInput" class="kas-cs-input" placeholder="Tulis pertanyaan Anda..." maxlength="600" autocomplete="off">
            <button type="submit" id="kasCsSendBtn" class="kas-cs-send" title="Kirim Pesan">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
            </button>
        </form>
    </div>

    <div style="display: flex; justify-content: flex-end;">
        <button type="button" class="kas-cs-launcher" id="kasCsLauncherBtn" onclick="window.KasCsWidget.toggle()">
            <span class="kas-cs-launcher-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M3 18v-6a9 9 0 0 1 18 0v6"/>
                    <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>
                </svg>
                <span class="kas-cs-online-dot"></span>
            </span>
            <span class="kas-cs-launcher-text">
                <span class="kas-cs-launcher-title">Tanya CS AI</span>
                <span class="kas-cs-launcher-sub">Layanan E-KASRT 24/7</span>
            </span>
        </button>
    </div>
</div>

<script>
(function() {
    if (window.KasCsWidget) return;

    const chatUrl    = "{{ route('ai_cs.chat') }}";
    const historyUrl = "{{ route('ai_cs.history') }}";
    const resetUrl   = "{{ route('ai_cs.reset') }}";
    let csrfToken    = "{{ csrf_token() }}";
    const metaCsrf   = document.querySelector('meta[name="csrf-token"]');
    if (metaCsrf && metaCsrf.content) csrfToken = metaCsrf.content;

    let isOpen = false;
    let isLoaded = false;
    let isBusy = false;

    const winEl  = document.getElementById('kasCsWindow');
    const msgsEl = document.getElementById('kasCsMessages');
    const sugEl  = document.getElementById('kasCsSuggestions');
    const inpEl  = document.getElementById('kasCsInput');
    const btnEl  = document.getElementById('kasCsSendBtn');
    const titleEl = document.getElementById('kasCsBotTitle');
    const engEl  = document.getElementById('kasCsEngineLabel');

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = String(text || '');
        return div.innerHTML;
    }

    function formatMarkdownSafe(raw) {
        let s = escapeHtml(raw);
        s = s.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>');
        s = s.replace(/\*(.+?)\*/g, '<em>$1</em>');
        s = s.replace(/`([^`]+)`/g, '<code>$1</code>');
        s = s.replace(/\n/g, '<br>');
        return s;
    }

    function appendMessage(role, text, timeText, actions) {
        const wrap = document.createElement('div');
        wrap.className = 'kas-cs-msg ' + role;

        const bubble = document.createElement('div');
        bubble.className = 'kas-cs-bubble';
        bubble.innerHTML = role === 'bot' ? formatMarkdownSafe(text) : escapeHtml(text);

        if (role === 'bot' && Array.isArray(actions) && actions.length > 0) {
            const actRow = document.createElement('div');
            actRow.className = 'kas-cs-actions';
            actions.forEach(a => {
                const link = document.createElement('a');
                link.className = 'kas-cs-action-btn';
                link.href = a.url;
                link.textContent = a.label;
                actRow.appendChild(link);
            });
            bubble.appendChild(actRow);
        }

        const time = document.createElement('div');
        time.className = 'kas-cs-time';
        time.textContent = timeText || new Date().toTimeString().substring(0, 5);

        wrap.appendChild(bubble);
        wrap.appendChild(time);
        msgsEl.appendChild(wrap);
        msgsEl.scrollTop = msgsEl.scrollHeight;
    }

    function renderSuggestions(list) {
        sugEl.innerHTML = '';
        if (!Array.isArray(list)) return;
        list.forEach(label => {
            const chip = document.createElement('button');
            chip.type = 'button';
            chip.className = 'kas-cs-chip';
            chip.textContent = label;
            chip.onclick = () => sendText(label);
            sugEl.appendChild(chip);
        });
    }

    function showTyping() {
        const wrap = document.createElement('div');
        wrap.className = 'kas-cs-msg bot';
        wrap.id = 'kasCsTypingRow';
        wrap.innerHTML = '<div class="kas-cs-bubble"><div class="kas-cs-typing"><span></span><span></span><span></span></div></div>';
        msgsEl.appendChild(wrap);
        msgsEl.scrollTop = msgsEl.scrollHeight;
    }

    function hideTyping() {
        const row = document.getElementById('kasCsTypingRow');
        if (row) row.remove();
    }

    function loadHistory() {
        fetch(historyUrl, { headers: { 'Accept': 'application/json' } })
            .then(r => r.json())
            .then(data => {
                isLoaded = true;
                if (data.bot_name && titleEl) titleEl.textContent = data.bot_name;
                if (data.engine_mode && engEl) engEl.textContent = data.engine_mode + ' • Online';

                msgsEl.innerHTML = '';
                appendMessage('bot', data.welcome_message || 'Halo! Ada yang bisa dibantu?', 'Online', []);

                let lastSuggestions = data.default_suggestions || [];
                if (Array.isArray(data.messages)) {
                    data.messages.forEach(m => {
                        if (m.user) appendMessage('user', m.user, m.time);
                        if (m.bot) appendMessage('bot', m.bot, m.time, m.actions || []);
                        if (Array.isArray(m.suggestions) && m.suggestions.length > 0) {
                            lastSuggestions = m.suggestions;
                        }
                    });
                }
                renderSuggestions(lastSuggestions);
            })
            .catch(() => {
                isLoaded = true;
                msgsEl.innerHTML = '';
                appendMessage('bot', 'Halo! Saya Asisten Virtual E-KASRT. Silakan ketik pertanyaan Anda.', 'Online', []);
            });
    }

    function sendText(text) {
        const clean = String(text || '').trim();
        if (!clean || isBusy) return;

        isBusy = true;
        btnEl.disabled = true;
        appendMessage('user', clean);
        inpEl.value = '';
        showTyping();

        fetch(chatUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ message: clean })
        })
        .then(async res => {
            if (res.status === 419) {
                throw new Error('SESSION_EXPIRED');
            }
            return res.json();
        })
        .then(data => {
            hideTyping();
            if (data.success) {
                appendMessage('bot', data.reply, data.time, data.actions || []);
                renderSuggestions(data.suggestions || []);
            } else {
                appendMessage('bot', data.message || 'Maaf, pesan tidak dapat diproses saat ini.');
            }
        })
        .catch(err => {
            hideTyping();
            if (err && err.message === 'SESSION_EXPIRED') {
                appendMessage('bot', 'Sesi halaman telah habis. Memuat ulang sesi untuk Anda...');
                setTimeout(() => window.location.reload(), 1200);
            } else {
                appendMessage('bot', 'Koneksi terganggu. Silakan coba kirim ulang pertanyaan Anda.');
            }
        })
        .finally(() => {
            isBusy = false;
            btnEl.disabled = false;
            inpEl.focus();
        });
    }

    window.KasCsWidget = {
        open: function() {
            isOpen = true;
            winEl.classList.add('open');
            try { sessionStorage.setItem('kasrt_cs_open', '1'); } catch(e) {}
            if (!isLoaded) loadHistory();
            setTimeout(() => inpEl.focus(), 120);
        },
        close: function() {
            isOpen = false;
            winEl.classList.remove('open');
            try { sessionStorage.setItem('kasrt_cs_open', '0'); } catch(e) {}
        },
        toggle: function() {
            if (isOpen) this.close();
            else this.open();
        },
        reset: function() {
            fetch(resetUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            }).finally(() => {
                isLoaded = false;
                loadHistory();
            });
        },
        sendFromForm: function(e) {
            e.preventDefault();
            sendText(inpEl.value);
        }
    };

    try {
        if (sessionStorage.getItem('kasrt_cs_open') === '1') {
            window.KasCsWidget.open();
        }
    } catch(e) {}
})();
</script>
@endif

