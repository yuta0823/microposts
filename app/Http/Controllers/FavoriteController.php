<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Micropost;

class FavoriteController extends Controller
{
    // お気に入りに追加
    public function store(string $micropostId)
    {
    // 認証済みユーザー（閲覧者）が、 お気に入りする
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        $user->favorite(intval($micropostId));
        // 前のURLへリダイレクトさせる
        return back();
    }
    // お気に入りから削除
    public function destroy(string $micropostId)
    {
     // 認証済みユーザー（閲覧者）が、 お気に入りを外す
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        $user->unfavorite(intval($micropostId));
        // 前のURLへリダイレクトさせる
        return back();
    }
}

