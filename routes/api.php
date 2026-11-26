<?php

use App\Http\Controllers\AiCsController;
use App\Http\Controllers\RfidController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ESP32 RFID / e-KTP & AI Customer Service API Routes (Bebas CSRF)
|--------------------------------------------------------------------------
| Prefix URL otomatis: /api/...
*/

Route::post('/rfid/tap', [RfidController::class, 'tap'])->name('api.rfid.tap');
Route::post('/rfid/heartbeat', [RfidController::class, 'heartbeat'])->name('api.rfid.heartbeat');
Route::get('/rfid/status', [RfidController::class, 'status'])->name('api.rfid.status');

Route::post('/ai-cs/chat', [AiCsController::class, 'chat'])->name('api.ai_cs.chat');

