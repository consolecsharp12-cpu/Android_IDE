<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>SharpPad — C# / Java IDE</title>
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Space+Grotesk:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  /* ── DARK theme (default) ── */
  :root {
    --bg:          #0c0e13;
    --surface:     #111318;
    --surface2:    #171a22;
    --surface3:    #1e2230;
    --surface4:    #252a3a;
    --border:      #252c3d;
    --border2:     #1c2130;
    --cyan:        #00d4ff;
    --cyan-dim:    rgba(0,212,255,0.12);
    --cyan-glow:   rgba(0,212,255,0.25);
    --amber:       #f5a623;
    --amber-dim:   rgba(245,166,35,0.12);
    --green:       #00e676;
    --green-dim:   rgba(0,230,118,0.12);
    --red:         #ff4569;
    --red-dim:     rgba(255,69,105,0.12);
    --purple:      #a855f7;
    --purple-dim:  rgba(168,85,247,0.12);
    --text:        #dde3f0;
    --text2:       #7a8499;
    --text3:       #3d4560;
    --text-inv:    #0c0e13;
    --font-mono:   'JetBrains Mono', monospace;
    --font-ui:     'Outfit', sans-serif;
  }

  /* ── WHITE / LIGHT theme ── */
  [data-theme="white"] {
    --bg:          #f0f2f7;
    --surface:     #ffffff;
    --surface2:    #f5f7fc;
    --surface3:    #e8ecf5;
    --surface4:    #d8deed;
    --border:      #cdd4e5;
    --border2:     #dde3ef;
    --cyan:        #0284c7;
    --cyan-dim:    rgba(2,132,199,0.10);
    --cyan-glow:   rgba(2,132,199,0.22);
    --amber:       #d97706;
    --amber-dim:   rgba(217,119,6,0.10);
    --green:       #16a34a;
    --green-dim:   rgba(22,163,74,0.10);
    --red:         #dc2626;
    --red-dim:     rgba(220,38,38,0.10);
    --purple:      #7c3aed;
    --purple-dim:  rgba(124,58,237,0.10);
    --text:        #1e293b;
    --text2:       #64748b;
    --text3:       #94a3b8;
    --text-inv:    #ffffff;
  }

  /* ── BLUE / OCEAN theme ── */
  [data-theme="blue"] {
    --bg:          #060f1e;
    --surface:     #0b1829;
    --surface2:    #0f2038;
    --surface3:    #152845;
    --surface4:    #1a3055;
    --border:      #1a3055;
    --border2:     #102240;
    --cyan:        #38bdf8;
    --cyan-dim:    rgba(56,189,248,0.12);
    --cyan-glow:   rgba(56,189,248,0.28);
    --amber:       #fbbf24;
    --amber-dim:   rgba(251,191,36,0.12);
    --green:       #4ade80;
    --green-dim:   rgba(74,222,128,0.12);
    --red:         #f87171;
    --red-dim:     rgba(248,113,113,0.12);
    --purple:      #c084fc;
    --purple-dim:  rgba(192,132,252,0.12);
    --text:        #cce8ff;
    --text2:       #6a9fc0;
    --text3:       #1e3d58;
    --text-inv:    #060f1e;
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  html, body { width: 100%; height: 100%; overflow: hidden; background: var(--bg); color: var(--text); font-family: var(--font-ui); -webkit-font-smoothing: antialiased; }

  /* ─── SCROLLBAR ─── */
  ::-webkit-scrollbar { width: 4px; height: 4px; }
  ::-webkit-scrollbar-track { background: transparent; }
  ::-webkit-scrollbar-thumb { background: var(--surface4); border-radius: 4px; }
  ::-webkit-scrollbar-thumb:hover { background: var(--text3); }

  /* ─── LAYOUT ─── */
  #app { display: flex; flex-direction: column; height: 100dvh; width: 100vw; overflow: hidden; }

  /* ─── HEADER ─── */
  #header {
    height: 48px;
    background: var(--surface);
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    padding: 0 12px 0 10px;
    gap: 8px;
    flex-shrink: 0;
    z-index: 10;
  }

  /* Logo */
  #logo { display: flex; align-items: center; gap: 9px; flex-shrink: 0; user-select: none; }
  #logo-icon {
    width: 30px; height: 30px;
    background: linear-gradient(135deg, var(--cyan) 0%, #0099bb 100%);
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-family: var(--font-mono); font-size: 12px; font-weight: 700; color: #000;
    letter-spacing: -0.5px;
    box-shadow: 0 0 14px var(--cyan-glow), 0 2px 6px rgba(0,0,0,.5);
    flex-shrink: 0;
  }
  #logo-text {
    font-family: var(--font-ui); font-size: 16px; font-weight: 800;
    letter-spacing: 0.5px; color: var(--text);
  }
  #logo-text span { color: var(--cyan); }
  #logo-badge {
    font-size: 9px; font-weight: 700; letter-spacing: 1.2px;
    background: var(--cyan-dim); color: var(--cyan);
    border: 1px solid rgba(0,212,255,0.25);
    padding: 2px 7px; border-radius: 20px;
    align-self: center;
  }

  #hdr-space { flex: 1; }

  /* Header actions */
  .hdr-icon-btn {
    width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;
    background: none; border: none; border-radius: 8px; cursor: pointer; color: var(--text2);
    transition: all .18s;
  }
  .hdr-icon-btn:hover { background: var(--surface3); color: var(--text); }
  .hdr-icon-btn svg { width: 15px; height: 15px; }

  #run-btn {
    display: flex; align-items: center; gap: 7px;
    background: var(--cyan); border: none; border-radius: 8px;
    color: #000; font-family: var(--font-ui); font-size: 13px; font-weight: 700;
    letter-spacing: 0.8px; padding: 0 16px; height: 34px;
    cursor: pointer; transition: all .2s;
    box-shadow: 0 0 20px var(--cyan-glow), 0 2px 8px rgba(0,0,0,.4);
    flex-shrink: 0;
  }
  #run-btn:hover { background: #1adbff; box-shadow: 0 0 28px var(--cyan-glow); transform: translateY(-1px); }
  #run-btn:active { transform: scale(.96) translateY(0); }
  #run-btn:disabled { opacity: .45; cursor: not-allowed; transform: none; }
  #run-btn svg { width: 13px; height: 13px; }

  /* ─── TOKEN BAR ─── */
  #token-bar {
    background: var(--surface2);
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center;
    padding: 7px 10px; gap: 6px;
    flex-shrink: 0; flex-wrap: nowrap;
  }
  #tok-label {
    font-size: 10px; font-weight: 700; letter-spacing: 1.2px;
    color: var(--text3); white-space: nowrap; flex-shrink: 0;
    display: flex; align-items: center; gap: 5px; text-transform: uppercase;
  }
  #tok-label svg { width: 11px; height: 11px; color: var(--amber); }
  #token-input {
    flex: 1; background: var(--surface3); border: 1.5px solid var(--border);
    border-radius: 7px; color: var(--text); font-family: var(--font-mono);
    font-size: 11px; padding: 6px 10px; outline: none; transition: border .2s; min-width: 0;
  }
  #token-input:focus { border-color: var(--cyan); box-shadow: 0 0 0 3px var(--cyan-dim); }
  #token-input.saved { border-color: var(--green) !important; }

  .tok-btn {
    display: flex; align-items: center; gap: 4px;
    border: none; border-radius: 6px;
    font-family: var(--font-ui); font-size: 10px; font-weight: 700;
    letter-spacing: 0.7px; padding: 6px 10px;
    cursor: pointer; flex-shrink: 0; transition: all .18s; white-space: nowrap;
  }
  .tok-btn:active { transform: scale(.93); }
  .tok-btn svg { width: 11px; height: 11px; }
  #btn-paste { background: var(--amber-dim); color: var(--amber); border: 1px solid rgba(245,166,35,.25); }
  #btn-paste:hover { background: rgba(245,166,35,.2); }
  #btn-save-tok { background: var(--green-dim); color: var(--green); border: 1px solid rgba(0,230,118,.25); }
  #btn-save-tok:hover { background: rgba(0,230,118,.2); }
  #btn-eye { background: var(--surface3); border: 1px solid var(--border); color: var(--text2); padding: 6px 8px; }
  #btn-eye:hover { color: var(--text); border-color: var(--cyan); }
  #tok-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--text3); flex-shrink: 0; transition: all .3s; }
  #tok-dot.ok { background: var(--green); box-shadow: 0 0 8px var(--green); }
  #tok-dot.err { background: var(--red); box-shadow: 0 0 8px var(--red); }

  /* ─── LANG BAR ─── */
  #lang-bar {
    height: 36px; background: var(--bg);
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; padding: 0 10px; gap: 2px;
    flex-shrink: 0; overflow-x: auto;
  }
  #lang-bar::-webkit-scrollbar { height: 0; }

  .lang-tab {
    display: flex; align-items: center; gap: 7px;
    padding: 5px 16px; border-radius: 0;
    border: none; border-bottom: 2px solid transparent;
    cursor: pointer; font-family: var(--font-ui);
    font-size: 12px; font-weight: 600; letter-spacing: 0.5px;
    color: var(--text3); background: transparent;
    transition: all .18s; white-space: nowrap; flex-shrink: 0;
    margin-bottom: -1px;
  }
  .lang-tab:hover { color: var(--text2); }
  .lang-tab.active { color: var(--text); border-bottom-color: var(--cyan); }
  .lang-tab .ldot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
  .lang-tab.active .ldot { box-shadow: 0 0 6px currentColor; }

  #lang-bar-right { margin-left: auto; flex-shrink: 0; }
  #lang-pill {
    font-family: var(--font-mono); font-size: 10px; font-weight: 500;
    color: var(--text3); background: var(--surface2);
    border: 1px solid var(--border); padding: 3px 10px; border-radius: 20px; letter-spacing: 0.3px;
  }

  /* ─── TOOLBAR ─── */
  #toolbar {
    height: 40px; background: var(--surface);
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; padding: 0 10px; gap: 4px;
    flex-shrink: 0;
  }
  .tb-btn {
    display: flex; align-items: center; gap: 5px;
    background: transparent; border: 1px solid transparent;
    border-radius: 6px; color: var(--text2);
    font-family: var(--font-ui); font-size: 11px; font-weight: 600;
    letter-spacing: 0.5px; padding: 4px 10px;
    cursor: pointer; transition: all .18s; flex-shrink: 0;
  }
  .tb-btn svg { width: 12px; height: 12px; }
  .tb-btn:hover { background: var(--surface3); border-color: var(--border); color: var(--text); }
  .tb-btn:active { transform: scale(.95); }
  .tb-btn.danger:hover { border-color: var(--red-dim); color: var(--red); background: var(--red-dim); }
  .tb-btn.save-cs { color: var(--cyan); border-color: rgba(0,212,255,.2); }
  .tb-btn.save-cs:hover { background: var(--cyan-dim); border-color: rgba(0,212,255,.35); }

  #tb-sep { width: 1px; height: 18px; background: var(--border); margin: 0 2px; flex-shrink: 0; }
  #tb-sp { flex: 1; }
  #file-label {
    font-size: 12px; font-weight: 500; color: var(--text2);
    display: flex; align-items: center; gap: 5px;
    font-family: var(--font-mono);
  }
  #file-label .file-icon { color: var(--cyan); font-size: 11px; }
  #cur-filename { color: var(--text); }

  /* ─── EDITOR ─── */
  #editor-wrap { flex: 1; display: flex; flex-direction: column; overflow: hidden; min-height: 0; }
  #editor-pane { flex: 1; display: flex; overflow: hidden; min-height: 0; position: relative; }

  /* Gutter */
  #line-nums {
    background: var(--surface);
    border-right: 1px solid var(--border2);
    padding: 14px 8px 14px 4px;
    font-family: var(--font-mono); font-size: 12px; line-height: 1.75;
    color: var(--text3); text-align: right;
    user-select: none; overflow: hidden; min-width: 44px; flex-shrink: 0; white-space: pre;
  }

  #editor-container {
    flex: 1; position: relative; display: flex; overflow: hidden; min-width: 0;
    background: var(--surface2);
  }
  /* Active line highlight */
  #editor-container::before {
    content: ''; position: absolute; inset: 0;
    background: var(--surface2); z-index: 0;
  }

  #bracket-canvas { position: absolute; top: 0; left: 0; pointer-events: none; z-index: 1; width: 100%; height: 100%; }

  /* Bracket colour highlight overlay — scrolls in sync with textarea */
  #brc-overlay {
    position: absolute; top: 0; left: 0;
    pointer-events: none; z-index: 3;
    font-family: 'JetBrains Mono', monospace; font-size: 13px; line-height: 1.75;
    padding: 14px 16px 14px 12px;
    white-space: pre; tab-size: 4;
    color: var(--text);
    overflow: hidden;
  }
  /* () → glowing purple */
  .bcp{
    color: #d946ef; font-weight: 700;
    text-shadow: 0 0 6px #d946ef, 0 0 14px #a21caf, 0 0 28px #86198f;
  }
  /* {} → glowing green */
  .bcc{
    color: #4ade80; font-weight: 700;
    text-shadow: 0 0 6px #4ade80, 0 0 14px #16a34a, 0 0 28px #15803d;
  }
  /* [] → glowing red */
  .bcs{
    color: #f87171; font-weight: 700;
    text-shadow: 0 0 6px #f87171, 0 0 14px #dc2626, 0 0 28px #b91c1c;
  }

  #code-editor {
    flex: 1; background: transparent; border: none; outline: none; resize: none;
    /* text transparent — overlay shows the colours */
    color: transparent; -webkit-text-fill-color: transparent;
    font-family: 'JetBrains Mono', monospace; font-size: 13px; line-height: 1.75;
    padding: 14px 16px 14px 12px; caret-color: var(--cyan);
    overflow-y: auto; overflow-x: auto; white-space: pre;
    tab-size: 4;
    position: relative; z-index: 4; width: 100%;
  }
  #code-editor::selection { background: rgba(0,212,255,.25); }
  #code-editor::-moz-selection { background: rgba(0,212,255,.25); }
  #code-editor::placeholder { -webkit-text-fill-color: var(--text3); color: var(--text3); }

  /* ─── RESIZE ─── */
  #resize-handle {
    height: 4px; background: var(--border2); cursor: ns-resize;
    flex-shrink: 0; position: relative; transition: background .2s;
  }
  #resize-handle:hover { background: var(--cyan); }
  #resize-handle::after {
    content: ''; position: absolute; left: 50%; top: 50%;
    transform: translate(-50%, -50%);
    width: 30px; height: 2px; border-radius: 2px; background: var(--text3);
  }

  /* ─── TERMINAL ─── */
  #terminal-panel {
    height: 38vh; display: flex; flex-direction: column;
    border-top: 1px solid var(--border); flex-shrink: 0;
    background: var(--bg);
  }
  #terminal-header {
    display: flex; align-items: center;
    background: var(--surface); border-bottom: 1px solid var(--border);
    padding: 0 12px; height: 34px; gap: 8px; flex-shrink: 0;
  }
  /* macOS dots */
  .mac-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
  .mac-dot.r { background: #ff5f57; }
  .mac-dot.y { background: #febc2e; }
  .mac-dot.g { background: #28c840; }

  #terminal-title {
    font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
    color: var(--text3); display: flex; align-items: center; gap: 6px;
    text-transform: uppercase;
  }
  #terminal-title svg { color: var(--cyan); }

  #term-sp { flex: 1; }
  #clear-term-btn {
    font-size: 10px; font-weight: 600; letter-spacing: 0.5px;
    background: none; border: 1px solid var(--border);
    border-radius: 5px; color: var(--text3);
    padding: 3px 8px; cursor: pointer; transition: all .2s;
  }
  #clear-term-btn:hover { border-color: var(--red); color: var(--red); background: var(--red-dim); }

  #terminal-output {
    flex: 1; overflow-y: auto; overflow-x: hidden;
    padding: 10px 16px; font-family: var(--font-mono);
    font-size: 12px; line-height: 1.8; color: #9ba8c0; word-break: break-word;
  }
  .t-line { display: block; }
  .t-line.err  { color: #ff7096; }
  .t-line.info { color: var(--cyan); }
  .t-line.ok   { color: var(--green); }
  .t-line.warn { color: var(--amber); }
  .t-line.inp  { color: #82cfff; font-style: italic; }

  /* ─── STATUS BAR ─── */
  #status-bar {
    height: 26px; background: var(--cyan);
    display: flex; align-items: center; padding: 0 12px; gap: 12px; flex-shrink: 0;
    transition: background .25s;
  }
  #status-bar.err     { background: var(--red); }
  #status-bar.ok      { background: #00a854; }
  #status-bar.running { background: #5b3fd4; }
  #status-msg {
    font-size: 11px; font-weight: 700; letter-spacing: 1.2px; color: #000; flex: 1;
    display: flex; align-items: center; gap: 6px;
  }
  #status-bar.err #status-msg,
  #status-bar.ok #status-msg,
  #status-bar.running #status-msg { color: #fff; }
  #status-lang { font-size: 10px; font-weight: 600; letter-spacing: 0.8px; color: rgba(0,0,0,.6); }
  #status-bar.err #status-lang,
  #status-bar.ok #status-lang,
  #status-bar.running #status-lang { color: rgba(255,255,255,.6); }

  /* ─── INPUT MODAL ─── */
  #input-overlay {
    display: none; position: fixed; inset: 0; z-index: 100;
    background: rgba(0,0,0,.75); align-items: center; justify-content: center;
    backdrop-filter: blur(8px); padding: 20px;
  }
  #input-overlay.show { display: flex; }
  #input-modal {
    width: 100%; max-width: 460px;
    background: var(--surface2); border: 1px solid var(--border);
    border-top: 2px solid var(--cyan);
    border-radius: 14px; padding: 24px 22px 22px;
    animation: popIn .22s cubic-bezier(.34,1.56,.64,1);
    max-height: 82vh; overflow-y: auto;
    display: flex; flex-direction: column; gap: 0;
    box-shadow: 0 24px 60px rgba(0,0,0,.7), 0 0 0 1px rgba(0,212,255,.08);
  }
  @keyframes popIn { from { transform: scale(.88); opacity: 0; } to { transform: scale(1); opacity: 1; } }

  #im-title {
    font-size: 16px; font-weight: 700; color: var(--text);
    display: flex; align-items: center; gap: 10px; margin-bottom: 20px;
  }
  #im-title-icon { font-size: 18px; }
  .inp-grp { margin-bottom: 14px; }
  .inp-lbl {
    display: block; font-size: 10px; font-weight: 700; letter-spacing: 1.2px;
    color: var(--cyan); margin-bottom: 6px; text-transform: uppercase;
  }
  .inp-fld {
    width: 100%; background: var(--surface3);
    border: 1.5px solid var(--border); border-radius: 9px;
    color: var(--text); font-family: var(--font-mono);
    font-size: 13px; padding: 11px 14px; outline: none; transition: border .15s;
  }
  .inp-fld:focus { border-color: var(--cyan); box-shadow: 0 0 0 3px var(--cyan-dim); }
  .inp-fld::placeholder { color: var(--text3); }

  #im-btns { display: flex; gap: 10px; margin-top: 6px; }
  #btn-cancel-inp {
    flex: 1; background: var(--surface3); border: 1px solid var(--border);
    border-radius: 9px; color: var(--text2); font-family: var(--font-ui);
    font-size: 13px; font-weight: 600; padding: 12px; cursor: pointer; transition: all .15s;
  }
  #btn-cancel-inp:hover { border-color: var(--red); color: var(--red); background: var(--red-dim); }
  #btn-run-inp {
    flex: 2; background: var(--cyan); border: none; border-radius: 9px;
    color: #000; font-family: var(--font-ui); font-size: 13px;
    font-weight: 700; letter-spacing: 0.5px; padding: 12px;
    cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px;
    transition: all .2s;
  }
  #btn-run-inp:hover { background: #1adbff; }
  #btn-run-inp:active { opacity: .85; }

  /* ─── SAVE MODAL ─── */
  #save-overlay {
    display: none; position: fixed; inset: 0; z-index: 100;
    background: rgba(0,0,0,.7); align-items: flex-end; justify-content: center;
    backdrop-filter: blur(5px);
  }
  #save-overlay.show { display: flex; }
  #save-modal {
    width: 100%; max-width: 600px;
    background: var(--surface); border-top: 2px solid var(--green);
    border-radius: 16px 16px 0 0; padding: 22px 20px 30px;
    animation: slideUp .25s ease;
    box-shadow: 0 -8px 40px rgba(0,0,0,.5);
  }
  @keyframes slideUp { from { transform: translateY(100%); } to { transform: translateY(0); } }

  #save-modal h3 {
    font-size: 14px; font-weight: 700; color: var(--green); letter-spacing: 0.8px;
    margin-bottom: 16px; display: flex; align-items: center; gap: 7px;
  }
  #save-filename {
    width: 100%; background: var(--surface2); border: 1.5px solid var(--border);
    border-radius: 9px; color: var(--text); font-family: var(--font-mono);
    font-size: 14px; padding: 11px 14px; outline: none; margin-bottom: 12px;
    transition: border .2s;
  }
  #save-filename:focus { border-color: var(--green); box-shadow: 0 0 0 3px var(--green-dim); }
  #save-confirm {
    width: 100%; background: var(--green); border: none; border-radius: 9px;
    color: #000; font-family: var(--font-ui); font-size: 14px;
    font-weight: 800; letter-spacing: 0.8px; padding: 12px; cursor: pointer;
    transition: all .2s;
  }
  #save-confirm:hover { background: #1aff8a; }
  #save-cancel {
    width: 100%; background: none; border: 1px solid var(--border);
    border-radius: 9px; color: var(--text2); font-family: var(--font-ui);
    font-size: 13px; font-weight: 600; padding: 9px; cursor: pointer;
    margin-top: 8px; transition: all .2s;
  }
  #save-cancel:hover { border-color: var(--border2); color: var(--text); }

  /* ─── TOAST ─── */
  #toast {
    position: fixed; bottom: 64px; left: 50%; transform: translateX(-50%);
    background: var(--surface3); border: 1px solid var(--border);
    border-radius: 8px; padding: 8px 18px;
    font-size: 12px; font-weight: 600; color: var(--text);
    letter-spacing: 0.4px; z-index: 200;
    opacity: 0; transition: opacity .3s; pointer-events: none; white-space: nowrap;
    box-shadow: 0 4px 20px rgba(0,0,0,.5);
  }
  #toast.show { opacity: 1; }

  /* ─── SPINNER ─── */
  .spinner {
    width: 12px; height: 12px;
    border: 2px solid rgba(0,0,0,.2); border-top-color: #000;
    border-radius: 50%; animation: spin .65s linear infinite; display: inline-block;
  }
  @keyframes spin { to { transform: rotate(360deg); } }
