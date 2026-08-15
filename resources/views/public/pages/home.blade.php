<x-core::layouts.page :$page>
    <x-slot:header-title>
        <h1 class="header-title"><x-core::header-title /></h1>
    </x-slot:header-title>

    <div class="page-body">
        <div class="page-body-container">
            @include('public::pages._main-content', ['page' => $page])
        </div>
    </div>

    {{-- Newspaper Layout: Latest Bahrain News --}}
    @php
        $latestNews = \App\Models\News::query()
            ->published()
            ->select('id', 'slug', 'title', 'excerpt', 'url', 'source', 'author', 'image', 'image_alt', 'ai_generated_image', 'ai_generated_image_path', 'category', 'language', 'published_at')
            ->orderByDesc('published_at')
            ->limit(30)
            ->get();
        $featuredArticle = $latestNews->first();
        $remainingArticles = $latestNews->skip(1);
    @endphp

    @if($latestNews->count() > 0)
        <section class="newspaper-section" aria-label="{{ __('Latest news') }}">
            {{-- Masthead --}}
            <div class="newspaper-masthead">
                <h2 class="newspaper-masthead__title">{{ __('Latest News') }}</h2>
                <p class="newspaper-masthead__subtitle">{{ __('Bahrain News Roundup') }}</p>
                <p class="newspaper-masthead__date">
                    <time datetime="{{ now()->format('Y-m-d') }}">
                        {{ now()->format('l, F j, Y') }}
                    </time>
                </p>
                <hr class="newspaper-masthead__rule">
            </div>

            {{-- Featured Article --}}
            @if($featuredArticle)
                <article class="newspaper-featured">
                    @if($featuredArticle->hasImage())
                        <img
                            src="{{ $featuredArticle->getFeaturedImageUrl() }}"
                            alt="{{ $featuredArticle->image_alt ?? $featuredArticle->getTitle() }}"
                            class="newspaper-featured__image"
                            loading="eager"
                            width="1200"
                            height="630"
                        >
                    @endif

                    <h3 class="newspaper-featured__title">
                        @if($featuredArticle->url)
                            <a href="{{ $featuredArticle->url }}" target="_blank" rel="noopener">
                                {{ $featuredArticle->getTitle() }}
                            </a>
                        @else
                            {{ $featuredArticle->getTitle() }}
                        @endif
                    </h3>

                    @if($featuredArticle->getExcerpt())
                        <p class="newspaper-featured__excerpt">
                            {{ $featuredArticle->getExcerpt() }}
                        </p>
                    @endif

                    <div class="newspaper-featured__meta">
                        @if($featuredArticle->author)
                            <span class="newspaper-article__author">
                                {{ $featuredArticle->author }}
                            </span>
                        @endif
                        @if($featuredArticle->source)
                            <span class="newspaper-article__source">
                                · {{ $featuredArticle->source }}
                            </span>
                        @endif
                        @if($featuredArticle->published_at)
                            <span class="newspaper-article__time">
                                · {{ $featuredArticle->published_at->diffForHumans() }}
                            </span>
                        @endif
                    </div>
                </article>
            @endif

            {{-- Article Grid --}}
            <div class="newspaper" role="feed" aria-label="{{ __('All news') }}">
                @foreach($remainingArticles as $article)
                    <article class="newspaper-article" aria-labelledby="news-{{ $article->id }}-title">
                        {{-- Article Image --}}
                        @if($article->hasImage())
                            @if($article->url)
                                <a href="{{ $article->url }}" target="_blank" rel="noopener" class="newspaper-article__image-link">
                                    <img
                                        src="{{ $article->getFeaturedImageUrl() }}"
                                        alt="{{ $article->image_alt ?? $article->getTitle() }}"
                                        class="newspaper-article__image"
                                        loading="lazy"
                                        width="400"
                                        height="225"
                                    >
                                </a>
                            @else
                                <img
                                    src="{{ $article->getFeaturedImageUrl() }}"
                                    alt="{{ $article->image_alt ?? $article->getTitle() }}"
                                    class="newspaper-article__image"
                                    loading="lazy"
                                    width="400"
                                    height="225"
                                >
                            @endif
                            @if($article->ai_generated_image)
                                <span class="newspaper-article__ai-badge">
                                    {{ __('AI Generated') }}
                                </span>
                            @endif
                        @endif

                        {{-- Article Category --}}
                        @if($article->category)
                            <div class="newspaper-article__category">
                                {{ $article->category }}
                            </div>
                        @endif

                        {{-- Article Title --}}
                        <h3 class="newspaper-article__title" id="news-{{ $article->id }}-title">
                            @if($article->url)
                                <a href="{{ $article->url }}" target="_blank" rel="noopener">
                                    {{ $article->getTitle() }}
                                </a>
                            @else
                                {{ $article->getTitle() }}
                            @endif
                        </h3>

                        {{-- Article Excerpt --}}
                        @if($article->getExcerpt())
                            <p class="newspaper-article__excerpt">
                                {{ Str::limit($article->getExcerpt(), 200) }}
                            </p>
                        @endif

                        {{-- Article Meta --}}
                        <footer class="newspaper-article__meta">
                            @if($article->author)
                                <span class="newspaper-article__author">
                                    {{ $article->author }}
                                </span>
                            @endif
                            @if($article->source)
                                <span class="newspaper-article__source">
                                    · {{ $article->source }}
                                </span>
                            @endif
                            <time class="newspaper-article__time" datetime="{{ $article->published_at?->toIso8601String() }}">
                                @if($article->published_at)
                                    {{ $article->published_at->format('M j, Y') }}
                                @endif
                            </time>
                        </footer>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
</x-core::layouts.page>
