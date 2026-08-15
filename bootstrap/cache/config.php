<?php return array (
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => '12',
      'verify' => true,
      'limit' => NULL,
    ),
    'argon' => 
    array (
      'memory' => 65536,
      'threads' => 1,
      'time' => 4,
      'verify' => true,
    ),
    'rehash_on_login' => true,
  ),
  'concurrency' => 
  array (
    'default' => 'process',
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'reverb' => 
      array (
        'driver' => 'reverb',
        'key' => NULL,
        'secret' => NULL,
        'app_id' => NULL,
        'options' => 
        array (
          'host' => NULL,
          'port' => 443,
          'scheme' => 'https',
          'useTLS' => true,
        ),
        'client_options' => 
        array (
        ),
      ),
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => NULL,
        'secret' => NULL,
        'app_id' => NULL,
        'options' => 
        array (
          'cluster' => NULL,
          'host' => 'api-mt1.pusher.com',
          'port' => 443,
          'scheme' => 'https',
          'encrypted' => true,
          'useTLS' => true,
        ),
        'client_options' => 
        array (
        ),
      ),
      'ably' => 
      array (
        'driver' => 'ably',
        'key' => NULL,
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/Users/aldoyh/Sites/jareeda/resources/views',
    ),
    'compiled' => '/Users/aldoyh/Sites/jareeda/storage/framework/views',
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => 'api/*',
      1 => 'sanctum/csrf-cookie',
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => false,
  ),
  'images' => 
  array (
    'default' => 'gd',
  ),
  'app' => 
  array (
    'name' => 'Jareeda',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://localhost',
    'frontend_url' => 'http://localhost:3000',
    'asset_url' => NULL,
    'timezone' => 'UTC',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'cipher' => 'AES-256-CBC',
    'key' => 'base64:RywgFHdXAC+OowKrzJOqrCdfdKf4wacKTQxKsXA8/Xc=',
    'previous_keys' => 
    array (
    ),
    'maintenance' => 
    array (
      'driver' => 'file',
      'store' => 'database',
    ),
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Concurrency\\ConcurrencyServiceProvider',
      6 => 'Illuminate\\Cookie\\CookieServiceProvider',
      7 => 'Illuminate\\Database\\DatabaseServiceProvider',
      8 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      9 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      10 => 'Illuminate\\Image\\ImageServiceProvider',
      11 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      12 => 'Illuminate\\Hashing\\HashServiceProvider',
      13 => 'Illuminate\\Mail\\MailServiceProvider',
      14 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      15 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      16 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      17 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      18 => 'Illuminate\\Queue\\QueueServiceProvider',
      19 => 'Illuminate\\Redis\\RedisServiceProvider',
      20 => 'Illuminate\\Session\\SessionServiceProvider',
      21 => 'Illuminate\\Translation\\TranslationServiceProvider',
      22 => 'Illuminate\\Validation\\ValidationServiceProvider',
      23 => 'Illuminate\\View\\ViewServiceProvider',
      24 => 'TypiCMS\\Modules\\Sidebar\\SidebarServiceProvider',
      25 => 'Typidesign\\Translations\\ArtisanTranslationsServiceProvider',
      26 => 'TypiCMS\\LaravelTranslatableBootForms\\TranslatableBootFormsServiceProvider',
      27 => 'TypiCMS\\Modules\\Core\\Providers\\TranslationsServiceProvider',
      28 => 'TypiCMS\\Modules\\Core\\Providers\\ModuleServiceProvider',
      29 => 'App\\Providers\\AppServiceProvider',
      30 => 'App\\Providers\\UnslothServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Benchmark' => 'Illuminate\\Support\\Benchmark',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Concurrency' => 'Illuminate\\Support\\Facades\\Concurrency',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Context' => 'Illuminate\\Support\\Facades\\Context',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'Date' => 'Illuminate\\Support\\Facades\\Date',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Http' => 'Illuminate\\Support\\Facades\\Http',
      'Image' => 'Illuminate\\Support\\Facades\\Image',
      'Js' => 'Illuminate\\Support\\Js',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Number' => 'Illuminate\\Support\\Number',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Process' => 'Illuminate\\Support\\Facades\\Process',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'RateLimiter' => 'Illuminate\\Support\\Facades\\RateLimiter',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schedule' => 'Illuminate\\Support\\Facades\\Schedule',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'Uri' => 'Illuminate\\Support\\Uri',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Vite' => 'Illuminate\\Support\\Facades\\Vite',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
        'hash' => false,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'TypiCMS\\Modules\\Core\\Models\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_reset_tokens',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'array' => 
      array (
        'driver' => 'array',
        'serialize' => false,
      ),
      'session' => 
      array (
        'driver' => 'session',
        'key' => '_cache',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'connection' => NULL,
        'table' => 'cache',
        'lock_connection' => NULL,
        'lock_table' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/Users/aldoyh/Sites/jareeda/storage/framework/cache/data',
        'lock_path' => '/Users/aldoyh/Sites/jareeda/storage/framework/cache/data',
      ),
      'storage' => 
      array (
        'driver' => 'storage',
        'disk' => NULL,
        'path' => 'framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
        'lock_connection' => 'default',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
      'octane' => 
      array (
        'driver' => 'octane',
      ),
      'failover' => 
      array (
        'driver' => 'failover',
        'stores' => 
        array (
          0 => 'database',
          1 => 'array',
        ),
      ),
    ),
    'prefix' => 'typicms',
    'serializable_classes' => false,
  ),
  'croppa' => 
  array (
    'src_disk' => 'public',
    'crops_disk' => 'public',
    'tmp_disk' => 'public',
    'max_crops' => false,
    'path' => 'storage/(.*)$',
    'ignore' => '\\.(gif|GIF)$',
    'signing_key' => 'app.key',
    'memory_limit' => '128M',
    'quality' => 75,
    'interlace' => true,
    'upsize' => true,
    'filters' => 
    array (
      'gray' => 'Bkwld\\Croppa\\Filters\\BlackWhite',
      'darkgray' => 'Bkwld\\Croppa\\Filters\\Darkgray',
      'blur' => 'Bkwld\\Croppa\\Filters\\Blur',
      'negative' => 'Bkwld\\Croppa\\Filters\\Negative',
      'orange' => 'Bkwld\\Croppa\\Filters\\OrangeWarhol',
      'turquoise' => 'Bkwld\\Croppa\\Filters\\TurquoiseWarhol',
    ),
  ),
  'database' => 
  array (
    'default' => 'sqlite',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => '/Users/aldoyh/Sites/jareeda/database/database.sqlite',
        'prefix' => 'typicms_',
        'foreign_key_constraints' => true,
        'busy_timeout' => NULL,
        'journal_mode' => NULL,
        'synchronous' => NULL,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'laravel',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => 'typicms_',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'mariadb' => 
      array (
        'driver' => 'mariadb',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'laravel',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => 'typicms_',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '5432',
        'database' => 'laravel',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => 'typicms_',
        'prefix_indexes' => true,
        'search_path' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => 'localhost',
        'port' => '1433',
        'database' => 'laravel',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => 'typicms_',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 
    array (
      'table' => 'migrations',
      'update_date_on_publish' => true,
    ),
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'jareeda-database-',
        'persistent' => false,
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'username' => NULL,
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'username' => NULL,
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'eloquent-sortable' => 
  array (
    'order_column_name' => 'position',
    'sort_when_creating' => true,
    'ignore_timestamps' => false,
  ),
  'file' => 
  array (
    'types' => 
    array (
      'mp3' => 'a',
      'wav' => 'a',
      'aif' => 'a',
      'aiff' => 'a',
      'aac' => 'a',
      'mp4' => 'a',
      'wma' => 'a',
      'ogg' => 'a',
      'm4v' => 'v',
      'mkv' => 'v',
      'flv' => 'v',
      'mov' => 'v',
      'm4a' => 'v',
      'webm' => 'v',
      'ogv' => 'v',
      'xls' => 'd',
      'xlsx' => 'd',
      'doc' => 'd',
      'docx' => 'd',
      'pdf' => 'd',
      'txt' => 'd',
      'rtf' => 'd',
      'odt' => 'd',
      'ods' => 'd',
      'odp' => 'd',
      'odg' => 'd',
      'odc' => 'd',
      'odf' => 'd',
      'odb' => 'd',
      'odi' => 'd',
      'odm' => 'd',
      'zip' => 'd',
      'jpg' => 'i',
      'jpe' => 'i',
      'jpeg' => 'i',
      'png' => 'i',
      'gif' => 'i',
      'svg' => 'i',
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'public',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/Users/aldoyh/Sites/jareeda/storage/app/private',
        'serve' => true,
        'throw' => false,
        'report' => false,
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/Users/aldoyh/Sites/jareeda/storage/app/public',
        'url' => 'http://localhost/storage',
        'visibility' => 'public',
        'throw' => false,
        'report' => false,
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
        'endpoint' => NULL,
        'use_path_style_endpoint' => false,
        'throw' => false,
        'report' => false,
      ),
    ),
    'links' => 
    array (
      '/Users/aldoyh/Sites/jareeda/public/storage' => '/Users/aldoyh/Sites/jareeda/storage/app/public',
    ),
  ),
  'javascript' => 
  array (
    'bind_js_vars_to_this_view' => 'core::admin._javascript',
    'js_namespace' => 'TypiCMS',
  ),
  'logging' => 
  array (
    'default' => 'single',
    'deprecations' => 
    array (
      'channel' => NULL,
      'trace' => false,
    ),
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/Users/aldoyh/Sites/jareeda/storage/logs/laravel.log',
        'level' => 'debug',
        'replace_placeholders' => true,
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/Users/aldoyh/Sites/jareeda/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
        'replace_placeholders' => true,
      ),
      'monthly' => 
      array (
        'driver' => 'monthly',
        'path' => '/Users/aldoyh/Sites/jareeda/storage/logs/laravel.log',
        'level' => 'debug',
        'max_files' => 3,
        'replace_placeholders' => true,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'debug',
        'replace_placeholders' => true,
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
          'connectionString' => 'tls://:',
        ),
        'processors' => 
        array (
          0 => 'Monolog\\Processor\\PsrLogMessageProcessor',
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'handler_with' => 
        array (
          'stream' => 'php://stderr',
        ),
        'formatter' => NULL,
        'processors' => 
        array (
          0 => 'Monolog\\Processor\\PsrLogMessageProcessor',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
        'facility' => 8,
        'replace_placeholders' => true,
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
        'replace_placeholders' => true,
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => '/Users/aldoyh/Sites/jareeda/storage/logs/laravel.log',
      ),
      'browser' => 
      array (
        'driver' => 'single',
        'path' => '/Users/aldoyh/Sites/jareeda/storage/logs/browser.log',
        'level' => 'debug',
        'days' => 14,
      ),
    ),
  ),
  'mail' => 
  array (
    'default' => 'log',
    'mailers' => 
    array (
      'smtp' => 
      array (
        'transport' => 'smtp',
        'scheme' => NULL,
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '2525',
        'username' => NULL,
        'password' => NULL,
        'timeout' => NULL,
        'local_domain' => 'localhost',
      ),
      'ses' => 
      array (
        'transport' => 'ses',
      ),
      'postmark' => 
      array (
        'transport' => 'postmark',
      ),
      'resend' => 
      array (
        'transport' => 'resend',
      ),
      'sendmail' => 
      array (
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -bs -i',
      ),
      'log' => 
      array (
        'transport' => 'log',
        'channel' => NULL,
      ),
      'array' => 
      array (
        'transport' => 'array',
      ),
      'failover' => 
      array (
        'transport' => 'failover',
        'mailers' => 
        array (
          0 => 'smtp',
          1 => 'log',
        ),
        'retry_after' => 60,
      ),
      'roundrobin' => 
      array (
        'transport' => 'roundrobin',
        'mailers' => 
        array (
          0 => 'ses',
          1 => 'postmark',
        ),
        'retry_after' => 60,
      ),
      'mailgun' => 
      array (
        'transport' => 'mailgun',
      ),
    ),
    'from' => 
    array (
      'address' => 'hello@example.com',
      'name' => 'Jareeda',
    ),
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/Users/aldoyh/Sites/jareeda/resources/views/vendor/mail',
      ),
      'extensions' => 
      array (
      ),
    ),
  ),
  'permission' => 
  array (
    'models' => 
    array (
      'permission' => 'Spatie\\Permission\\Models\\Permission',
      'role' => 'TypiCMS\\Modules\\Core\\Models\\Role',
    ),
    'table_names' => 
    array (
      'roles' => 'roles',
      'permissions' => 'permissions',
      'model_has_permissions' => 'model_has_permissions',
      'model_has_roles' => 'model_has_roles',
      'role_has_permissions' => 'role_has_permissions',
    ),
    'column_names' => 
    array (
      'role_pivot_key' => NULL,
      'permission_pivot_key' => NULL,
      'model_morph_key' => 'model_id',
      'team_foreign_key' => 'team_id',
    ),
    'register_permission_check_method' => true,
    'register_octane_reset_listener' => false,
    'events_enabled' => false,
    'teams' => false,
    'team_resolver' => 'Spatie\\Permission\\DefaultTeamResolver',
    'use_passport_client_credentials' => false,
    'display_permission_in_exception' => false,
    'display_role_in_exception' => false,
    'enable_wildcard_permission' => false,
    'cache' => 
    array (
      'expiration_time' => 
      \DateInterval::__set_state(array(
         'from_string' => true,
         'date_string' => '24 hours',
      )),
      'key' => 'spatie.permission.cache',
      'store' => 'default',
    ),
  ),
  'queue' => 
  array (
    'default' => 'database',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'connection' => NULL,
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
        'after_commit' => false,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
        'after_commit' => false,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'default',
        'suffix' => NULL,
        'region' => 'us-east-1',
        'after_commit' => false,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
        'after_commit' => false,
      ),
      'deferred' => 
      array (
        'driver' => 'deferred',
      ),
      'failover' => 
      array (
        'driver' => 'failover',
        'connections' => 
        array (
          0 => 'database',
          1 => 'deferred',
        ),
      ),
    ),
    'batching' => 
    array (
      'database' => 'sqlite',
      'table' => 'job_batches',
    ),
    'failed' => 
    array (
      'driver' => 'database-uuids',
      'database' => 'sqlite',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'resend' => 
    array (
      'key' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
    'slack' => 
    array (
      'notifications' => 
      array (
        'bot_user_oauth_token' => NULL,
        'channel' => NULL,
      ),
    ),
    'mailgun' => 
    array (
      'domain' => '',
      'secret' => '',
      'endpoint' => 'api.eu.mailgun.net',
      'scheme' => 'https',
    ),
    'gmaps' => 
    array (
      'key' => NULL,
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => 120,
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/Users/aldoyh/Sites/jareeda/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'jareeda-session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => 'lax',
    'partitioned' => false,
    'serialization' => 'php',
  ),
  'translatable-bootforms' => 
  array (
    'label-locale-indicator' => '<span>%label</span> <span>(%locale)</span>',
    'form-group-class' => 'form-group-translation',
    'input-locale-attribute' => 'data-language',
  ),
  'typicms' => 
  array (
    'ar' => 
    array (
      'website_title' => 'جريدة',
      'status' => '1',
    ),
    'en' => 
    array (
      'website_title' => 'Jareeda',
      'status' => '1',
    ),
    'welcome_message' => 'Welcome to the administration panel of TypiCMS.',
    'auth_public' => '0',
    'register' => '0',
    'logo' => 'resources/images/typicms.svg',
    'og_image' => 'resources/images/og-image.png',
    'webmaster_email' => '',
    'locales' => 
    array (
      'en' => 'en_US',
      'ar' => 'ar_SA',
    ),
    'main_locale_in_url' => true,
    'lang_chooser' => false,
    'max_file_upload_size' => '60000',
    'welcome_message_url' => '',
    'template_dir' => 'public',
    'mariadb' => false,
    'authorized_ips' => 
    array (
    ),
    'search' => 
    array (
      'linkable_to_page' => true,
      'pages' => 
      array (
        'model' => 'TypiCMS\\Modules\\Core\\Models\\Page',
        'columns' => 
        array (
          0 => 'title',
          1 => 'body',
        ),
      ),
    ),
    'modules' => 
    array (
      'news' => 
      array (
      ),
      'dashboard' => 
      array (
        'sidebar' => 
        array (
          'icon' => '<i class="icon-house"></i>',
          'weight' => 0,
        ),
      ),
      'pages' => 
      array (
        'order' => 
        array (
          'parent_id' => 'asc',
          'position' => 'asc',
        ),
        'sidebar' => 
        array (
          'icon' => '<i class="icon-file-text"></i>',
          'weight' => 10,
        ),
        'permissions' => 
        array (
          'read pages' => 'Read',
          'create pages' => 'Create',
          'update pages' => 'Update',
          'delete pages' => 'Delete',
        ),
      ),
      'page_sections' => 
      array (
        'per_page' => 30,
        'order' => 
        array (
          'position' => 'asc',
        ),
        'permissions' => 
        array (
          'read page_sections' => 'Read',
          'create page_sections' => 'Create',
          'update page_sections' => 'Update',
          'delete page_sections' => 'Delete',
        ),
      ),
      'blocks' => 
      array (
        'order' => 
        array (
          'name' => 'asc',
        ),
        'sidebar' => 
        array (
          'icon' => '<i class="icon-square-dashed-text"></i>',
          'weight' => 100,
        ),
        'permissions' => 
        array (
          'read blocks' => 'Read',
          'create blocks' => 'Create',
          'update blocks' => 'Update',
          'delete blocks' => 'Delete',
        ),
      ),
      'history' => 
      array (
        'order' => 
        array (
          'id' => 'desc',
        ),
      ),
      'menus' => 
      array (
        'order' => 
        array (
          'name' => 'asc',
        ),
        'sidebar' => 
        array (
          'icon' => '<i class="icon-menu"></i>',
          'weight' => 110,
        ),
        'permissions' => 
        array (
          'read menus' => 'Read',
          'create menus' => 'Create',
          'update menus' => 'Update',
          'delete menus' => 'Delete',
        ),
      ),
      'menulinks' => 
      array (
        'order' => 
        array (
          'position' => 'asc',
        ),
        'permissions' => 
        array (
          'read menulinks' => 'Read',
          'create menulinks' => 'Create',
          'update menulinks' => 'Update',
          'delete menulinks' => 'Delete',
        ),
      ),
      'files' => 
      array (
        'per_page' => 50,
        'order' => 
        array (
          'position' => 'asc',
        ),
        'sidebar' => 
        array (
          'icon' => '<i class="icon-image"></i>',
          'weight' => 50,
        ),
        'permissions' => 
        array (
          'read files' => 'Read',
          'create files' => 'Create',
          'update files' => 'Update',
          'delete files' => 'Delete',
        ),
      ),
      'search' => 
      array (
        'linkable_to_page' => true,
      ),
      'tags' => 
      array (
        'linkable_to_page' => true,
        'per_page' => 50,
        'order' => 
        array (
          'tag' => 'asc',
        ),
        'sidebar' => 
        array (
          'icon' => '<i class="icon-tag"></i>',
          'weight' => 130,
        ),
        'permissions' => 
        array (
          'read tags' => 'Read',
          'create tags' => 'Create',
          'update tags' => 'Update',
          'delete tags' => 'Delete',
        ),
      ),
      'taxonomies' => 
      array (
        'order' => 
        array (
          'position' => 'asc',
        ),
        'sidebar' => 
        array (
          'icon' => '<i class="icon-grid-2x2"></i>',
          'weight' => 120,
        ),
        'permissions' => 
        array (
          'read taxonomies' => 'Read',
          'create taxonomies' => 'Create',
          'update taxonomies' => 'Update',
          'delete taxonomies' => 'Delete',
        ),
      ),
      'terms' => 
      array (
        'order' => 
        array (
          'position' => 'asc',
        ),
        'permissions' => 
        array (
          'read terms' => 'Read',
          'create terms' => 'Create',
          'update terms' => 'Update',
          'delete terms' => 'Delete',
        ),
      ),
      'translations' => 
      array (
        'order' => 
        array (
          'key' => 'asc',
        ),
        'sidebar' => 
        array (
          'icon' => '<i class="icon-globe"></i>',
          'weight' => 140,
        ),
        'permissions' => 
        array (
          'read translations' => 'Read',
          'create translations' => 'Create',
          'update translations' => 'Update',
          'delete translations' => 'Delete',
        ),
      ),
      'users' => 
      array (
        'sidebar' => 
        array (
          'icon' => '<i class="icon-users"></i>',
          'weight' => 100,
        ),
        'permissions' => 
        array (
          'read users' => 'Read',
          'create users' => 'Create',
          'update users' => 'Update',
          'delete users' => 'Delete',
          'edit profile' => 'Edit profile',
        ),
      ),
      'roles' => 
      array (
        'sidebar' => 
        array (
          'icon' => '<i class="icon-shield-user"></i>',
          'weight' => 150,
        ),
        'permissions' => 
        array (
          'read roles' => 'Read',
          'create roles' => 'Create',
          'update roles' => 'Update',
          'delete roles' => 'Delete',
        ),
      ),
    ),
    'registration' => 
    array (
      'allowed' => true,
      'role' => 'administrator',
      'activated' => true,
    ),
    'send_powered_by_header' => true,
  ),
  'unsloth' => 
  array (
    'api_endpoint' => 'http://localhost:8888',
    'api_key' => '',
    'model' => 'flux2-klein-4b',
    'storage' => 
    array (
      'disk' => 'public',
      'path' => 'ai-generated',
    ),
    'image' => 
    array (
      'width' => 1024,
      'height' => 768,
      'steps' => 20,
      'guidance' => 7.5,
      'seed' => NULL,
    ),
    'prompt_template' => 'Editorial photograph illustration for news article: "{title}". Professional journalistic photography style, clean composition, appropriate for newspaper publication. High quality, detailed, realistic.',
    'queue' => 
    array (
      'connection' => 'redis',
      'queue' => 'ai-images',
      'timeout' => 120,
      'tries' => 3,
      'retry_after' => 60,
    ),
    'trigger' => 'on_save',
    'require_review' => true,
    'health_check' => 
    array (
      'enabled' => true,
      'interval' => 60,
      'timeout' => 5,
    ),
  ),
  'debugbar' => 
  array (
    'enabled' => NULL,
    'collect_jobs' => false,
    'except' => 
    array (
      0 => 'telescope*',
      1 => 'horizon*',
      2 => '_boost/browser-logs',
      3 => 'livewire-*/livewire.js',
    ),
    'collectors' => 
    array (
      'phpinfo' => false,
      'messages' => true,
      'time' => true,
      'memory' => true,
      'exceptions' => true,
      'log' => true,
      'db' => true,
      'views' => true,
      'route' => false,
      'auth' => false,
      'gate' => true,
      'session' => false,
      'symfony_request' => true,
      'mail' => true,
      'laravel' => true,
      'events' => false,
      'logs' => false,
      'config' => false,
      'cache' => true,
      'models' => true,
      'livewire' => true,
      'inertia' => true,
      'jobs' => true,
      'pennant' => true,
      'ai' => true,
      'http_client' => true,
    ),
    'options' => 
    array (
      'time' => 
      array (
        'memory_usage' => false,
      ),
      'messages' => 
      array (
        'trace' => true,
        'backtrace_exclude_paths' => 
        array (
        ),
        'capture_dumps' => false,
        'timeline' => true,
      ),
      'memory' => 
      array (
        'reset_peak' => false,
        'with_baseline' => false,
        'precision' => 0,
      ),
      'auth' => 
      array (
        'show_name' => true,
        'show_guards' => true,
      ),
      'gate' => 
      array (
        'trace' => false,
        'timeline' => false,
      ),
      'db' => 
      array (
        'with_params' => true,
        'exclude_paths' => 
        array (
        ),
        'backtrace' => true,
        'backtrace_exclude_paths' => 
        array (
        ),
        'backtrace_editor_links' => false,
        'timeline' => false,
        'duration_background' => true,
        'explain' => true,
        'show_query_result' => false,
        'only_slow_queries' => true,
        'slow_threshold' => false,
        'memory_usage' => false,
        'soft_limit' => 100,
        'hard_limit' => 500,
      ),
      'mail' => 
      array (
        'timeline' => true,
        'show_body' => true,
      ),
      'views' => 
      array (
        'timeline' => true,
        'data' => false,
        'group' => 50,
        'exclude_paths' => 
        array (
          0 => 'vendor/filament',
        ),
      ),
      'inertia' => 
      array (
        'pages' => 'js/Pages',
      ),
      'route' => 
      array (
        'label' => true,
      ),
      'session' => 
      array (
        'masked' => 
        array (
        ),
      ),
      'symfony_request' => 
      array (
        'label' => true,
        'masked' => 
        array (
        ),
      ),
      'events' => 
      array (
        'data' => false,
        'listeners' => false,
        'excluded' => 
        array (
        ),
      ),
      'logs' => 
      array (
        'file' => NULL,
      ),
      'config' => 
      array (
        'masked' => 
        array (
        ),
      ),
      'cache' => 
      array (
        'values' => true,
        'timeline' => false,
      ),
      'http_client' => 
      array (
        'masked' => 
        array (
        ),
        'timeline' => true,
      ),
      'ai' => 
      array (
        'values' => true,
      ),
    ),
    'custom_collectors' => 
    array (
    ),
    'editor' => 'phpstorm',
    'capture_ajax' => true,
    'add_ajax_timing' => false,
    'ajax_handler_auto_show' => true,
    'ajax_handler_enable_tab' => true,
    'capture_streamed' => false,
    'streamed_content_types' => 
    array (
      0 => 'text/event-stream',
    ),
    'defer_datasets' => false,
    'remote_sites_path' => NULL,
    'local_sites_path' => NULL,
    'storage' => 
    array (
      'enabled' => true,
      'open' => NULL,
      'driver' => 'file',
      'path' => '/Users/aldoyh/Sites/jareeda/storage/debugbar',
      'connection' => NULL,
      'provider' => '',
    ),
    'force_allow_enable' => false,
    'use_dist_files' => true,
    'include_vendors' => true,
    'error_handler' => false,
    'error_level' => 30719,
    'clockwork' => false,
    'inject' => true,
    'route_prefix' => '_debugbar',
    'route_middleware' => 
    array (
    ),
    'route_domain' => NULL,
    'theme' => 'auto',
    'debug_backtrace_limit' => 50,
  ),
  'boost' => 
  array (
    'enabled' => true,
    'rules' => 
    array (
      'enabled' => true,
      'scoped_guidelines' => false,
    ),
    'guidelines' => 
    array (
      'exclude' => 
      array (
      ),
    ),
    'skills' => 
    array (
      'exclude' => 
      array (
      ),
    ),
    'executable_paths' => 
    array (
      'php' => NULL,
      'composer' => NULL,
      'npm' => NULL,
      'vendor_bin' => NULL,
      'current_directory' => NULL,
    ),
    'browser_logs_watcher' => true,
    'browser_log_levels' => 
    array (
      0 => 'error',
      1 => 'warning',
      2 => 'info',
      3 => 'debug',
    ),
  ),
  'mcp' => 
  array (
    'redirect_domains' => 
    array (
      0 => '*',
    ),
    'custom_schemes' => 
    array (
    ),
    'authorization_server' => NULL,
  ),
  'feed' => 
  array (
    'feeds' => 
    array (
      'main' => 
      array (
        'items' => '',
        'url' => '',
        'title' => 'My feed',
        'description' => 'The description of the feed.',
        'language' => 'en-US',
        'image' => '',
        'format' => 'atom',
        'view' => 'feed::atom',
        'type' => '',
        'contentType' => '',
      ),
    ),
  ),
  'flare' => 
  array (
    'key' => NULL,
    'flare_middleware' => 
    array (
      0 => 'Spatie\\FlareClient\\FlareMiddleware\\RemoveRequestIp',
      1 => 'Spatie\\FlareClient\\FlareMiddleware\\AddGitInformation',
      2 => 'Spatie\\LaravelIgnition\\FlareMiddleware\\AddNotifierName',
      3 => 'Spatie\\LaravelIgnition\\FlareMiddleware\\AddEnvironmentInformation',
      4 => 'Spatie\\LaravelIgnition\\FlareMiddleware\\AddExceptionInformation',
      5 => 'Spatie\\LaravelIgnition\\FlareMiddleware\\AddDumps',
      'Spatie\\LaravelIgnition\\FlareMiddleware\\AddLogs' => 
      array (
        'maximum_number_of_collected_logs' => 200,
      ),
      'Spatie\\LaravelIgnition\\FlareMiddleware\\AddQueries' => 
      array (
        'maximum_number_of_collected_queries' => 200,
        'report_query_bindings' => true,
      ),
      'Spatie\\LaravelIgnition\\FlareMiddleware\\AddJobs' => 
      array (
        'max_chained_job_reporting_depth' => 5,
      ),
      6 => 'Spatie\\LaravelIgnition\\FlareMiddleware\\AddContext',
      7 => 'Spatie\\LaravelIgnition\\FlareMiddleware\\AddExceptionHandledStatus',
      'Spatie\\FlareClient\\FlareMiddleware\\CensorRequestBodyFields' => 
      array (
        'censor_fields' => 
        array (
          0 => 'password',
          1 => 'password_confirmation',
        ),
      ),
      'Spatie\\FlareClient\\FlareMiddleware\\CensorRequestHeaders' => 
      array (
        'headers' => 
        array (
          0 => 'API-KEY',
          1 => 'Authorization',
          2 => 'Cookie',
          3 => 'Set-Cookie',
          4 => 'X-CSRF-TOKEN',
          5 => 'X-XSRF-TOKEN',
        ),
      ),
    ),
    'send_logs_as_events' => true,
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'auto',
    'enable_share_button' => true,
    'register_commands' => false,
    'solution_providers' => 
    array (
      0 => 'Spatie\\Ignition\\Solutions\\SolutionProviders\\BadMethodCallSolutionProvider',
      1 => 'Spatie\\Ignition\\Solutions\\SolutionProviders\\MergeConflictSolutionProvider',
      2 => 'Spatie\\Ignition\\Solutions\\SolutionProviders\\UndefinedPropertySolutionProvider',
      3 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\IncorrectValetDbCredentialsSolutionProvider',
      4 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingAppKeySolutionProvider',
      5 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\DefaultDbNameSolutionProvider',
      6 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\TableNotFoundSolutionProvider',
      7 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingImportSolutionProvider',
      8 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\InvalidRouteActionSolutionProvider',
      9 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\ViewNotFoundSolutionProvider',
      10 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\RunningLaravelDuskInProductionProvider',
      11 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingColumnSolutionProvider',
      12 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\UnknownValidationSolutionProvider',
      13 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingMixManifestSolutionProvider',
      14 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingViteManifestSolutionProvider',
      15 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingLivewireComponentSolutionProvider',
      16 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\UndefinedViewVariableSolutionProvider',
      17 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\GenericLaravelExceptionSolutionProvider',
      18 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\OpenAiSolutionProvider',
      19 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\SailNetworkSolutionProvider',
      20 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\UnknownMysql8CollationSolutionProvider',
      21 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\UnknownMariadbCollationSolutionProvider',
    ),
    'ignored_solution_providers' => 
    array (
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '/Users/aldoyh/Sites/jareeda',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
    'settings_file_path' => '',
    'recorders' => 
    array (
      0 => 'Spatie\\LaravelIgnition\\Recorders\\DumpRecorder\\DumpRecorder',
      1 => 'Spatie\\LaravelIgnition\\Recorders\\JobRecorder\\JobRecorder',
      2 => 'Spatie\\LaravelIgnition\\Recorders\\LogRecorder\\LogRecorder',
      3 => 'Spatie\\LaravelIgnition\\Recorders\\QueryRecorder\\QueryRecorder',
    ),
    'open_ai_key' => NULL,
    'with_stack_frame_arguments' => true,
    'argument_reducers' => 
    array (
      0 => 'Spatie\\Backtrace\\Arguments\\Reducers\\BaseTypeArgumentReducer',
      1 => 'Spatie\\Backtrace\\Arguments\\Reducers\\ArrayArgumentReducer',
      2 => 'Spatie\\Backtrace\\Arguments\\Reducers\\StdClassArgumentReducer',
      3 => 'Spatie\\Backtrace\\Arguments\\Reducers\\EnumArgumentReducer',
      4 => 'Spatie\\Backtrace\\Arguments\\Reducers\\ClosureArgumentReducer',
      5 => 'Spatie\\Backtrace\\Arguments\\Reducers\\DateTimeArgumentReducer',
      6 => 'Spatie\\Backtrace\\Arguments\\Reducers\\DateTimeZoneArgumentReducer',
      7 => 'Spatie\\Backtrace\\Arguments\\Reducers\\SymphonyRequestArgumentReducer',
      8 => 'Spatie\\LaravelIgnition\\ArgumentReducers\\ModelArgumentReducer',
      9 => 'Spatie\\LaravelIgnition\\ArgumentReducers\\CollectionArgumentReducer',
      10 => 'Spatie\\Backtrace\\Arguments\\Reducers\\StringableArgumentReducer',
    ),
  ),
  'markdown-response' => 
  array (
    'enabled' => true,
    'driver' => 'league',
    'detection' => 
    array (
      'detector' => 'Spatie\\MarkdownResponse\\Actions\\DetectsMarkdownRequest',
      'detect_via_accept_header' => true,
      'detect_via_md_suffix' => true,
      'detect_via_user_agents' => 
      array (
        0 => 'ClaudeBot',
        1 => 'Claude-Web',
        2 => 'Anthropic',
        3 => 'PerplexityBot',
        4 => 'Bytespider',
        5 => 'Google-Extended',
      ),
    ),
    'preprocessors' => 
    array (
      0 => 'Spatie\\MarkdownResponse\\Preprocessors\\RemoveScriptsAndStylesPreprocessor',
    ),
    'postprocessors' => 
    array (
      0 => 'Spatie\\MarkdownResponse\\Postprocessors\\RemoveHtmlTagsPostprocessor',
      1 => 'Spatie\\MarkdownResponse\\Postprocessors\\CollapseBlankLinesPostprocessor',
    ),
    'cache' => 
    array (
      'enabled' => true,
      'store' => NULL,
      'ttl' => 3600,
      'key_generator' => 'Spatie\\MarkdownResponse\\Actions\\GeneratesCacheKey',
      'ignored_query_parameters' => 
      array (
        0 => 'utm_source',
        1 => 'utm_medium',
        2 => 'utm_campaign',
        3 => 'utm_term',
        4 => 'utm_content',
        5 => 'gclid',
        6 => 'fbclid',
      ),
    ),
    'content_signals' => 
    array (
      'ai-train' => 'disallow',
      'ai-input' => 'allow',
      'search' => 'allow',
    ),
    'driver_options' => 
    array (
      'league' => 
      array (
        'options' => 
        array (
          'strip_tags' => true,
          'hard_break' => true,
        ),
      ),
      'cloudflare' => 
      array (
        'account_id' => 'e38c2d39748ce8c6c20b8fa5db06a27b',
        'api_token' => NULL,
      ),
    ),
  ),
  'one-time-passwords' => 
  array (
    'default_expires_in_minutes' => 2,
    'only_one_active_one_time_password_per_user' => true,
    'enforce_same_origin' => true,
    'origin_enforcer' => 'Spatie\\OneTimePasswords\\Support\\OriginInspector\\DefaultOriginEnforcer',
    'password_generator' => 'Spatie\\OneTimePasswords\\Support\\PasswordGenerators\\NumericOneTimePasswordGenerator',
    'password_length' => 6,
    'redirect_successful_authentication_to' => '/dashboard',
    'rate_limit_attempts' => 
    array (
      'max_attempts_per_user' => 5,
      'time_window_in_seconds' => 60,
    ),
    'model' => 'Spatie\\OneTimePasswords\\Models\\OneTimePassword',
    'notification' => 'Spatie\\OneTimePasswords\\Notifications\\OneTimePasswordNotification',
    'actions' => 
    array (
      'create_one_time_password' => 'Spatie\\OneTimePasswords\\Actions\\CreateOneTimePasswordAction',
      'consume_one_time_password' => 'Spatie\\OneTimePasswords\\Actions\\ConsumeOneTimePasswordAction',
    ),
  ),
  'passkeys' => 
  array (
    'redirect_to_after_login' => '/dashboard',
    'actions' => 
    array (
      'generate_passkey_register_options' => 'Spatie\\LaravelPasskeys\\Actions\\GeneratePasskeyRegisterOptionsAction',
      'store_passkey' => 'Spatie\\LaravelPasskeys\\Actions\\StorePasskeyAction',
      'generate_passkey_authentication_options' => 'Spatie\\LaravelPasskeys\\Actions\\GeneratePasskeyAuthenticationOptionsAction',
      'find_passkey' => 'Spatie\\LaravelPasskeys\\Actions\\FindPasskeyToAuthenticateAction',
      'configure_ceremony_step_manager_factory' => 'Spatie\\LaravelPasskeys\\Actions\\ConfigureCeremonyStepManagerFactoryAction',
    ),
    'relying_party' => 
    array (
      'name' => 'Jareeda',
      'id' => 'localhost',
      'icon' => NULL,
    ),
    'models' => 
    array (
      'passkey' => 'Spatie\\LaravelPasskeys\\Models\\Passkey',
      'authenticatable' => 'TypiCMS\\Modules\\Core\\Models\\User',
    ),
  ),
  'query-builder' => 
  array (
    'parameters' => 
    array (
      'include' => 'include',
      'filter' => 'filter',
      'sort' => 'sort',
      'fields' => 'fields',
      'append' => 'append',
    ),
    'delimiter' => ',',
    'filter_value_splitting_enabled' => true,
    'suffixes' => 
    array (
      'count' => 'Count',
      'exists' => 'Exists',
      'min' => 'Min',
      'max' => 'Max',
      'sum' => 'Sum',
      'avg' => 'Avg',
    ),
    'disable_invalid_filter_query_exception' => false,
    'disable_invalid_sort_query_exception' => false,
    'disable_invalid_include_query_exception' => false,
    'convert_relation_names_to_snake_case_plural' => true,
    'convert_relation_table_name_strategy' => NULL,
    'convert_field_names_to_snake_case' => false,
  ),
  'responsecache' => 
  array (
    'enabled' => true,
    'cache' => 
    array (
      'store' => 'file',
      'lifetime_in_seconds' => 604800,
      'tag' => '',
    ),
    'bypass' => 
    array (
      'header_name' => NULL,
      'header_value' => NULL,
    ),
    'debug' => 
    array (
      'enabled' => true,
      'cache_time_header_name' => 'X-Cache-Time',
      'cache_status_header_name' => 'X-Cache-Status',
      'cache_age_header_name' => 'X-Cache-Age',
      'cache_key_header_name' => 'X-Cache-Key',
    ),
    'ignored_query_parameters' => 
    array (
      0 => 'utm_source',
      1 => 'utm_medium',
      2 => 'utm_campaign',
      3 => 'utm_term',
      4 => 'utm_content',
      5 => 'gclid',
      6 => 'fbclid',
    ),
    'cache_profile' => 'Spatie\\ResponseCache\\CacheProfiles\\CacheAllSuccessfulGetRequests',
    'hasher' => 'Spatie\\ResponseCache\\Hasher\\DefaultHasher',
    'serializer' => 'Spatie\\ResponseCache\\Serializers\\JsonSerializer',
    'replacers' => 
    array (
      0 => 'Spatie\\ResponseCache\\Replacers\\CsrfTokenReplacer',
    ),
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
    'trust_project' => 'always',
  ),
  'sitemap' => 
  array (
    'use_cache' => false,
    'cache_key' => 'laravel-sitemap.http://localhost',
    'cache_duration' => 3600,
    'escaping' => true,
    'use_limit_size' => false,
    'max_size' => NULL,
    'use_styles' => true,
    'styles_location' => '/vendor/sitemap/styles/',
    'use_gzip' => false,
  ),
);
