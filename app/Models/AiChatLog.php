<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiChatLog extends Model
{
    protected $table = 'ai_chat_logs';
    public $timestamps = false;

    protected $fillable = [
        'session_id',
        'user_id',
        'sender_name',
        'user_message',
        'bot_reply',
        'detected_intent',
        'engine_used',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
