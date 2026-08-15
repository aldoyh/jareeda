{{-- Newspaper Article Card --}}
{{-- Usage: @include('vendor.core.public._article-card', ['article' => $article]) --}}

<article class="newspaper-article" aria-labelledby="article-{{ $article->id }}-title">
    {{-- Article Image --}}
    @if($article->image)
        <a href="{{ route('news.show', $article->slug) }}" class="newspaper-article__image-link">
            <img
                src="{{ $article->image }}"
                alt="{{ $article->image_alt ?? $article->title }}"
                class="newspaper-article__image"
                loading="lazy"
                width="400"
                height="225"
            >
        </a>
    @elseif($article->ai_generated_image)
        {{-- AI Generated Image --}}
        <a href="{{ route('news.show', $article->slug) }}" class="newspaper-article__image-link">
            <img
                src="{{ $article->ai_generated_image_path }}"
                alt="{{ $article->image_alt ?? $article->title }}"
                class="newspaper-article__image"
                loading="lazy"
                width="400"
                height="225"
            >
        </a>
        <span class="newspaper-article__ai-badge">
            {{ trans('AI Generated') }}
        </span>
    @endif

    {{-- Article Category --}}
    @if($article->categories->count())
        <div class="newspaper-article__category">
            {{ $article->categories->first()->title }}
        </div>
    @endif

    {{-- Article Title --}}
    <h3 class="newspaper-article__title" id="article-{{ $article->id }}-title">
        <a href="{{ route('news.show', $article->slug) }}">
            {{ $article->title }}
        </a>
    </h3>

    {{-- Article Excerpt --}}
    @if($article->excerpt)
        <p class="newspaper-article__excerpt">
            {{ Str::limit(strip_tags($article->excerpt), 150) }}
        </p>
    @endif

    {{-- Article Meta --}}
    <footer class="newspaper-article__meta">
        @if($article->author)
            <span class="newspaper-article__author">
                {{ $article->author->name }}
            </span>
        @endif
        <time class="newspaper-article__time" datetime="{{ $article->created_at->toIso8601String() }}">
            {{ $article->created_at->format('M j, Y') }}
        </time>
    </footer>
</article>