</style>
</head>
<body>
<div id="app">

  <!-- ── HEADER ── -->
  <div id="header">
    <div id="logo">
      <div id="logo-icon" id="logo-icon-box">C#</div>
      <span id="logo-text">Sharp<span>Pad</span></span>
      <span id="logo-badge">BETA</span>
    </div>
    <div id="hdr-space"></div>

    <!-- Theme Toggle -->
    <div id="theme-toggle" style="display:flex;align-items:center;gap:2px;background:var(--surface2);border:1px solid var(--border);border-radius:8px;padding:3px;margin-right:8px;">
      <button onclick="setTheme('dark')"  id="th-dark"  title="Dark"  style="width:28px;height:28px;border-radius:6px;border:none;cursor:pointer;font-size:14px;background:var(--cyan);color:var(--text-inv);">🌑</button>
      <button onclick="setTheme('white')" id="th-white" title="Light" style="width:28px;height:28px;border-radius:6px;border:none;cursor:pointer;font-size:14px;background:transparent;color:var(--text2);">☀️</button>
      <button onclick="setTheme('blue')"  id="th-blue"  title="Blue"  style="width:28px;height:28px;border-radius:6px;border:none;cursor:pointer;font-size:14px;background:transparent;color:var(--text2);">🌊</button>
    </div>

    <button id="run-btn" onclick="runCode()">
      <svg viewBox="0 0 16 16" fill="currentColor"><path d="M3 2.5l10 5.5-10 5.5V2.5z"/></svg>
      RUN
    </button>
  </div>

  <!-- ── TOKEN BAR ── -->
  <div id="token-bar">
    <div id="tok-label">
      <svg viewBox="0 0 16 16" fill="currentColor"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38v-1.33c-2.23.48-2.7-1.07-2.7-1.07-.36-.93-.88-1.17-.88-1.17-.72-.49.05-.48.05-.48.8.06 1.22.82 1.22.82.71 1.21 1.87.86 2.33.66.07-.52.28-.86.5-1.06-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82A7.69 7.69 0 018 4.07c.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48v2.2c0 .21.15.46.55.38A8.01 8.01 0 0016 8c0-4.42-3.58-8-8-8z"/></svg>
      API TOKEN
    </div>
    <input type="text" id="token-input" placeholder="Paste GitHub token (ghp_...)" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"/>
    <button class="tok-btn" id="btn-paste" onclick="pasteToken()">
      <svg viewBox="0 0 16 16" fill="currentColor"><path d="M4 1.5H3a2 2 0 00-2 2V14a2 2 0 002 2h10a2 2 0 002-2V3.5a2 2 0 00-2-2h-1v1h1a1 1 0 011 1V14a1 1 0 01-1 1H3a1 1 0 01-1-1V3.5a1 1 0 011-1h1v-1z"/><path d="M9.5 1a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-3a.5.5 0 01-.5-.5v-1a.5.5 0 01.5-.5h3zm-3-1A1.5 1.5 0 005 1.5v1A1.5 1.5 0 006.5 4h3A1.5 1.5 0 0011 2.5v-1A1.5 1.5 0 009.5 0h-3z"/></svg>
      PASTE
    </button>
    <button class="tok-btn" id="btn-save-tok" onclick="saveToken()">
      <svg viewBox="0 0 16 16" fill="currentColor"><path d="M2 1a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V2a1 1 0 00-1-1H9.5a1 1 0 00-1 1v3.5H11a.5.5 0 010 1H7a.5.5 0 010-1h1.5V2a2 2 0 012-2H14a2 2 0 012 2v12a2 2 0 01-2 2H2a2 2 0 01-2-2V2a2 2 0 012-2h1.5a.5.5 0 010 1H2z"/></svg>
      SAVE
    </button>
    <button class="tok-btn" id="btn-eye" onclick="toggleTokVis()">
      <svg id="eye-icon" viewBox="0 0 16 16" fill="currentColor" width="12" height="12"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 011.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0114.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 011.172 8z"/><path d="M8 5.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM4.5 8a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0z"/></svg>
    </button>
    <div id="tok-dot"></div>
  </div>

  <!-- ── LANGUAGE BAR ── -->
  <div id="lang-bar">
    <button class="lang-tab active" id="tab-cs" onclick="setLang('cs')">
      <span class="ldot" style="background:#a78bfa;color:#a78bfa"></span>C# · .NET 8
    </button>
    <button class="lang-tab" id="tab-java" onclick="setLang('java')">
      <span class="ldot" style="background:#ff8c42;color:#ff8c42"></span>Java · JDK 21
    </button>
    <button class="lang-tab" id="tab-py" onclick="setLang('py')">
      <span class="ldot" style="background:#4ade80;color:#4ade80"></span>Python · 3.12
    </button>
    <div id="lang-bar-right">
      <span id="lang-pill">C# 12 / .NET 8</span>
    </div>
  </div>

  <!-- ── TOOLBAR ── -->
  <div id="toolbar">
    <div id="file-label">
      <span class="file-icon">◈</span>
      <span id="cur-filename">main.cs</span>
    </div>
    <div id="tb-sp"></div>
    <button class="tb-btn" onclick="copyCode()">
      <svg viewBox="0 0 16 16" fill="currentColor"><path d="M4 2h8a1 1 0 011 1v9h-1V3H4V2zm-1 2h7a1 1 0 011 1v9a1 1 0 01-1 1H3a1 1 0 01-1-1V5a1 1 0 011-1zm0 1v9h7V5H3z"/></svg>
      COPY
    </button>
    <div id="tb-sep"></div>
    <button class="tb-btn danger" onclick="clearCode()">
      <svg viewBox="0 0 16 16" fill="currentColor"><path d="M2 4h12v1H2V4zm2.5-2h7l.5.5V4h-1V3H4v1H3V2.5L3.5 2zm1 0v1h5V2h-5zM3 5h10l-.5 9.5-.5.5H4l-.5-.5L3 5zm1 1l.4 8h7.2l.4-8H4z"/></svg>
      CLEAR
    </button>
    <div id="tb-sep"></div>
    <button class="tb-btn save-cs" id="btn-save-file" onclick="openSave()">
      <svg viewBox="0 0 16 16" fill="currentColor"><path d="M13 1H3a1 1 0 00-1 1v12a1 1 0 001 1h10a1 1 0 001-1V2a1 1 0 00-1-1zm0 13H3V2h2v4h6V2h2v12zm-3-7H6V2h4v5z"/></svg>
      <span id="save-btn-lbl">SAVE .CS</span>
    </button>
  </div>

  <!-- ── EDITOR ── -->
  <div id="editor-wrap">
    <div id="editor-pane">
      <div id="line-nums">1</div>
      <div id="editor-container">
        <canvas id="bracket-canvas"></canvas>
        <div id="brc-overlay" aria-hidden="true"></div>
        <textarea id="code-editor" spellcheck="false" autocomplete="off" autocorrect="off" autocapitalize="off"
          oninput="onEdit()" onkeydown="handleKey(event)" onscroll="onScroll()"
          onbeforeinput="handleBeforeInput(event)"
          placeholder="// Write your C# code here..."></textarea>
      </div>
    </div>

    <div id="resize-handle"></div>

    <!-- ── TERMINAL ── -->
    <div id="terminal-panel">
      <div id="terminal-header">
        <div class="mac-dot r"></div>
        <div class="mac-dot y"></div>
        <div class="mac-dot g"></div>
        <div id="terminal-title">
          <svg width="11" height="11" viewBox="0 0 16 16" fill="currentColor"><path d="M1 2.5A1.5 1.5 0 012.5 1h11A1.5 1.5 0 0115 2.5v11a1.5 1.5 0 01-1.5 1.5h-11A1.5 1.5 0 011 13.5v-11zm1.5-.5a.5.5 0 00-.5.5v11a.5.5 0 00.5.5h11a.5.5 0 00.5-.5v-11a.5.5 0 00-.5-.5h-11zM4 6l2 2-2 2-.7-.7L4.6 8 3.3 6.7 4 6zm3 4h5v1H7v-1z"/></svg>
          TERMINAL OUTPUT
        </div>
        <div id="term-sp"></div>
        <button id="clear-term-btn" onclick="clearTerm()">CLEAR</button>
      </div>
      <div id="terminal-output">
        <span class="t-line info">▸ SharpPad ready — paste &amp; SAVE your GitHub token, then press RUN.</span>
        <span class="t-line" style="color:var(--text3)">  → github.com/settings/tokens · New classic token · No scope needed</span>
      </div>
    </div>
  </div>

  <!-- ── STATUS BAR ── -->
  <div id="status-bar">
    <span id="status-msg">● READY</span>
    <span id="status-lang">C# · .NET 8</span>
  </div>
