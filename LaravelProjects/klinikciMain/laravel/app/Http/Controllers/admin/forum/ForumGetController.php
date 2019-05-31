<?php

namespace App\Http\Controllers\admin\forum;

use App\Models\Forum_konu;
use App\Models\Forum_konu_mesaj;
use App\Models\Forum_konu_kategori;
use App\Http\Controllers\Controller;

class ForumGetController extends Controller
{
    public function kategoriler()
    {
        $kategoriler = Forum_konu_kategori::all();

        return view('admin.forum.forum-kategoriler', [
            'kategoriler' => $kategoriler]
        );
    } 

    public function konuMesajlar($konuId)
    {
        $mesajlar = Forum_konu_mesaj::where('forum_konular_id',urldecode(trim($konuId)))->get();

        return view('admin.forum.forum-konu-mesajlar', [
            'mesajlar' => $mesajlar]
        );
    }

    public function konular($kategoriId)
    {
        $kategori = Forum_konu_kategori::findOrFail($kategoriId);
        $konular=$kategori->konular;
        // dd($konular);
        return view('admin.forum.forum-konular', [
            'konular' => $konular]
        );
    }
}
