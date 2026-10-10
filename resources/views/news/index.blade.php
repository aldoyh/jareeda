<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta charset="utf-8">
    <title>News – Jareeda</title>
    <link rel="stylesheet" href="{{ asset('build/assets/public-CoFDkYn0.css') }}">
</head>
<body class="bg-white">
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">News</h1>
    <div class="grid gap-6">
        @foreach($articles as $article)
            <article class="border rounded p-4">
                <h2 class="text-xl font-semibold">{{ $article->title }}</h2>
                <p class="text-sm text-gray-600">{{ $article->source }} • {{ $article->published_at }}</p>
                @if($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->image_alt }}" class="my-3 max-w-full h-auto">
                @endif
                <p>{{ $article->excerpt }}</p>
                <a href="{{ $article->url }}" target="_blank" class="text-blue-600">Read more</a>
            </article>
        @endforeach
    </div>
</div>
</body>
</html>