</div>

<!-- ── INPUT MODAL ── -->
<div id="input-overlay">
  <div id="input-modal">
    <div id="im-title"><span id="im-title-icon">⌨️</span> Program Input Required</div>
    <div id="im-fields"></div>
    <div id="im-btns">
      <button id="btn-cancel-inp" onclick="cancelRun()">Cancel</button>
      <button id="btn-run-inp" onclick="submitInputs()">
        <svg width="12" height="12" viewBox="0 0 16 16" fill="currentColor"><path d="M3 2.5l10 5.5-10 5.5V2.5z"/></svg>
        Run with inputs
      </button>
    </div>
  </div>
</div>

<!-- ── SAVE MODAL ── -->
<div id="save-overlay">
  <div id="save-modal">
    <h3>
      <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M13 1H3a1 1 0 00-1 1v12a1 1 0 001 1h10a1 1 0 001-1V2a1 1 0 00-1-1zm0 13H3V2h2v4h6V2h2v12zm-3-7H6V2h4v5z"/></svg>
      SAVE FILE
    </h3>
    <input type="text" id="save-filename" placeholder="filename (without extension)" value="main"/>
    <button id="save-confirm" onclick="confirmSave()">💾 <span id="save-dl-lbl">DOWNLOAD .CS</span></button>
    <button id="save-cancel" onclick="closeSave()">Cancel</button>
  </div>
