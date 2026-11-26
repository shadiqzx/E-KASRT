<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiSetting extends Model
{
    protected $table = 'ai_settings';
    public $timestamps = false;

    protected $fillable = [
        'bot_name',
        'welcome_message',
        'gemini_api_key',
        'gemini_model',
        'system_prompt',
        'whatsapp_cs',
        'is_enabled',
        'updated_at',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
    ];
}
