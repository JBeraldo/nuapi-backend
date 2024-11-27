<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'comment',
        'read_at',
        'user_id'
    ];

    protected $attributes = [
        'read'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function getReadAttribute(){
        return (bool) $this->read_at;
    }
}