</div>

<div id="toast"></div>

<script>
// ── REFS ──
const editor   = document.getElementById('code-editor');
const lineNums = document.getElementById('line-nums');
const termOut  = document.getElementById('terminal-output');
const runBtn   = document.getElementById('run-btn');
const statBar  = document.getElementById('status-bar');
const statMsg  = document.getElementById('status-msg');
const tokInp   = document.getElementById('token-input');
const tokDot   = document.getElementById('tok-dot');

// ── STATE ──
let githubToken  = '';
let isRunning    = false;
let tokenHidden  = false;
let curFile      = 'main.cs';
let currentLang  = 'cs';
let inputResolve = null, inputReject = null;

// ── LOAD SAVED TOKEN ──
(function(){
  const t = localStorage.getItem('sharppad_tok');
  if(t){ tokInp.value=t; githubToken=t; tokDot.className='ok'; tokInp.classList.add('saved'); }
})();

editor.value = '';
updateLines();

// ── LINE NUMBERS ──
function updateLines(){
  const n = editor.value.split('\n').length;
  lineNums.textContent = Array.from({length:n},(_,i)=>i+1).join('\n');
}
let _skipInput = false;
function onEdit(){ if(_skipInput){ _skipInput=false; return; } updateLines(); renderBracketOverlay(); drawGuides(); }

