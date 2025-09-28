<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    /** @use HasFactory<\Database\Factories\MicropostFactory> */
    use HasFactory;

    protected $fillable = ['content'];

    /**
     * この投稿を所有するユーザー。（Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorite_users()
{
    return $this->belongsToMany(User::class, 'user_favorites', 'micropost_id', 'user_id')->withTimestamps();
}
}
