<x-core::layouts.page :$page>
    @php
        $locale = app()->getLocale();
        $isArabic = $locale === 'ar';
        $currentPage = (int) request()->query('page', 1);
        $perPage = 20;

        $newsQuery = \App\Models\News::query()
            ->published()
            ->select('id', 'slug', 'title', 'excerpt', 'url', 'source', 'author', 'image', 'image_alt', 'ai_generated_image', 'ai_generated_image_path', 'category', 'language', 'published_at')
            ->orderByDesc('published_at');

        $allNews = $newsQuery->clone()->paginate($perPage);
        $featuredArticle = $currentPage === 1 ? $newsQuery->clone()->first() : null;
    @endphp

    {{-- SEO Structured Data (JSON-LD) --}}
    @php
        $schemaData = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => config('app.name', 'Jareeda'),
            'description' => $isArabic ? 'آخر أخبار البحرين - صحيفة إلكترونية شاملة' : 'Latest Bahrain News - Comprehensive Digital Newspaper',
            'url' => url('/'),
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => url('/') . '/search?q={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
            'inLanguage' => ['en', 'ar'],
            'publisher' => [
                '@type' => 'Organization',
                'name' => config('app.name', 'Jareeda'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('storage/logo.png'),
                ],
            ],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

    @if($featuredArticle)
    @php
        $articleSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'NewsArticle',
            'headline' => $featuredArticle->getTitle(),
            'description' => Str::limit(strip_tags($featuredArticle->getExcerpt() ?? ''), 200),
            'image' => $featuredArticle->getFeaturedImageUrl(),
            'datePublished' => $featuredArticle->published_at?->toIso8601String(),
            'author' => [
                '@type' => 'Person',
                'name' => $featuredArticle->author ?? 'Unknown',
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => config('app.name', 'Jareeda'),
            ],
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => url('/'),
            ],
            'articleSection' => $featuredArticle->category ?? 'News',
            'inLanguage' => $featuredArticle->language ?? 'en',
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($articleSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @endif

    @php
        $itemListSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'ItemList',
            'name' => $isArabic ? 'آخر أخبار البحرين' : 'Latest Bahrain News',
            'description' => $isArabic ? 'قائمة بآخر أخبار البحرين' : 'List of latest Bahrain news articles',
            'numberOfItems' => $allNews->total(),
            'itemListElement' => [],
        ];
        foreach ($allNews as $index => $article) {
            $itemListSchema['itemListElement'][] = [
                '@type' => 'ListItem',
                'position' => $allNews->firstItem() + $index,
                'item' => [
                    '@type' => 'NewsArticle',
                    'headline' => $article->getTitle(),
                    'description' => Str::limit(strip_tags($article->getExcerpt() ?? ''), 150),
                    'url' => $article->url ?? url('/'),
                    'datePublished' => $article->published_at?->toIso8601String(),
                ],
            ];
        }
    @endphp
    <script type="application/ld+json">{!! json_encode($itemListSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

    <x-slot:header-title>
        <h1 class="header-title"><x-core::header-title /></h1>
    </x-slot:header-title>

    <div class="page-body">
        <div class="page-body-container">
            @include('public::pages._main-content', ['page' => $page])
        </div>
    </div>

    {{-- Newspaper Layout: Latest Bahrain News --}}
    @if($allNews->count() > 0)
        {{-- Set dir="rtl" on html for Arabic --}}
        @push('js')
            @if($isArabic)
                <script>document.documentElement.setAttribute('dir', 'rtl');</script>
            @endif
        @endpush

        <section class="newspaper-section" aria-label="{{ __('Latest news') }}">
            <div class="container-xl">
                {{-- Masthead --}}
                <div class="newspaper-masthead">
                    <h2 class="newspaper-masthead__title">
                        {{ $isArabic ? 'آخر الأخبار' : __('Latest News') }}
                    </h2>
                    <p class="newspaper-masthead__subtitle">
                        {{ $isArabic ? 'ملخص أخبار البحرين' : __('Bahrain News Roundup') }}
                    </p>
                    <p class="newspaper-masthead__date">
                        <time datetime="{{ now()->format('Y-m-d') }}">
                            @if($isArabic)
                                {{ now()->locale('ar')->translatedFormat('l، j F Y') }}
                            @else
                                {{ now()->format('l, F j, Y') }}
                            @endif
                        </time>
                    </p>
                    <hr class="newspaper-masthead__rule">
                </div>

                {{-- Featured Article (page 1 only) --}}
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
                    @foreach($allNews as $article)
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
                                <time class="newspaper-article__time" datetime="{{ $article->published_at?->format('Y-m-d\TH:i:sP') }}">
                                    @if($article->published_at)
                                        @if($isArabic)
                                            {{ $article->published_at->format('j M Y') }}
                                        @else
                                            {{ $article->published_at->format('M j, Y') }}
                                        @endif
                                    @endif
                                </time>
                            </footer>
                        </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <nav class="newspaper-pagination" aria-label="{{ $isArabic ? 'التنقل بين الصفحات' : 'Article pagination' }}">
                    {{ $allNews->withQueryString()->links() }}
                </nav>
            </div>
        </section>
    @endif
</x-core::layouts.page>