// ── HELPERS ──
function insertAt(val, s, en, text, cursorOffset){
  editor.value = val.slice(0,s) + text + val.slice(en);
  editor.selectionStart = editor.selectionEnd = s + cursorOffset;
  _skipInput = true; updateLines(); renderBracketOverlay(); drawGuides();
}

// ── BEFORE-INPUT: auto-close brackets (fires before DOM changes) ──
const PAIRS   = {'(':')', '{':'}', '[':']'};
const CLOSE_S = new Set([')', '}', ']']);

function handleBeforeInput(e){
  const ch = e.data;
  if(!ch || ch.length !== 1) return;
  const s = editor.selectionStart, en = editor.selectionEnd;
  const val = editor.value;

  // Opening bracket → insert pair
  if(PAIRS[ch]){
    e.preventDefault();
    insertAt(val, s, en, ch + PAIRS[ch], 1);
    return;
  }

  // Closing bracket → skip over if already there
  if(CLOSE_S.has(ch) && val[s] === ch){
    e.preventDefault();
    editor.selectionStart = editor.selectionEnd = s + 1;
    _skipInput = true; updateLines(); renderBracketOverlay(); drawGuides();
    return;
  }
}

// ── KEY HANDLING — tab, backspace pair-delete, enter auto-indent ──
function handleKey(e){

  // Ctrl/Cmd+Enter → run
  if(e.key==='Enter' && (e.ctrlKey||e.metaKey)){ e.preventDefault(); runCode(); return; }

  const s  = editor.selectionStart;
  const en = editor.selectionEnd;
  const val = editor.value;

  // ── TAB ──
  if(e.key==='Tab'){
    e.preventDefault();
    insertAt(val, s, en, '    ', 4); return;
  }

  // ── BACKSPACE: delete auto-pair together ──
  if(e.key==='Backspace' && s === en){
    const prev = val[s-1], next = val[s];
    if(prev && PAIRS[prev] === next){
      e.preventDefault();
      editor.value = val.slice(0,s-1) + val.slice(s+1);
      editor.selectionStart = editor.selectionEnd = s - 1;
      _skipInput = true; updateLines(); renderBracketOverlay(); drawGuides(); return;
    }
  }

  // ── AUTO-INDENT on Enter ──
  if(e.key==='Enter'){
    e.preventDefault();
    const lineStart = val.lastIndexOf('\n', s-1) + 1;
    const line      = val.slice(lineStart, s);
    const indent    = line.match(/^(\s*)/)[1];
    const lastChar  = line.trimEnd().slice(-1);
    const nextChar  = val[s];
    const extra     = lastChar === '{' ? '    ' : '';

    if(lastChar === '{' && nextChar === '}'){
      const insert = '\n' + indent + extra + '\n' + indent;
      insertAt(val, s, en, insert, 1 + indent.length + extra.length);
    } else {
      const insert = '\n' + indent + extra;
      insertAt(val, s, en, insert, insert.length);
    }
    return;
  }
}

// ── TOKEN ──
async function pasteToken(){
  try{
    const txt=await navigator.clipboard.readText();
    tokInp.value=txt.trim();
    tokDot.className=tokInp.value.length>10?'ok':'err';
    showToast('Pasted — press SAVE to store');
  } catch{ showToast('Allow clipboard access first'); }
}
function saveToken(){
  const v=tokInp.value.trim();
  if(!v){ showToast('Enter a token first'); return; }
  if(v.length<10){ tokDot.className='err'; showToast('Token too short'); return; }
  githubToken=v;
  localStorage.setItem('sharppad_tok',v);
  tokDot.className='ok';
  tokInp.classList.add('saved');
  showToast('✓ Token saved!');
}
function toggleTokVis(){
  tokenHidden=!tokenHidden;
  tokInp.type=tokenHidden?'password':'text';
  document.getElementById('eye-icon').innerHTML=tokenHidden
    ?'<path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 00-2.79.588l.77.771A5.944 5.944 0 018 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0114.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/><path d="M11.297 9.176a3.5 3.5 0 00-4.474-4.474l.823.823a2.5 2.5 0 012.829 2.829l.822.822zm-2.943 1.299l.822.823a3.5 3.5 0 01-4.474-4.474l.823.823a2.5 2.5 0 002.829 2.828z"/><path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 001.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 018 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709z"/><path d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>'
    :'<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 011.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0114.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 011.172 8z"/><path d="M8 5.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM4.5 8a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0z"/>';
}

// ── LANGUAGE SWITCHER ──
function setLang(lang){
  currentLang = lang;
  const isJava = lang === 'java';
  const isPy   = lang === 'py';
  const isCs   = lang === 'cs';

  document.getElementById('tab-cs').classList.toggle('active', isCs);
  document.getElementById('tab-java').classList.toggle('active', isJava);
  document.getElementById('tab-py').classList.toggle('active', isPy);

  const logoIcon = document.getElementById('logo-icon-box') || document.querySelector('#logo > div');
  if(logoIcon){
    logoIcon.textContent = isJava ? '☕' : isPy ? '🐍' : 'C#';
    logoIcon.style.background = isJava
      ? 'linear-gradient(135deg,#ff8c42,#cc5500)'
      : isPy
      ? 'linear-gradient(135deg,#4ade80,#16a34a)'
      : 'linear-gradient(135deg,#00d4ff,#0099bb)';
    logoIcon.style.fontSize = isCs ? '12px' : '16px';
  }

  const badge = document.getElementById('logo-badge');
  if(badge){ badge.textContent = isJava ? 'JAVA' : isPy ? 'PY' : 'BETA'; }

  document.getElementById('lang-pill').textContent   = isJava ? 'Java 21 / JDK 21' : isPy ? 'Python 3.12' : 'C# 12 / .NET 8';
  document.getElementById('status-lang').textContent = isJava ? 'Java · JDK 21'    : isPy ? 'Python · 3.12' : 'C# · .NET 8';

  const ext = isJava ? '.java' : isPy ? '.py' : '.cs';
  const base = curFile.replace(/\.(cs|java|py)$/i, '');
  curFile = base + ext;
  document.getElementById('cur-filename').textContent = curFile;
  document.getElementById('save-btn-lbl').textContent = isJava ? 'SAVE .JAVA' : isPy ? 'SAVE .PY' : 'SAVE .CS';
  document.getElementById('save-dl-lbl').textContent  = isJava ? 'DOWNLOAD .JAVA' : isPy ? 'DOWNLOAD .PY' : 'DOWNLOAD .CS';

  editor.placeholder = isJava
    ? '// Write your Java code here...\npublic class Main {\n    public static void main(String[] args) {\n        System.out.println("Hello, Java!");\n    }\n}'
    : isPy
    ? '# Write your Python code here...\nprint("Hello, Python!")'
    : '// Write your C# code here...';

  showToast(isJava ? '☕ Java JDK 21 selected' : isPy ? '🐍 Python 3.12 selected' : '# C# .NET 8 selected');
}

// ── TERMINAL ──
function tLine(text, cls=''){
  const sp=document.createElement('span');
  sp.className='t-line'+(cls?' '+cls:'');
  sp.textContent=text;
  termOut.appendChild(sp);
  termOut.scrollTop=termOut.scrollHeight;
}
function clearTerm(){ termOut.innerHTML=''; tLine('▸ Terminal cleared.','info'); }

