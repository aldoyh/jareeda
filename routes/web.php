<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('{locale}/news', function ($locale) {
    $articles = DB::table('news')
        ->where('language', $locale)
        ->orderByDesc('published_at')
        ->limit(100)
        ->get();

    return response()->view('news.index', ['articles' => $articles, 'locale' => $locale]);
})->where('locale', 'en|ar|es|fr|nl');
