{{-- Newspaper Grid Layout --}}
{{-- Usage: @include('vendor.core.public._newspaper-grid', ['articles' => $articles, 'featured' => $featured]) --}}

<section class="newspaper-section" aria-label="{{ trans('Latest news') }}">
    {{-- Masthead --}}
    <header class="newspaper-masthead">
        <h1 class="newspaper-masthead__title">
            {{ $siteName ?? config('app.name', 'Jareeda') }}
        </h1>
        @if(isset($subtitle))
            <p class="newspaper-masthead__subtitle">{{ $subtitle }}</p>
        @endif
        <p class="newspaper-masthead__date">
            <time datetime="{{ now()->toIso8601Date() }}">
                {{ now()->format('l, F j, Y') }}
            </time>
        </p>
    </header>

    {{-- Featured Article --}}
    @if(isset($featured) && $featured)
        <article class="newspaper-featured">
            @if($featured->image)
                <img
                    src="{{ $featured->image }}"
                    alt="{{ $featured->image_alt ?? $featured->title }}"
                    class="newspaper-featured__image"
                    loading="eager"
                    width="1200"
                    height="630"
                >
            @endif

            <h2 class="newspaper-featured__title">
                <a href="{{ route('news.show', $featured->slug) }}">
                    {{ $featured->title }}
                </a>
            </h2>

            @if($featured->excerpt)
                <p class="newspaper-featured__excerpt">
                    {{ $featured->excerpt }}
                </p>
            @endif

            <div class="newspaper-featured__meta">
                @if($featured->author)
                    <span class="newspaper-article__author">
                        {{ $featured->author->name }}
                    </span>
                @endif
                <span class="newspaper-article__time">
                    · {{ $featured->created_at->diffForHumans() }}
                </span>
            </div>
        </article>
    @endif

    {{-- Article Grid --}}
    <div class="newspaper" role="feed" aria-label="{{ trans('All news') }}">
        @foreach($articles as $article)
            @include('vendor.core.public._article-card', ['article' => $article])
        @endforeach
    </div>

    {{-- Pagination --}}
    @if(isset($articles) && $articles instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <nav class="newspaper-pagination" aria-label="{{ trans('pagination.navigation') }}">
            {{ $articles->links() }}
        </nav>
    @endif
</section>