// ── TOOLBAR ──
function copyCode(){ navigator.clipboard.writeText(editor.value).then(()=>showToast('Copied! 📋')); }
function clearCode(){ if(confirm('Clear all code?')){ editor.value=''; updateLines(); renderBracketOverlay(); drawGuides(); showToast('Cleared'); } }
function openSave(){ document.getElementById('save-overlay').classList.add('show'); document.getElementById('save-filename').focus(); }
function closeSave(){ document.getElementById('save-overlay').classList.remove('show'); }
function confirmSave(){
  const ext = currentLang === 'java' ? '.java' : currentLang === 'py' ? '.py' : '.cs';
  let n = (document.getElementById('save-filename').value.trim() || 'main').replace(/\.(cs|java|py)$/i, '');
  const b = new Blob([editor.value], {type:'text/plain'});
  const u = URL.createObjectURL(b);
  const a = document.createElement('a');
  a.href = u; a.download = n + ext; a.style.display = 'none';
  document.body.appendChild(a); a.click();
  setTimeout(() => { URL.revokeObjectURL(u); document.body.removeChild(a); }, 2000);
  curFile = n + ext;
  document.getElementById('cur-filename').textContent = curFile;
  closeSave(); showToast('💾 Saved as ' + n + ext + ' ✓');
}

// ── TOAST / STATUS ──
function showToast(m){
  const t=document.getElementById('toast');
  t.textContent=m; t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'),2200);
}
function setStat(m, cls=''){ statMsg.textContent='● '+m; statBar.className=cls; }

