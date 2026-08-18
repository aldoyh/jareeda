# جَرِيدة (Jareeda)

جَرِيدة هو نظام إدارة محتوى (CMS) ثنائي اللغة (اللغة الإنجليزية / العربية)،[9D[K
العربية)، مبني على [TypiCMS](https://typicms.org) و [Laravel 13](https://la[14D[K
13](https://laravel.com/docs/13.x).

| وقت التشغيل (Runtime) | الإصدار (Version) |
| :--- | :--- |
| PHP | 8.5.9 (`^8.4`) |
| Laravel | 13.25.0 |
| TypiCMS Core | 17.0.39 |
| Vite | 8.2.1 |
| Vue | 3.5 |

ملاحظات الترقية الأخيرة ولقطات الشاشة: [docs/upgrade-2026.md](docs/upgrade-[36D[K
[docs/upgrade-2026.md](docs/upgrade-2026.md).
قرار البنية المعمارية: [docs/decisions/ADR-001-laravel-13-typicms-17.md](do[52D[K
[docs/decisions/ADR-001-laravel-13-typicms-17.md](docs/decisions/ADR-001-la[docs/decisions/ADR-001-laravel-13-typicms-17.md](dos/decisions/ADR-001-laravel-13-typicms-17.md).
خط أنابيب الأخبار (جلب البيانات، الصور، التخزين المؤقت): [docs/NEWS_PIPELIN[18D[K
[docs/NEWS_PIPELINE.md](docs/NEWS_PIPELINE.md) · [docs/NEWSAPI.md](docs/NEW[26D[K
[docs/NEWSAPI.md](docs/NEWSAPI.md).

| فاتح (Light) | داكن (Dark) |
| :--- | :--- |
| ![English home, light theme](docs/screenshots/home-en-light.webp) الصفحة [K
الرئيسية بالإنجليزية، المظهر الفاتح | ![English home, dark theme](docs/scre[16D[K
theme](docs/screenshots/home-en-dark.webp) الصفحة الرئيسية بالإنجليزية، الم[3D[K
المظهر الداكن |
| ![Arabic home, light theme, RTL](docs/screenshots/home-ar-rtl-light.webp)[45D[K
RTL](docs/screenshots/home-ar-rtl-light.webp) الصفحة الرئيسية بالعربية، الم[3D[K
المظهر الفاتح (من اليمين لليسار) | ![Arabic home, dark theme](docs/screensh[20D[K
theme](docs/screenshots/home-ar-rtl-dark.webp) الصفحة الرئيسية بالعربية، ال[2D[K
المظهر الداكن (من اليمين لليسار) |

## جدول المحتويات

-   [البدء السريع](#quick-start)
-   [الميزات](#features)
-   [المتطلبات](#requirements)
-   [التثبيت](#installation)
    -   [الأصول (Assets)](#assets)
    -   [تهيئة اللغات (Locales configuration)](#locales-configuration)
    -   [تثبيت وحدة (Installation of a module)](#installation-of-a-module)
-   [الوحدات المتاحة](#available-modules)
    -   [الصفحات (Pages)](#pages)
    -   [القوائم (Menus)](#menus)
    -   [المشاريع (Projects)](#projects)
    -   [العلامات (Tags)](#categories)
    -   [الفعاليات (Events)](#events)
    -   [الأخبار (News)](#news)
    -   [جهات الاتصال (Contacts)](#contacts)
    -   [الشركاء (Partners)](#partners)
    -   [الملفات (Files)](#files)
    -   [المستخدمون والأدوار (Users and roles)](#users-and-roles)
    -   [الكتل (Blocks)](#blocks)
    -   [الترجمات (Translations)](#translations)
    -   [خريطة الموقع (Sitemap)](#sitemap)
    -   [الإعدادات (Settings)](#settings)
    -   [التاريخ (History)](#history)
-   [واجهات الوصول (Facades)](#facades)
-   [أوامر Artisan](#artisan-commands)
-   [خارطة الطريق (Roadmap)](#roadmap)
-   [سجل التغييرات (Change log)](#change-log)
-   [المساهمة (Contributing)](#contributing)
-   [الاعتمادات (Credits)](#credits)
-   [الرخصة (Licence)](#licence)

## البدء السريع (Quick start)

```bash
composer install
pnpm install
cp .env.example .env   # إذا لزم الأمر
php artisan key:generate --no-interaction
php artisan migrate --no-interaction
pnpm build
php artisan serve --host=127.0.0.1 --port=8010 --no-interaction
```

الموقع العام: http://127.0.0.1:8010/en و http://127.0.0.1:8010/ar
لوحة التحكم: http://127.0.0.1:8010/admin (يُعاد توجيهه إلى صفحة تسجيل الدخو[5D[K
الدخول المترجمة)

| الأمر (Command) | الوصف (Description) |
| :--- | :--- |
| `pnpm dev` | خادم تطوير Vite |
| `pnpm build` | الأصول (Assets) للإنتاج |
| `composer run dev` | التطبيق، وقائمة الانتظار (Queue)، والسجلات، و Vite م[1D[K
معًا |
| `vendor/bin/pint --dirty` | تنسيق ملفات PHP المتغيرة |

## الميزات (Features)

### عناوين URL (URLs)

تتم إدارة أنواع عناوين URL هذه بواسطة نظام إدارة المحتوى (CMS):

**الوحدات (Modules):**

-   `/en/events/slug-in-english`
-   `/fr/evenements/slug-en-francais`

**الصفحات (Pages):**

-   `/en/parent-pages-slug-en/subpage-slug-en/page-slug-en`
-   `/fr/parent-pages-slug-fr/subpage-slug-fr/page-slug-fr`

## المتطلبات (Requirements)

-   PHP 8.4+ (8.5.9 هو وقت التشغيل المحلي الحالي)
-   SQLite (افتراضي محلي) أو MySQL 8 / MariaDB
-   Composer 2.10+
-   Node 22+ و pnpm 11+ (أو Bun) لـ Vite 8
-   إضافات PHP المطلوبة: BCMath, Ctype, JSON, Mbstring, OpenSSL, PDO, Token[5D[K
Tokenizer, XML

## التثبيت (Installation)

ثبّت أولاً [Composer](https://getcomposer.org)

1. إنشاء مشروع جديد

    ```
    composer create-project typicms/base mywebsite
    ```

2. الدخول إلى المجلد الذي تم إنشاؤه حديثًا

    ```
    cd mywebsite
    ```

3. ترحيل قاعدة البيانات، وتغذيتها بالبيانات، وإنشاء المستخدم، وتثبيت حزم np[2D[K
npm وتصاريح الدليل.

    ```
    php artisan typicms:install
    ```

**ملاحظة:** إذا كنت تستخدم MariaDB، قم بتعيين 'mariadb' إلى `true` في ملف `[1D[K
`config/typicms.php`.

توجه إلى http://mywebsite.test/admin وسجل الدخول.

### الأصول (Assets)

يتم تجميع الأصول باستخدام [Vite 8](https://laravel.com/docs/13.x/vite) و `l[2D[K
`laravel-vite-plugin` 3.

```bash
pnpm install
pnpm dev      # للمراقبة (watch)
pnpm build    # للإنتاج (production)
```

لا يزال بإمكان Bun (باستخدام `bun install` / `bun run dev`) العمل إذا كان م[1D[K
مدير الحزم المحلي الخاص بك هو Bun. بعد تغييرات الواجهة الأمامية، أعد بناء ا[1D[K
الأصول أو قم بتشغيل خادم تطوير Vite وإلا سيستمر الواجهة في خدمة محتوى `publ[5D[K
`public/build`.

### تهيئة اللغات (Locales configuration)

1. عيّن اللغات في `config/typicms.php`. يجب أن تكون المفاتيح الأولى في هذه [K
المصفوفة هي اللغة الرئيسية ويجب أن تتطابق مع اللغة المحددة في `config/app.p[13D[K
`config/app.php`.
2. عيّن `main_locale_in_url` في `config/typicms.php` إلى `true` أو `false`.[8D[K
`false`.

### تثبيت وحدة (Installation of a module)

هذا المثال خاص بوحدة الأخبار (News). بعد هذه الخطوات، ستظهر الوحدة في الشري[5D[K
الشريط الجانبي لـ "خلف المكتب" (Back Office).
إذا كنت تحتاج إلى تخصيصها، يمكنك [نشرها](#publish-a-module)!

1. تثبيت الوحدة باستخدام Composer

    ```
    composer require typicms/news
    ```

2. أضف `TypiCMS\Modules\News\Providers\ModuleServiceProvider::class,` إلى *[1D[K
**`config/app.php`**، قبل `TypiCMS\Modules\Core\Providers\ModuleServiceProv[49D[K
`TypiCMS\Modules\Core\Providers\ModuleServiceProvider::class,`
3. نشر العروض (Views) والترايحات (Migrations)

    ```
    php artisan vendor:publish
    ```

4. ترحيل قاعدة البيانات

    ```
    php artisan migrate
    ```

### الهيكل الأولي للوحدة (Module scaffolding)

لنقم بإنشاء وحدة تسمى Cats.

1. إنشاء الوحدة باستخدام artisan:

    ```
    php artisan typicms:create cats
    ```

2. تقع الوحدة في المسار **/Modules/Cats**، ويمكنك تخصيصها
3. أضف `TypiCMS\Modules\Cats\Providers\ModuleServiceProvider::class,` إلى *[1D[K
**`config/app.php`**، قبل `TypiCMS\Modules\Core\Providers\ModuleServiceProv[49D[K
`TypiCMS\Modules\Core\Providers\ModuleServiceProvider::class,`
4. ترحيل قاعدة البيانات

    ```
    php artisan migrate
    ```

## الوحدات المتاحة (Available modules)

يمكن [نشر](#publish-a-module) كل وحدة.

### الصفحات (Pages)

يمكن للصفحات التعشيش (Nestable) باستخدام السحب والإفلات. عند إسقاط الصفحة، [K
يتم إنشاء وحفظ عناوين URL في قاعدة البيانات.
لكل ترجمة للصفحة مسار خاص بها.
يمكن ربط صفحة بوحدة (Module).
يمكن أن تحتوي الصفحة على أقسام متعددة.

### القوائم (Menus)

تحتوي كل قائمة على عناصر قابلة للتعشيش. يمكن ربط عنصر واحد بصفحة أو برابط U[1D[K
URL.
يمكنك إرجاع قائمة منسقة باستخدام `Menus::render('menuname')` أو `@menu('men[11D[K
`@menu('menuname')`.

### المشاريع (Projects)

تحتوي المشاريع على فئات (Categories)، ويتبع عنوان URL الخاص بالمشاريع النمط[5D[K
النمط التالي: /en/projects/category-slug/project-slug

### العلامات (Tags)

ترتبط العلامات بالمشاريع وتستخدم إضافة [Selectize](https://brianreavis.gith[36D[K
[Selectize](https://brianreavis.github.io/selectize.js/).
تحتوي وحدة العلامات على علاقات متعدد إلى متعدد (many to many polymorphic re[2D[K
relations)، لذا يمكن ربط علامة بسهولة بأي وحدة.

### الفعاليات (Events)

تحتوي الفعاليات على تواريخ بداية ونهاية.

### الأخبار (News)

بالإضافة إلى وحدة الأخبار القياسية في TypiCMS، يضيف Jareeda خط أنابيب تجميع[5D[K
تجميع كامل: جلبات مجدولة من NewsAPI.ai و NewsData.io ومصادر RSS البحرين، وإ[2D[K
وإزالة تكرار المقالات، وتخفيض متعدد المستويات للصور (الاجتثاث من المصدر → ا[1D[K
التوليد بالذكاء الاصطناعي → عنصر نائب SVG). راجع [docs/NEWS_PIPELINE.md](do[26D[K
[docs/NEWS_PIPELINE.md](docs/NEWS_PIPELINE.md) للحصول على الأوامر، واستراتي[8D[K
واستراتيجية التخزين المؤقت، والمشاكل المعروفة.

يحتوي الموقع العام أيضًا على زر تبديل (toggle) للمظهر الداكن (محفوظ في `loc[4D[K
`localStorage`، ويحترم `prefers-color-scheme`) وتخطيط كامل للعربية من اليمي[5D[K
اليمين لليسار (RTL) — انظر لقطات الشاشة أعلاه.

### جهات الاتصال (Contacts)

نموذج اتصال أمامي و إدارة السجلات في لوحة التحكم.

### الشركاء (Partners)

يحتاج الشريك إلى شعار وعنوان URL للموقع الإلكتروني والعنوان ومحتوى الجسم.

### الملفات (Files)

تسمح لك وحدة الملفات بتحميل وتنظيم الصور والمستندات والمجلدات. تعمل مع [Dro[4D[K
[DropzoneJS](http://www.dropzonejs.com) لعملية التحميل.
يتم إنشاء الصور المصغرة (Thumbnails) في الوقت الفعلي بفضل [Croppa](https://[17D[K
[Croppa](https://github.com/BKWLD/croppa).

إذا كنت تريد تخزين الصور الأصلية في خدمة تخزين مثل Amazon S3 والصور المقتطع[7D[K
المقتطعة في القرص المحلي، فقم بتعيين `FILESYSTEM_DRIVER=s3` في ملف **`.env`[8D[K
**`.env`**، وفي `config/croppa.php` قم بتعيين `'src_dir' => 'filesystem.def[15D[K
'filesystem.default.driver'` و `'crops_dir' => storage_path('app/public')`.[28D[K
storage_path('app/public')`.

### المستخدمون والأدوار (Users and roles)

يمكن تمكين تسجيل المستخدم من خلال لوحة الإعدادات (/admin/settings).
تتم إدارة الأدوار والأذونات باستخدام [spatie/laravel-permission](https://gi[38D[K
[spatie/laravel-permission](https://github.com/spatie/laravel-permission).

### الكتل (Blocks)

تعد الكتل مفيدة لعرض محتوى مخصص في عروضك (views).
يمكنك عرض محتوى الكتلة باستخدام `Blocks::render('blockname')` أو `@block('b[10D[K
`@block('blockname')`.

### الترجمات (Translations)

يمكن تخزين الترجمات في قاعدة البيانات عبر لوحة الإدارة (/admin/translations[20D[K
(/admin/translations).

يمكنك الحصول على ترجمة من قاعدة البيانات باستخدام وظائف Laravel القياسية: `[1D[K
`__('Key')`، أو `trans('Key')` أو `@lang('Key')`.

### خريطة الموقع (Sitemap)

يتم إنشاء خريطة الموقع عن طريق قراءة جميع الصفحات المتاحة في مشروعك. عنوان [K
URL هو /sitemap.xml.

### الإعدادات (Settings)

تغيير عنوان الموقع وشعاره وخيارات أخرى في لوحة الإعدادات.

### التاريخ (History)

يتم تسجيل إجراءات `_created_` و `_updated_` و `_deleted_` و `_online_` و `_[2D[K
`_offline_` في قاعدة البيانات.
يتم عرض أحدث السجلات في لوحة تحكم خلف المكتب.

## واجهات الوصول (Facades)

تحتوي كل وحدة على [واجهة وصول (Facade)](https://laravel.com/docs/master/fac[45D[K
(Facade)](https://laravel.com/docs/master/facades#main-content) تمنحك الوصو[5D[K
الوصول إلى النموذج (Model)، يمكنك استدعاء، على سبيل المثال `News::latest(3)[16D[K
`News::latest(3)` للحصول على آخر 3 أخبار.
تحقق من الطرق المتاحة في نماذج كل وحدة.

## أوامر Artisan (Artisan commands)

تقع الأوامر في المسار **/vendor/typicms/core/src/Commands**

### تثبيت TypiCMS

```
php artisan typicms:install
```

### الترحيل والتهيئة الأولية (Initial migration and seed)

```
php artisan typicms:database
```

يتم تشغيل هذا الأمر بواسطة `typicms:install`

### نشر وحدة (Publish a module)

إذا كنت تريد تعديل وحدة، على سبيل المثال لإضافة بعض الحقول أو العلاقة، فيجب[4D[K
فيجب عليك نشرها عن طريق تشغيل:

```
php artisan typicms:publish <modulename>
```

يتم الآن نقل الوحدة إلى الدليل **/Modules**.

سيتم تنفيذ هذه الخطوات:

1. نشر عروض (Views) وترايحات (Migrations) لوحدة الصفحات (Pages).
2. نسخ كل شيء باستثناء العروض والترايحات من **/vendor/typicms/pages/src** إ[1D[K
إلى **/Modules/Pages**.
3. تشغيل `composer remove typicms/pages`.

عند نشر وحدة، سيتم تتبعها بواسطة Git، وستتمكن من إجراء تغييرات في دليل **/M[4D[K
**/Modules/Modulename** دون فقدان التغييرات عند تشغيل `composer update`.

## سجل التغييرات (Changelog)

راجع [CHANGELOG.md](CHANGELOG.md) و [docs/upgrade-2026.md](docs/upgrade-202[39D[K
[docs/upgrade-2026.md](docs/upgrade-2026.md).

## المساهمة (Contributing)

يرجى مراجعة [CONTRIBUTING](https://github.com/TypiCMS/Base/blob/master/CONT[63D[K
[CONTRIBUTING](https://github.com/TypiCMS/Base/blob/master/CONTRIBUTING.md)[CONTRIBUTING](https://github.com/TypiCMS/Base/blob/master/CONTIBUTING.md) لمزيد من التفاصيل.

## الاعتمادات (Credits)

-   [Samuel De Backer](https://github.com/sdebacker)
-   [جميع المساهمين](https://github.com/TypiCMS/Base/graphs/contributors)

## الرخصة (Licence)

يعد TypiCMS برنامجًا مفتوح المصدر مرخصًا بموجب [رخصة MIT](http://opensource[22D[K
MIT](http://opensource.org/licenses/MIT).