// ── EXTRACT INPUT CALLS ──
function getPrompts(code){
  const prompts=[];
  const lines=code.split('\n');
  if(currentLang==='java'){
    const javaInputRe=/\.\s*next(Line|Int|Double|Float|Long|)\s*\(\s*\)/i;
    for(let i=0;i<lines.length;i++){
      if(!javaInputRe.test(lines[i])) continue;
      let hint='Enter a value';
      const search=[lines[i],i>0?lines[i-1]:''];
      for(const s of search){
        const m=s.match(/System\.out\.print(?:ln)?\s*\(\s*["'`](.+?)["'`]\s*\)/);
        if(m){ hint=m[1].replace(/[:\s]+$/,'').trim(); break; }
      }
      prompts.push(hint);
    }
  } else if(currentLang==='py'){
    // Match: input("prompt") or input('prompt') or x = input()
    const pyRe=/\binput\s*\(\s*(["']?)(.+?)?\1\s*\)/g;
    let m;
    const full=code;
    while((m=pyRe.exec(full))!==null){
      const hint=(m[2]||'Enter a value').replace(/[:\s]+$/,'').trim();
      prompts.push(hint||'Enter a value');
    }
  } else {
    const csInputRe=/Console\.ReadLine\s*\(\s*\)|Convert\.\w+\s*\(\s*Console\.ReadLine/;
    for(let i=0;i<lines.length;i++){
      if(!csInputRe.test(lines[i])) continue;
      let hint='Enter a value';
      const search=[lines[i],i>0?lines[i-1]:''];
      for(const s of search){
        const m=s.match(/Console\.Write(?:Line)?\s*\(\s*["'](.+?)["']\s*\)/);
        if(m){ hint=m[1].replace(/[:\s]+$/,'').trim(); break; }
      }
      prompts.push(hint);
    }
  }
  return prompts;
}

// ── INPUT MODAL ──
function openInputModal(prompts){
  return new Promise((resolve,reject)=>{
    inputResolve=resolve; inputReject=reject;
    const wrap=document.getElementById('im-fields');
    wrap.innerHTML='';
    prompts.forEach((p,i)=>{
      const g=document.createElement('div'); g.className='inp-grp';
      g.innerHTML=`<label class="inp-lbl">INPUT ${i+1} — ${p}</label><input class="inp-fld" type="text" id="imf_${i}" placeholder="Enter value ..." autocomplete="off" autocorrect="off" autocapitalize="off"/>`;
      wrap.appendChild(g);
    });
    document.getElementById('input-overlay').classList.add('show');
    setTimeout(()=>{ const f=document.getElementById('imf_0'); if(f)f.focus(); },120);
  });
}
function submitInputs(){
  const vals=Array.from(document.querySelectorAll('.inp-fld')).map(f=>f.value);
  document.getElementById('input-overlay').classList.remove('show');
  if(inputResolve){ inputResolve(vals); inputResolve=null; }
}
function cancelRun(){
  document.getElementById('input-overlay').classList.remove('show');
  if(inputReject){ inputReject(new Error('CANCELLED')); inputReject=null; }
}
document.getElementById('im-fields').addEventListener('keydown',e=>{ if(e.key==='Enter') submitInputs(); });

// ── RUN ──
async function runCode(){
  if(isRunning) return;
  const code=editor.value.trim();
  if(!code){ showToast('Write some code first!'); return; }

  isRunning=true; runBtn.disabled=true;
  runBtn.innerHTML='<span class="spinner"></span> RUNNING';
  setStat('⚡ COMPILING...','running');
  termOut.innerHTML='';
  tLine('▸ Analysing code...','info');

  let inputs=[];
  const prompts=getPrompts(code);
  if(prompts.length>0){
    try{
      inputs=await openInputModal(prompts);
      inputs.forEach((v,i)=>tLine(`> [INPUT ${i+1}] ${v}`,'inp'));
    } catch(e){
      tLine('▸ Run cancelled.','warn'); setStat('CANCELLED','');
      isRunning=false; runBtn.disabled=false;
      runBtn.innerHTML='<svg viewBox="0 0 16 16" fill="currentColor"><path d="M3 2.5l10 5.5-10 5.5V2.5z"/></svg> RUN';
      return;
    }
  }

  if(!githubToken){
    tLine('── NO TOKEN ──','warn');
    tLine('✗ GitHub token nahi dala!','err');
    tLine('→ github.com/settings/tokens → New token (classic) → No expiry → No scope → Copy → PASTE → SAVE','info');
    setStat('✗ NO TOKEN','err');
    isRunning=false; runBtn.disabled=false;
    runBtn.innerHTML='<svg viewBox="0 0 16 16" fill="currentColor"><path d="M3 2.5l10 5.5-10 5.5V2.5z"/></svg> RUN';
    return;
  }

  tLine('▸ Executing via GitHub AI...','info');
  tLine('─'.repeat(38),'');

  const inputSection = inputs.length > 0
    ? '\n\nUSER INPUTS (use in order):\n' + inputs.map((v,i)=>`Input ${i+1}: "${v}"`).join('\n')
    : '';

  let codeToRun = code;
  if(currentLang === 'java'){
    codeToRun = codeToRun.replace(/import\s+java\.util\.scanner\s*;/gi, 'import java.util.Scanner;');
    codeToRun = codeToRun.replace(/\bpublic\s+class\s+([a-z])(\w*)/g,(m,first,rest)=>`public class ${first.toUpperCase()}${rest}`);
    codeToRun = codeToRun.replace(/\bstring\b(\s*\[)/g, 'String$1');
    codeToRun = codeToRun.replace(/\bvoid\s+main\s*\(\s*string/gi, 'void main(String');
    codeToRun = codeToRun.replace(/public\s+void\s+main\s*\(/g, 'public static void main(');
    codeToRun = codeToRun.replace(/\bsystem\.out\./g, 'System.out.');
    codeToRun = codeToRun.replace(/Convert\.ToInt32\s*\(/g, 'Integer.parseInt(');
    codeToRun = codeToRun.replace(/Convert\.ToDouble\s*\(/g, 'Double.parseDouble(');
    codeToRun = codeToRun.replace(/Convert\.ToSingle\s*\(/g, 'Float.parseFloat(');
    codeToRun = codeToRun.replace(/Convert\.ToInt64\s*\(/g, 'Long.parseLong(');
    codeToRun = codeToRun.replace(/Console\.WriteLine\s*\(/g, 'System.out.println(');
    codeToRun = codeToRun.replace(/Console\.Write\s*\(/g, 'System.out.print(');
    codeToRun = codeToRun.replace(/\.nextline\s*\(\s*\)/g, '.nextLine()');
    const javaLines = codeToRun.split('\n');
    const scannerReadRe = /\.\s*next(Line|Int|Double|Float|Long|)\s*\(/i;
    for(let li = 0; li < javaLines.length - 1; li++){
      if(/System\.out\.println\s*\(/.test(javaLines[li]) && scannerReadRe.test(javaLines[li+1])){
        javaLines[li] = javaLines[li].replace('System.out.println(', 'System.out.print(');
      }
    }
    codeToRun = javaLines.join('\n');
    codeToRun = codeToRun.replace(/Integer\.ParseInt\s*\(/g, 'Integer.parseInt(');
    codeToRun = codeToRun.replace(/Double\.ParseDouble\s*\(/g, 'Double.parseDouble(');
    codeToRun = codeToRun.replace(/Float\.ParseFloat\s*\(/g, 'Float.parseFloat(');
    codeToRun = codeToRun.replace(/\bstring\s+(\w+)\s*=/g, 'String $1 =');
  }

  const PROMPTS = {
    cs: `You are a precise C# .NET 8 runtime simulator. Execute the C# code and return ONLY the exact console output — no markdown, no backticks, no explanations.
RULES:
1. Output ONLY what the console displays.
2. Console.Write("text") before ReadLine() → show prompt text and input value on SAME LINE. e.g. Console.Write("Enter: "); ReadLine() with input "5" → "Enter: 5". NEVER add any prefix like "p:" unless the code itself prints "p:".
3. Compile error → start with "COMPILE_ERROR:" then error details.
4. Runtime exception → start with "RUNTIME_ERROR:" then exception message.
5. If a loop prints the same line N times, output it EXACTLY N times on SEPARATE LINES — never collapse or use "...".
6. Preserve all spacing and newlines exactly.
7. SIZEOF VALUES (C# .NET 8 — always use EXACTLY these): char=2, bool=1, byte=1, sbyte=1, short=2, ushort=2, int=4, uint=4, long=8, ulong=8, float=4, double=8, decimal=16.
8. string.Length = number of characters only (count each letter exactly, no extras). e.g. "Console".Length = 7, "Hello".Length = 5.
9. For sizeof calculations: FIRST count characters precisely letter by letter, THEN multiply by sizeof value.
10. DOUBLE CONVERSION OUTPUT: When an integer is explicitly converted to double (e.g. double d = Convert.ToDouble(n) or double d = (double)n where n is int), and then printed with Console.WriteLine, output MUST show decimal → "20.0" not "20". This makes the conversion visible to the user.
11. CRITICAL: int result = Convert.ToInt32(20.5) → result = 20 (truncates decimal). This is CORRECT C# behavior.
12. double result = Convert.ToDouble(someIntVariable) → Console.WriteLine(result) → print "20.0" (always show .0 for whole-number doubles that came from int conversion).${inputSection}

C# Code to execute:
${codeToRun}`,
    java: `You are an exact Java 21 JDK runtime simulator. Execute the code and return ONLY the raw console output — no markdown, no backticks, no explanation, no preamble.

STRICT RULES:
1. Return ONLY what System.out.print / System.out.println would print. Nothing else.
2. INPUT RULE: Every Scanner read (nextLine/nextInt/nextDouble etc.) — if there is a print/println prompt just before it, show the prompt text and the input value on the SAME LINE (e.g. "Enter the number : 5"). Never put the input value on a separate line. Do NOT add any extra messages.
3. String concat spaces: "The addition is : " + 40 → "The addition is : 40" — preserve ALL spaces exactly.
4. String concatenation: "Your age is : " + 25 + " years old" → "Your age is : 25 years old" (preserve all spaces inside the string literals EXACTLY).
5. Evaluate ALL conditions correctly: if(age >= 18) with age=12 → FALSE → go to else block.
6. Execute ALL logic (if/else, loops, switch) with the actual input values provided.
7. AUTO-FIX silently: lowercase imports, missing static on main, minor casing issues — just run the code.
8. COMPILE_ERROR: only for truly broken syntax that cannot run at all.
9. RUNTIME_ERROR: for null pointer, array out of bounds, divide by zero etc.
10. Never collapse repeated output — print every line separately.
11. Preserve every space, newline, and character exactly as the code specifies.${inputSection}

Java Code:
${codeToRun}`,
    py: `You are an exact Python 3.12 interpreter. Execute the code and return ONLY the raw console output — no markdown, no backticks, no explanation.

STRICT RULES:
1. Return ONLY what print() would output. Nothing else.
2. INPUT RULE: input("prompt") → show the prompt text and the user's input value on the SAME LINE (e.g. "Enter name: Ali"). Never on separate lines.
3. If no input() calls exist, just run the code and output the result.
4. SYNTAX_ERROR: if code has broken syntax — start with "SYNTAX_ERROR:" then details.
5. RUNTIME_ERROR: for ZeroDivisionError, NameError, TypeError etc — start with "RUNTIME_ERROR:" then the error.
6. Evaluate all conditions, loops, functions correctly with actual input values.
7. Preserve all spacing and newlines exactly as print() would produce.
8. f-strings, format(), % formatting — evaluate and output the final string.
9. Never collapse repeated output — print every line separately.${inputSection}

Python Code:
${codeToRun}`
  };

  const prompt = PROMPTS[currentLang] || PROMPTS.cs;
  const models = ['Llama-3.3-70B-Instruct','Mistral-small','Phi-4-mini-instruct','gpt-4o-mini','gpt-4o'];
  let raw = '', lastErr = '', got401 = false;

  try{
    for(const model of models){
      tLine(`▸ Using ${model}...`,'info');
      try{
        const res = await fetch('https://models.inference.ai.azure.com/chat/completions',{
          method:'POST',
          headers:{'Content-Type':'application/json','Authorization':`Bearer ${githubToken}`},
          body:JSON.stringify({model, messages:[{role:'user',content:prompt}], temperature:0, max_tokens:2048})
        });

        if(res.status===401){
          got401=true;
          tLine('✗ HTTP 401 — Token invalid ya expire ho gaya!','err');
          tLine('→ github.com/settings/tokens → New token (classic) → No expiry → No scope → PASTE → SAVE','info');
          setStat('✗ BAD TOKEN','err'); break;
        }

        const data = await res.json();
        if(data.error || !data.choices){
          const msg=(data.error?.message||data.message||'').toLowerCase();
          if(msg.includes('rate')||msg.includes('limit')||msg.includes('quota')||
             msg.includes('content')||msg.includes('filter')||msg.includes('policy')||
             msg.includes('unknown model')||msg.includes('not found')){
            tLine(`▸ ${model} unavailable — next try...`,'warn'); lastErr=msg; continue;
          }
          tLine(`✗ ${model}: ${data.error?.message||data.message}`,'err'); lastErr=msg; break;
        }
        raw=data?.choices?.[0]?.message?.content||'';
        if(!raw){ tLine('▸ No response, next...','warn'); continue; }
        const last=termOut.lastElementChild;
        if(last&&last.textContent.includes('Using')) termOut.removeChild(last);
        break;
      } catch(fe){ tLine('▸ Network error, retry...','warn'); continue; }
    }

    if(!raw){
      if(!got401) setStat('✗ FAILED','err');
      if(lastErr&&!got401) tLine('✗ All models busy, thodi der baad try karo','err');
      return;
    }

    let out=raw.trim().replace(/^```[\w]*\n?/,'').replace(/\n?```$/,'').trim();

    if(out.startsWith('COMPILE_ERROR:')||out.startsWith('SYNTAX_ERROR:')){
      tLine('── COMPILE ERROR ──','warn');
      out.replace(/^(COMPILE_ERROR:|SYNTAX_ERROR:)/,'').trim().split('\n').forEach(l=>{ if(l.trim()) tLine(l,'err'); });
      setStat('✗ COMPILE FAILED','err');
    } else if(out.startsWith('RUNTIME_ERROR:')){
      tLine('── RUNTIME ERROR ──','warn');
      out.replace('RUNTIME_ERROR:','').trim().split('\n').forEach(l=>{ if(l.trim()) tLine(l,'err'); });
      setStat('✗ RUNTIME ERROR','err');
    } else {
      let inIdx=0;
      const lines=out.split('\n');
      for(let li=0;li<lines.length;li++){
        const line=lines[li];
        if(inIdx<inputs.length){
          const inp=inputs[inIdx];
          const inpTrim=inp.trim();
          if(inpTrim&&line.trimEnd().endsWith(inpTrim)){
            const cutAt=line.lastIndexOf(inpTrim);
            const promptPart=line.slice(0,cutAt);
            const sp=document.createElement('span');
            sp.className='t-line';
            sp.innerHTML=`<span style="color:#9ba8c0">${escH(promptPart)}</span><span style="color:#82cfff;font-weight:600">${escH(inpTrim)}</span>`;
            termOut.appendChild(sp); termOut.scrollTop=termOut.scrollHeight;
            inIdx++; continue;
          }
          const nextLine=lines[li+1]!==undefined?lines[li+1].trim():'';
          if(inpTrim&&nextLine===inpTrim){
            const sp=document.createElement('span');
            sp.className='t-line';
            sp.innerHTML=`<span style="color:#9ba8c0">${escH(line)}</span><span style="color:#82cfff;font-weight:600"> ${escH(inpTrim)}</span>`;
            termOut.appendChild(sp); termOut.scrollTop=termOut.scrollHeight;
            inIdx++; li++; continue;
          }
          if(inpTrim&&line.trim()===inpTrim&&li>0){
            tLine(line,'inp'); inIdx++; continue;
          }
        }
        tLine(line,'');
      }
      tLine('─'.repeat(38),'');
      tLine('▸ Process finished with exit code 0 ✓','ok');
      setStat('✓ COMPLETE','ok');
    }
  } catch(err){
    tLine('── ERROR ──','warn');
    tLine(err.message,'err');
    setStat('✗ ERROR','err');
  } finally{
    isRunning=false; runBtn.disabled=false;
    runBtn.innerHTML='<svg viewBox="0 0 16 16" fill="currentColor"><path d="M3 2.5l10 5.5-10 5.5V2.5z"/></svg> RUN';
  }
}

function escH(t){ return String(t||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }

// ── BRACKET COLOUR OVERLAY ──
// Renders ALL text with bracket chars coloured — uses transform for scroll sync
// so colours never disappear regardless of scroll position.
function renderBracketOverlay(){
  const ov = document.getElementById('brc-overlay');
  const text = editor.value;

  // Size the overlay to the full scroll content so transform works correctly
  ov.style.width  = editor.scrollWidth  + 'px';
  ov.style.height = editor.scrollHeight + 'px';

  const OPEN  = new Set(['{','(','[']);
  const CLOSE = new Set(['}',')',']']);
  const CLS   = { '{':'bcc','}':'bcc', '(':'bcp',')':'bcp', '[':'bcs',']':'bcs' };

  let html = '';
  let inStr = false, strCh = '';
  for(let i = 0; i < text.length; i++){
    const ch = text[i];
    // Simple string detection to avoid colouring brackets inside strings
    if(!inStr && (ch==='"' || ch==="'")){
      inStr = true; strCh = ch;
      html += escH(ch); continue;
    }
    if(inStr && ch === strCh){ inStr = false; html += escH(ch); continue; }
    if(inStr){ html += escH(ch); continue; }

    if(ch === '\n'){ html += '\n'; continue; }

    if(OPEN.has(ch) || CLOSE.has(ch)){
      html += `<span class="${CLS[ch]}">${escH(ch)}</span>`;
    } else {
      html += escH(ch);
    }
  }

  ov.innerHTML = html;
  // Apply current scroll offset via transform so it stays aligned
  ov.style.transform = `translate(-${editor.scrollLeft}px, -${editor.scrollTop}px)`;
}

// ── BRACKET GUIDES (dashed vertical lines) ──
const canvas = document.getElementById('bracket-canvas');
const ctx    = canvas.getContext('2d');
function drawGuides(){
  const cont = document.getElementById('editor-container');
  const W = cont.clientWidth, H = cont.clientHeight;
  canvas.width = W; canvas.height = H;

  const lines = editor.value.split('\n');
  const tmp = document.createElement('canvas');
  const tc  = tmp.getContext('2d');
  tc.font   = '13px JetBrains Mono,monospace';
  const cW  = tc.measureText('M').width;
  const lH  = 13 * 1.75;
  const PL  = 12, PT = 14;
  const ST  = editor.scrollTop, SL = editor.scrollLeft;

  ctx.clearRect(0, 0, W, H);

  const OPEN  = { '{':'}', '(':')','[':']' };
  const CLOSE = new Set(['}',')',']']);
  const stack = [], pairs = [];

  for(let li = 0; li < lines.length; li++){
    const line = lines[li];
    let inS = false, sC = '';
    for(let ci = 0; ci < line.length; ci++){
      const ch = line[ci];
      if(!inS && (ch==='"' || ch==="'")){ inS=true; sC=ch; continue; }
      if(inS && ch===sC){ inS=false; continue; }
      if(inS) continue;
      if(OPEN[ch]) stack.push({ line:li, col:ci, ch });
      else if(CLOSE.has(ch) && stack.length > 0){
        const top = stack[stack.length-1];
        if(OPEN[top.ch] === ch){
          stack.pop();
          if(top.line !== li) pairs.push({ oL:top.line, oC:top.col, cL:li, ch:top.ch });
        }
      }
    }
  }

  const COL = {
    '{': 'rgba(74,222,128,0.45)',   /* green — matches {} */
    '(': 'rgba(217,70,239,0.45)',   /* purple — matches () */
    '[': 'rgba(248,113,113,0.45)'   /* red — matches [] */
  };

  ctx.lineWidth = 1.5;

  for(const p of pairs){
    const x  = PL + p.oC * cW + cW * 0.5 - SL;
    if(x < 0 || x > W) continue;

    // Top: one line below the opening bracket line
    const yT = PT + (p.oL + 1) * lH - ST;
    // Bottom: top of the closing bracket line
    const yB = PT + p.cL * lH - ST;

    // Skip only if BOTH ends are outside viewport
    if(yB < 0 || yT > H) continue;

    const drawTop = Math.max(0, yT);
    const drawBot = Math.min(H, yB);

    ctx.strokeStyle = COL[p.ch] || 'rgba(150,150,200,0.20)';

    // Dashed vertical line
    ctx.setLineDash([3, 4]);
    ctx.beginPath();
    ctx.moveTo(x, drawTop);
    ctx.lineTo(x, drawBot);
    ctx.stroke();

    // Solid small horizontal tick at close
    if(yB >= 0 && yB <= H){
      ctx.setLineDash([]);
      ctx.beginPath();
      ctx.moveTo(x, yB);
      ctx.lineTo(x + cW * 0.65, yB);
      ctx.stroke();
    }
  }
  ctx.setLineDash([]);
}

// ── RESIZE ──
const rh=document.getElementById('resize-handle');
const tp=document.getElementById('terminal-panel');
let rsz=false,rsY=0,rsH=0;
rh.addEventListener('pointerdown',e=>{ rsz=true;rsY=e.clientY;rsH=tp.offsetHeight;rh.setPointerCapture(e.pointerId); });
rh.addEventListener('pointermove',e=>{ if(!rsz)return; tp.style.height=Math.max(80,Math.min(window.innerHeight*.75,rsH+(rsY-e.clientY)))+'px'; });
rh.addEventListener('pointerup',()=>rsz=false);

// ── MODALS ──
document.getElementById('save-overlay').addEventListener('click',e=>{ if(e.target.id==='save-overlay') closeSave(); });
document.getElementById('save-filename').addEventListener('keydown',e=>{ if(e.key==='Enter') confirmSave(); if(e.key==='Escape') closeSave(); });

// ── THEME SWITCHER ──
function setTheme(t){
  document.documentElement.setAttribute('data-theme', t==='dark' ? '' : t);
  ['dark','white','blue'].forEach(n=>{
    const btn = document.getElementById('th-'+n);
    btn.style.background = n===t ? 'var(--cyan)' : 'transparent';
    btn.style.color      = n===t ? 'var(--text-inv)' : 'var(--text2)';
  });
  localStorage.setItem('sharppad_theme', t);
  setTimeout(()=>{ drawGuides(); renderBracketOverlay(); }, 30);
}
(function(){
  const saved = localStorage.getItem('sharppad_theme') || 'dark';
  if(saved !== 'dark') setTheme(saved);
})();

// ── INIT ──
updateLines();
renderBracketOverlay();
drawGuides();
window.addEventListener('resize', ()=>{ drawGuides(); renderBracketOverlay(); });
</script>
</body>
</html>
