<?php

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/_debugbar/open' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.openhandler',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_debugbar/queries/explain' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.queries.explain',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_debugbar/assets' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.assets',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_boost/browser-logs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'boost.browser-logs',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/health-check' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.healthCheck',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/execute-solution' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.executeSolution',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/update-config' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.updateConfig',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/blocks' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::index-blocks',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin::store-block',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/blocks/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::create-block',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/blocks' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZSkiKKQfoVLnDl0Z',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/files' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::index-files',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/files' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3KZXVDwewxojbxGS',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dJnjrkAy0gGoTSuf',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/history' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ANrGDlKeWEs5EscL',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kuRcoDz5vYjpe9Uf',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/llms.txt' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'llms-txt',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/menus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::index-menus',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin::store-menu',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/menus/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::create-menu',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/menus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7U4a1881lyMiVpJo',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/roles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::index-roles',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin::store-role',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/roles/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::create-role',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/roles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::LnTvCh3M1rbsyfsb',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/en/search-results' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'en::search',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ar/search-results' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ar::search',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/settings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::index-settings',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin::update-settings',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'admin::delete-image-in-settings',
          ),
          1 => NULL,
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/cache/clear' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::clear-cache',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/sitemap.xml' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'sitemap',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/tags' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::index-tags',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin::store-tag',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/tags/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::create-tag',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/tags-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qrmQPcDjOR9GmDyi',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/tags' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cLlkMJM9uCxlNAOy',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/taxonomies' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::index-taxonomies',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin::store-taxonomy',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/taxonomies/export' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::export-taxonomies',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/taxonomies/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::create-taxonomy',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/taxonomies' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3RqVx0gcsLSEDt8M',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/translations' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::index-translations',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin::store-translation',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/translations/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::create-translation',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/translations' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZzobHubcwMVUe8vH',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/en/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'en::register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'en::register-action',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/en/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'en::login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/en/otp-login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'en::otp-login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'en::send-one-time-password',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/en/otp-login-code' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'en::login-code',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'en::submit-one-time-password',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/en/create-passkey' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'en::create-passkey',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/en/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'en::logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/en/stop-impersonation' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'en::stop-impersonation',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ar/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ar::register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'ar::register-action',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ar/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ar::login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ar/otp-login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ar::otp-login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'ar::send-one-time-password',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ar/otp-login-code' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ar::login-code',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'ar::submit-one-time-password',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ar/create-passkey' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ar::create-passkey',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ar/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ar::logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ar/stop-impersonation' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ar::stop-impersonation',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/passkeys/authentication-options' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passkeys.authentication_options',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/passkeys/authenticate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passkeys.login',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::index-users',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin::store-user',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/users/export' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::export-users',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/users/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::create-user',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::profile',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin::update-profile',
          ),
          1 => NULL,
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3mfKQTyvlZJGIb27',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/users/current/update-preferences' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bXdtMGxzpTm5q0Ih',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/passkeys' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::htSWB5zJ9SV7lqUh',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/up' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::o3q2VQH3N8uTGPKX',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/pages' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::index-pages',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin::store-page',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/pages/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::create-page',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/sections' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::index-page_sections',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/pages' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kgT6PeoyeixsoxoE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/pages/links-for-editor' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZuMaq4tXHvdPAD8n',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mbCElTrfke0GfdTf',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/_debugbar/c(?|ache/(.*)(*:31)|lockwork/([^/]++)(*:55))|/((?=storage/(?:.*)$)(?=(?:.+)-(?:[0-9_]+)x(?:[0-9_]+)(?:-[0-9a-zA-Z(?:),\\-._]+)*\\.(?:jpg|jpeg|png|gif|webp|JPG|JPEG|PNG|GIF|WEBP)$).+)(*:198)|/a(?|dmin/(?|blocks/([^/]++)(?|/edit(*:242)|(*:250))|_locale/([^/]++)(*:275)|files/([^/]++)(?|/(?|edit(*:308)|crop(*:320))|(*:329))|menus/([^/]++)(?|/(?|edit(*:363)|menulinks(?|/(?|create(*:393)|([^/]++)(?|/edit(*:417)|(*:425)))|(*:435)))|(*:445))|roles/([^/]++)(?|/edit(*:476)|(*:484))|t(?|a(?|gs/([^/]++)(?|/edit(*:520)|(*:528))|xonomies/([^/]++)(?|/(?|edit(*:565)|terms(?|(*:581)|/(?|create(*:599)|([^/]++)(?|/edit(*:623)|(*:631)))|(*:641)))|(*:651)))|ranslations/([^/]++)(?|/edit(*:689)|(*:697)))|users/([^/]++)(?|/(?|edit(*:732)|impersonate(*:751))|(*:760))|pages/([^/]++)(?|/(?|edit(*:794)|sections(?|/(?|create(*:823)|([^/]++)(?|/edit(*:847)|(*:855))|sort(*:868))|(*:877)))|(*:887))|sections/([^/]++)(*:913)|((?:.*))(*:929))|pi/(?|blocks/([^/]++)(?|(*:962))|files/([^/]++)(?|(*:988)|(*:996)|(*:1004))|menus/([^/]++)(?|(*:1031)|/menulinks(?|(*:1053)|/(?|([^/]++)(*:1074)|sort(*:1087)|([^/]++)(*:1104))))|roles/([^/]++)(?|(*:1133))|t(?|a(?|gs/([^/]++)(?|(*:1165))|xonomies/([^/]++)(?|(*:1195)|/terms(?|(*:1213)|/([^/]++)(?|(*:1234)))))|ranslations/([^/]++)(?|(*:1270)))|users/([^/]++)(?|(*:1298)|/passkeys(*:1316))|pa(?|sskeys/(?|([^/]++)(*:1349)|generate\\-options(*:1375))|ges/(?|([^/]++)(*:1400)|sort(*:1413)|([^/]++)(?|(*:1433)|/sections(?|(*:1454)|/([^/]++)(?|(*:1475)))))))|r/((?:.*))(*:1500))|/storage/(.*)(?|(*:1526))|/en/((?:.*))(*:1548)|/((?:.*))(*:1566)|/admin/news/([^/]++)/(?|generate\\-image(*:1614)|queue\\-generate\\-image(*:1645)|image\\-status(*:1667)|clear\\-ai\\-image(*:1692)))/?$}sDu',
    ),
    3 => 
    array (
      31 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.cache.delete',
          ),
          1 => 
          array (
            0 => 'key',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      55 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.clockwork',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      198 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NQIiqggbBbjqFMEt',
          ),
          1 => 
          array (
            0 => 'path',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      242 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::edit-block',
          ),
          1 => 
          array (
            0 => 'block',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      250 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::update-block',
          ),
          1 => 
          array (
            0 => 'block',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      275 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::change-locale',
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      308 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::edit-file',
          ),
          1 => 
          array (
            0 => 'file',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      320 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::crop-file',
          ),
          1 => 
          array (
            0 => 'file',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      329 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::update-file',
          ),
          1 => 
          array (
            0 => 'file',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      363 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::edit-menu',
          ),
          1 => 
          array (
            0 => 'menu',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      393 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::create-menulink',
          ),
          1 => 
          array (
            0 => 'menu',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      417 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::edit-menulink',
          ),
          1 => 
          array (
            0 => 'menu',
            1 => 'menulink',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      425 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::update-menulink',
          ),
          1 => 
          array (
            0 => 'menu',
            1 => 'menulink',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      435 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::store-menulink',
          ),
          1 => 
          array (
            0 => 'menu',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      445 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::update-menu',
          ),
          1 => 
          array (
            0 => 'menu',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      476 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::edit-role',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      484 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::update-role',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      520 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::edit-tag',
          ),
          1 => 
          array (
            0 => 'tag',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      528 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::update-tag',
          ),
          1 => 
          array (
            0 => 'tag',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      565 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::edit-taxonomy',
          ),
          1 => 
          array (
            0 => 'taxonomy',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      581 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::index-terms',
          ),
          1 => 
          array (
            0 => 'taxonomy',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      599 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::create-term',
          ),
          1 => 
          array (
            0 => 'taxonomy',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      623 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::edit-term',
          ),
          1 => 
          array (
            0 => 'taxonomy',
            1 => 'term',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      631 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::update-term',
          ),
          1 => 
          array (
            0 => 'taxonomy',
            1 => 'term',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      641 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::store-term',
          ),
          1 => 
          array (
            0 => 'taxonomy',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      651 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::update-taxonomy',
          ),
          1 => 
          array (
            0 => 'taxonomy',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      689 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::edit-translation',
          ),
          1 => 
          array (
            0 => 'translation',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      697 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::update-translation',
          ),
          1 => 
          array (
            0 => 'translation',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      732 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::edit-user',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      751 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::impersonate-user',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      760 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::update-user',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      794 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::edit-page',
          ),
          1 => 
          array (
            0 => 'page',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      823 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::create-page_section',
          ),
          1 => 
          array (
            0 => 'page',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      847 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::edit-page_section',
          ),
          1 => 
          array (
            0 => 'page',
            1 => 'section',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      855 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::update-page_section',
          ),
          1 => 
          array (
            0 => 'page',
            1 => 'section',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      868 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::sort-page_sections',
          ),
          1 => 
          array (
            0 => 'page',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      877 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::store-page_section',
          ),
          1 => 
          array (
            0 => 'page',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      887 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::update-page',
          ),
          1 => 
          array (
            0 => 'page',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      913 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::destroy-page_section',
          ),
          1 => 
          array (
            0 => 'section',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      929 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin::show-404-page-in-admin',
          ),
          1 => 
          array (
            0 => 'uri',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      962 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CmIXacff2MLjgpJT',
          ),
          1 => 
          array (
            0 => 'block',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::SgB1PSHzffLosyCa',
          ),
          1 => 
          array (
            0 => 'block',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      988 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mRcHSJBOUKkv3m9q',
          ),
          1 => 
          array (
            0 => 'file',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      996 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qnXb7JEtqElVu1lw',
          ),
          1 => 
          array (
            0 => 'ids',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1004 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VGeTz8Jy8vYpOzSj',
          ),
          1 => 
          array (
            0 => 'file',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1031 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::i2z8CGgXwpNu7h4w',
          ),
          1 => 
          array (
            0 => 'menu',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::44maYlqSi70FDAMH',
          ),
          1 => 
          array (
            0 => 'menu',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1053 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MhpDxqKCu3U3bKP2',
          ),
          1 => 
          array (
            0 => 'menu',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1074 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VFDDuWD4dA8eaSyR',
          ),
          1 => 
          array (
            0 => 'menu',
            1 => 'menulink',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1087 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RvMjMHjavUwAeo9y',
          ),
          1 => 
          array (
            0 => 'menu',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1104 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GjwBTdZPGZvZrnyp',
          ),
          1 => 
          array (
            0 => 'menu',
            1 => 'menulink',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1133 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::T4HyrMdbvR94Jq3H',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2IK73I8dDqD6MdTO',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1165 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vwcEIVwzt7jhk0z1',
          ),
          1 => 
          array (
            0 => 'tag',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VAFsoZzWv2DPthz0',
          ),
          1 => 
          array (
            0 => 'tag',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1195 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::P5rBNJAR01c3m1MD',
          ),
          1 => 
          array (
            0 => 'taxonomy',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::iZiPynudcwl6eR0w',
          ),
          1 => 
          array (
            0 => 'taxonomy',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1213 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Si1KiFI5qX7HfwuR',
          ),
          1 => 
          array (
            0 => 'taxonomy',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1234 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ihIwagzm5iHGqbSB',
          ),
          1 => 
          array (
            0 => 'taxonomy',
            1 => 'term',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9eM1p3R49rS5sOfh',
          ),
          1 => 
          array (
            0 => 'taxonomy',
            1 => 'term',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1270 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KVsetkKC1GoYFtBX',
          ),
          1 => 
          array (
            0 => 'translation',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::P3GCaCSa6Oalv3qY',
          ),
          1 => 
          array (
            0 => 'translation',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1298 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wT12GyLlJNmkI2g1',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1316 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mYABSgL2u3n0SO9W',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1349 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tvoGVnuTPm98PEwD',
          ),
          1 => 
          array (
            0 => 'passkey',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1375 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PL9AiD9GiN7cxPct',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1400 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WmEnAgqNxjM9zGCN',
          ),
          1 => 
          array (
            0 => 'page',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1413 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7XRDzxRj70STDMK8',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1433 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::LvV7UkzOJ7ZOfzwB',
          ),
          1 => 
          array (
            0 => 'page',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1454 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vNpASC9tqYkcNNuI',
          ),
          1 => 
          array (
            0 => 'page',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1475 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tEFINhXrSXokqX6U',
          ),
          1 => 
          array (
            0 => 'page',
            1 => 'section',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7TsmvdmrknQoblF3',
          ),
          1 => 
          array (
            0 => 'page',
            1 => 'section',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1500 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6uYBV9tqIKnWsf7l',
          ),
          1 => 
          array (
            0 => 'uri',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1526 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'storage.local',
          ),
          1 => 
          array (
            0 => 'path',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'storage.local.upload',
          ),
          1 => 
          array (
            0 => 'path',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1548 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::upemGGcJw5thgHgI',
          ),
          1 => 
          array (
            0 => 'uri',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1566 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::o0QOuQDwHpyS0ysm',
          ),
          1 => 
          array (
            0 => 'uri',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1614 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.news.generate-image',
          ),
          1 => 
          array (
            0 => 'articleId',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1645 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.news.queue-generate-image',
          ),
          1 => 
          array (
            0 => 'articleId',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1667 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.news.image-status',
          ),
          1 => 
          array (
            0 => 'articleId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1692 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.news.clear-ai-image',
          ),
          1 => 
          array (
            0 => 'articleId',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'debugbar.openhandler' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/open',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Fruitcake\\LaravelDebugbar\\Middleware\\DebugbarEnabled',
          1 => 'Fruitcake\\LaravelDebugbar\\Middleware\\StopRecordingTelescope',
        ),
        'uses' => 'Fruitcake\\LaravelDebugbar\\Controllers\\OpenHandlerController@handle',
        'controller' => 'Fruitcake\\LaravelDebugbar\\Controllers\\OpenHandlerController@handle',
        'namespace' => NULL,
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
        'as' => 'debugbar.openhandler',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.cache.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => '_debugbar/cache/{key}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Fruitcake\\LaravelDebugbar\\Middleware\\DebugbarEnabled',
          1 => 'Fruitcake\\LaravelDebugbar\\Middleware\\StopRecordingTelescope',
        ),
        'uses' => 'Fruitcake\\LaravelDebugbar\\Controllers\\CacheController@delete',
        'controller' => 'Fruitcake\\LaravelDebugbar\\Controllers\\CacheController@delete',
        'namespace' => NULL,
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
        'as' => 'debugbar.cache.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'key' => '.*',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.queries.explain' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_debugbar/queries/explain',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Fruitcake\\LaravelDebugbar\\Middleware\\DebugbarEnabled',
          1 => 'Fruitcake\\LaravelDebugbar\\Middleware\\StopRecordingTelescope',
        ),
        'uses' => 'Fruitcake\\LaravelDebugbar\\Controllers\\QueriesController@explain',
        'controller' => 'Fruitcake\\LaravelDebugbar\\Controllers\\QueriesController@explain',
        'namespace' => NULL,
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
        'as' => 'debugbar.queries.explain',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.clockwork' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/clockwork/{id}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Fruitcake\\LaravelDebugbar\\Middleware\\DebugbarEnabled',
          1 => 'Fruitcake\\LaravelDebugbar\\Middleware\\StopRecordingTelescope',
        ),
        'uses' => 'Fruitcake\\LaravelDebugbar\\Controllers\\OpenHandlerController@clockwork',
        'controller' => 'Fruitcake\\LaravelDebugbar\\Controllers\\OpenHandlerController@clockwork',
        'namespace' => NULL,
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
        'as' => 'debugbar.clockwork',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.assets' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/assets',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Fruitcake\\LaravelDebugbar\\Middleware\\DebugbarEnabled',
          1 => 'Fruitcake\\LaravelDebugbar\\Middleware\\StopRecordingTelescope',
        ),
        'uses' => 'Fruitcake\\LaravelDebugbar\\Controllers\\AssetController@getAssets',
        'controller' => 'Fruitcake\\LaravelDebugbar\\Controllers\\AssetController@getAssets',
        'namespace' => NULL,
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
        'as' => 'debugbar.assets',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NQIiqggbBbjqFMEt' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{path}',
      'action' => 
      array (
        'uses' => 'Bkwld\\Croppa\\Handler@handle',
        'controller' => 'Bkwld\\Croppa\\Handler@handle',
        'as' => 'generated::NQIiqggbBbjqFMEt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'path' => '(?=storage/(.*)$)(?=(.+)-([0-9_]+)x([0-9_]+)(-[0-9a-zA-Z(),\\-._]+)*\\.(jpg|jpeg|png|gif|webp|JPG|JPEG|PNG|GIF|WEBP)$).+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'boost.browser-logs' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_boost/browser-logs',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:1598:"function (\\Illuminate\\Http\\Request $request) {
            $logs = $request->input(\'logs\', []);

            // Handle sendBeacon\'s text/plain content type.
            if (empty($logs) && ! $request->isJson()) {
                $decoded = json_decode($request->getContent(), true);
                $logs = $decoded[\'logs\'] ?? [];
            }

            /** @var Logger $logger */
            $logger = \\Illuminate\\Support\\Facades\\Log::channel(\'browser\');

            /**
             *  @var array{
             *      type: \'error\'|\'warn\'|\'info\'|\'log\'|\'table\'|\'window_error\'|\'uncaught_error\'|\'unhandled_rejection\',
             *      timestamp: string,
             *      data: array,
             *      url:string,
             *      userAgent:string
             *  } $log */
            foreach ($logs as $log) {
                $logger->write(
                    level: match ($log[\'type\']) {
                        \'warn\' => \'warning\',
                        \'log\', \'table\' => \'debug\',
                        \'window_error\', \'uncaught_error\', \'unhandled_rejection\' => \'error\',
                        default => $log[\'type\']
                    },
                    message: self::buildLogMessageFromData($log[\'data\']),
                    context: [
                        \'url\' => $log[\'url\'],
                        \'user_agent\' => $log[\'userAgent\'] ?: null,
                        \'timestamp\' => $log[\'timestamp\'] ?: now()->toIso8601String(),
                    ]
                );
            }

            return response()->json([\'status\' => \'logged\']);
        }";s:5:"scope";s:34:"Laravel\\Boost\\BoostServiceProvider";s:4:"this";N;s:4:"self";s:32:"0000000000000abe0000000000000000";}}',
        'as' => 'boost.browser-logs',
        'excluded_middleware' => 
        array (
          0 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.healthCheck' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_ignition/health-check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController',
        'as' => 'ignition.healthCheck',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.executeSolution' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/execute-solution',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController',
        'as' => 'ignition.executeSolution',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.updateConfig' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/update-config',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController',
        'as' => 'ignition.updateConfig',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::index-blocks' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/blocks',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read blocks',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AdminController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AdminController@index',
        'as' => 'admin::index-blocks',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::create-block' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/blocks/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create blocks',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AdminController@create',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AdminController@create',
        'as' => 'admin::create-block',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::edit-block' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/blocks/{block}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read blocks',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AdminController@edit',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AdminController@edit',
        'as' => 'admin::edit-block',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::store-block' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/blocks',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create blocks',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AdminController@store',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AdminController@store',
        'as' => 'admin::store-block',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::update-block' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/blocks/{block}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:update blocks',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AdminController@update',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AdminController@update',
        'as' => 'admin::update-block',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZSkiKKQfoVLnDl0Z' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/blocks',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:read blocks',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\ApiController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\ApiController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::ZSkiKKQfoVLnDl0Z',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CmIXacff2MLjgpJT' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'api/blocks/{block}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:update blocks',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\ApiController@updatePartial',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\ApiController@updatePartial',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::CmIXacff2MLjgpJT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SgB1PSHzffLosyCa' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/blocks/{block}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:delete blocks',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\ApiController@destroy',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\ApiController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::SgB1PSHzffLosyCa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::change-locale' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/_locale/{locale}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\LocaleController@setContentLocale',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\LocaleController@setContentLocale',
        'as' => 'admin::change-locale',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:see dashboard',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\DashboardAdminController@dashboard',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\DashboardAdminController@dashboard',
        'as' => 'admin::dashboard',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:see dashboard',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\DashboardAdminController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\DashboardAdminController@index',
        'as' => 'admin::index',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::index-files' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/files',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read files',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\FilesAdminController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\FilesAdminController@index',
        'as' => 'admin::index-files',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::edit-file' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/files/{file}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read files',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\FilesAdminController@edit',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\FilesAdminController@edit',
        'as' => 'admin::edit-file',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::update-file' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/files/{file}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:update files',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\FilesAdminController@update',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\FilesAdminController@update',
        'as' => 'admin::update-file',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::crop-file' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/files/{file}/crop',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:update files',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\FilesAdminController@crop',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\FilesAdminController@crop',
        'as' => 'admin::crop-file',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3KZXVDwewxojbxGS' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/files',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:read files',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\FilesApiController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\FilesApiController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::3KZXVDwewxojbxGS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mRcHSJBOUKkv3m9q' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/files/{file}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:read files',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\FilesApiController@show',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\FilesApiController@show',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::mRcHSJBOUKkv3m9q',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dJnjrkAy0gGoTSuf' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/files',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:create files',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\FilesApiController@store',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\FilesApiController@store',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::dJnjrkAy0gGoTSuf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qnXb7JEtqElVu1lw' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'api/files/{ids}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:update files',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\FilesApiController@move',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\FilesApiController@move',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::qnXb7JEtqElVu1lw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VGeTz8Jy8vYpOzSj' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/files/{file}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:delete files',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\FilesApiController@destroy',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\FilesApiController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::VGeTz8Jy8vYpOzSj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ANrGDlKeWEs5EscL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/history',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:see history',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\HistoryApiController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\HistoryApiController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::ANrGDlKeWEs5EscL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kuRcoDz5vYjpe9Uf' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/history',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:clear history',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\HistoryApiController@destroy',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\HistoryApiController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::kuRcoDz5vYjpe9Uf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'llms-txt' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'llms.txt',
      'action' => 
      array (
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\LlmsTxtController@__invoke',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\LlmsTxtController',
        'as' => 'llms-txt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::index-menus' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/menus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read menus',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenusAdminController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenusAdminController@index',
        'as' => 'admin::index-menus',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::create-menu' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/menus/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create menus',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenusAdminController@create',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenusAdminController@create',
        'as' => 'admin::create-menu',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::edit-menu' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/menus/{menu}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read menus',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenusAdminController@edit',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenusAdminController@edit',
        'as' => 'admin::edit-menu',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::store-menu' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/menus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create menus',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenusAdminController@store',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenusAdminController@store',
        'as' => 'admin::store-menu',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::update-menu' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/menus/{menu}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:update menus',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenusAdminController@update',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenusAdminController@update',
        'as' => 'admin::update-menu',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::create-menulink' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/menus/{menu}/menulinks/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create menulinks',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenulinksAdminController@create',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenulinksAdminController@create',
        'as' => 'admin::create-menulink',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::edit-menulink' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/menus/{menu}/menulinks/{menulink}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read menulinks',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenulinksAdminController@edit',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenulinksAdminController@edit',
        'as' => 'admin::edit-menulink',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::store-menulink' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/menus/{menu}/menulinks',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create menulinks',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenulinksAdminController@store',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenulinksAdminController@store',
        'as' => 'admin::store-menulink',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::update-menulink' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/menus/{menu}/menulinks/{menulink}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:update menulinks',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenulinksAdminController@update',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenulinksAdminController@update',
        'as' => 'admin::update-menulink',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7U4a1881lyMiVpJo' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/menus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:read menus',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenusApiController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenusApiController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::7U4a1881lyMiVpJo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::i2z8CGgXwpNu7h4w' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'api/menus/{menu}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:update menus',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenusApiController@updatePartial',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenusApiController@updatePartial',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::i2z8CGgXwpNu7h4w',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::44maYlqSi70FDAMH' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/menus/{menu}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:delete menus',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenusApiController@destroy',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenusApiController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::44maYlqSi70FDAMH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MhpDxqKCu3U3bKP2' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/menus/{menu}/menulinks',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:read menulinks',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenulinksApiController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenulinksApiController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::MhpDxqKCu3U3bKP2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VFDDuWD4dA8eaSyR' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'api/menus/{menu}/menulinks/{menulink}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:update menulinks',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenulinksApiController@updatePartial',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenulinksApiController@updatePartial',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::VFDDuWD4dA8eaSyR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RvMjMHjavUwAeo9y' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/menus/{menu}/menulinks/sort',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:update menulinks',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenulinksApiController@sort',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenulinksApiController@sort',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::RvMjMHjavUwAeo9y',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GjwBTdZPGZvZrnyp' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/menus/{menu}/menulinks/{menulink}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:delete menulinks',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenulinksApiController@destroy',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\MenulinksApiController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::GjwBTdZPGZvZrnyp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::index-roles' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/roles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read roles',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\RolesAdminController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\RolesAdminController@index',
        'as' => 'admin::index-roles',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::create-role' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/roles/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create roles',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\RolesAdminController@create',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\RolesAdminController@create',
        'as' => 'admin::create-role',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::edit-role' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/roles/{role}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read roles',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\RolesAdminController@edit',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\RolesAdminController@edit',
        'as' => 'admin::edit-role',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::store-role' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/roles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create roles',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\RolesAdminController@store',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\RolesAdminController@store',
        'as' => 'admin::store-role',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::update-role' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/roles/{role}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:update roles',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\RolesAdminController@update',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\RolesAdminController@update',
        'as' => 'admin::update-role',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::LnTvCh3M1rbsyfsb' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/roles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:read roles',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\RolesApiController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\RolesApiController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::LnTvCh3M1rbsyfsb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::T4HyrMdbvR94Jq3H' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'api/roles/{role}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:update roles',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\RolesApiController@updatePartial',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\RolesApiController@updatePartial',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::T4HyrMdbvR94Jq3H',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2IK73I8dDqD6MdTO' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/roles/{role}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:delete roles',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\RolesApiController@destroy',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\RolesApiController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::2IK73I8dDqD6MdTO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'en::search' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'en/search-results',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\SearchPublicController@search',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\SearchPublicController@search',
        'as' => 'en::search',
        'namespace' => NULL,
        'prefix' => 'en/search-results',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ar::search' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ar/search-results',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\SearchPublicController@search',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\SearchPublicController@search',
        'as' => 'ar::search',
        'namespace' => NULL,
        'prefix' => 'ar/search-results',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::index-settings' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read settings',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\SettingsAdminController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\SettingsAdminController@index',
        'as' => 'admin::index-settings',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::update-settings' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:update settings',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\SettingsAdminController@save',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\SettingsAdminController@save',
        'as' => 'admin::update-settings',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::clear-cache' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/cache/clear',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:clear cache',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\SettingsAdminController@clearCache',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\SettingsAdminController@clearCache',
        'as' => 'admin::clear-cache',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::delete-image-in-settings' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'admin/settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:update settings',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\SettingsAdminController@deleteImage',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\SettingsAdminController@deleteImage',
        'as' => 'admin::delete-image-in-settings',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'sitemap' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sitemap.xml',
      'action' => 
      array (
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\SitemapPublicController@generate',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\SitemapPublicController@generate',
        'as' => 'sitemap',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::index-tags' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/tags',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read tags',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TagsAdminController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TagsAdminController@index',
        'as' => 'admin::index-tags',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::create-tag' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/tags/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create tags',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TagsAdminController@create',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TagsAdminController@create',
        'as' => 'admin::create-tag',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::edit-tag' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/tags/{tag}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read tags',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TagsAdminController@edit',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TagsAdminController@edit',
        'as' => 'admin::edit-tag',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::store-tag' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/tags',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create tags',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TagsAdminController@store',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TagsAdminController@store',
        'as' => 'admin::store-tag',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::update-tag' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/tags/{tag}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:update tags',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TagsAdminController@update',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TagsAdminController@update',
        'as' => 'admin::update-tag',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qrmQPcDjOR9GmDyi' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/tags-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TagsApiController@tagsList',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TagsApiController@tagsList',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::qrmQPcDjOR9GmDyi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cLlkMJM9uCxlNAOy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/tags',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:read tags',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TagsApiController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TagsApiController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::cLlkMJM9uCxlNAOy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vwcEIVwzt7jhk0z1' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'api/tags/{tag}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:update tags',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TagsApiController@updatePartial',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TagsApiController@updatePartial',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::vwcEIVwzt7jhk0z1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VAFsoZzWv2DPthz0' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/tags/{tag}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:delete tags',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TagsApiController@destroy',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TagsApiController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::VAFsoZzWv2DPthz0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::index-taxonomies' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/taxonomies',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read taxonomies',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TaxonomiesAdminController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TaxonomiesAdminController@index',
        'as' => 'admin::index-taxonomies',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::export-taxonomies' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/taxonomies/export',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read taxonomies',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TaxonomiesAdminController@export',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TaxonomiesAdminController@export',
        'as' => 'admin::export-taxonomies',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::create-taxonomy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/taxonomies/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create taxonomies',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TaxonomiesAdminController@create',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TaxonomiesAdminController@create',
        'as' => 'admin::create-taxonomy',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::edit-taxonomy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/taxonomies/{taxonomy}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read taxonomies',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TaxonomiesAdminController@edit',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TaxonomiesAdminController@edit',
        'as' => 'admin::edit-taxonomy',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::store-taxonomy' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/taxonomies',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create taxonomies',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TaxonomiesAdminController@store',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TaxonomiesAdminController@store',
        'as' => 'admin::store-taxonomy',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::update-taxonomy' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/taxonomies/{taxonomy}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:update taxonomies',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TaxonomiesAdminController@update',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TaxonomiesAdminController@update',
        'as' => 'admin::update-taxonomy',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::index-terms' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/taxonomies/{taxonomy}/terms',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read terms',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TermsAdminController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TermsAdminController@index',
        'as' => 'admin::index-terms',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::create-term' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/taxonomies/{taxonomy}/terms/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create terms',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TermsAdminController@create',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TermsAdminController@create',
        'as' => 'admin::create-term',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::edit-term' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/taxonomies/{taxonomy}/terms/{term}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read terms',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TermsAdminController@edit',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TermsAdminController@edit',
        'as' => 'admin::edit-term',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::store-term' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/taxonomies/{taxonomy}/terms',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create terms',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TermsAdminController@store',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TermsAdminController@store',
        'as' => 'admin::store-term',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::update-term' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/taxonomies/{taxonomy}/terms/{term}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:update terms',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TermsAdminController@update',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TermsAdminController@update',
        'as' => 'admin::update-term',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3RqVx0gcsLSEDt8M' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/taxonomies',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:read taxonomies',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TaxonomiesApiController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TaxonomiesApiController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::3RqVx0gcsLSEDt8M',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::P5rBNJAR01c3m1MD' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'api/taxonomies/{taxonomy}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:update taxonomies',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TaxonomiesApiController@updatePartial',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TaxonomiesApiController@updatePartial',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::P5rBNJAR01c3m1MD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::iZiPynudcwl6eR0w' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/taxonomies/{taxonomy}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:delete taxonomies',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TaxonomiesApiController@destroy',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TaxonomiesApiController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::iZiPynudcwl6eR0w',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Si1KiFI5qX7HfwuR' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/taxonomies/{taxonomy}/terms',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:read terms',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TermsApiController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TermsApiController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::Si1KiFI5qX7HfwuR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ihIwagzm5iHGqbSB' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'api/taxonomies/{taxonomy}/terms/{term}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:update terms',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TermsApiController@updatePartial',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TermsApiController@updatePartial',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::ihIwagzm5iHGqbSB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9eM1p3R49rS5sOfh' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/taxonomies/{taxonomy}/terms/{term}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:delete terms',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TermsApiController@destroy',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TermsApiController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::9eM1p3R49rS5sOfh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::index-translations' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/translations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read translations',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TranslationsAdminController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TranslationsAdminController@index',
        'as' => 'admin::index-translations',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::create-translation' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/translations/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create translations',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TranslationsAdminController@create',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TranslationsAdminController@create',
        'as' => 'admin::create-translation',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::edit-translation' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/translations/{translation}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read translations',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TranslationsAdminController@edit',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TranslationsAdminController@edit',
        'as' => 'admin::edit-translation',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::store-translation' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/translations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create translations',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TranslationsAdminController@store',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TranslationsAdminController@store',
        'as' => 'admin::store-translation',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::update-translation' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/translations/{translation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:update translations',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TranslationsAdminController@update',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TranslationsAdminController@update',
        'as' => 'admin::update-translation',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZzobHubcwMVUe8vH' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/translations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:read translations',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TranslationsApiController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TranslationsApiController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::ZzobHubcwMVUe8vH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KVsetkKC1GoYFtBX' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'api/translations/{translation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:update translations',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TranslationsApiController@updatePartial',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TranslationsApiController@updatePartial',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::KVsetkKC1GoYFtBX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::P3GCaCSa6Oalv3qY' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/translations/{translation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:delete translations',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TranslationsApiController@destroy',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\TranslationsApiController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::P3GCaCSa6Oalv3qY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'en::register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'en/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
          3 => 'guest',
        ),
        'uses' => '\\TypiCMS\\Modules\\Core\\Http\\Controllers\\RegisterController@showRegistrationForm',
        'controller' => '\\TypiCMS\\Modules\\Core\\Http\\Controllers\\RegisterController@showRegistrationForm',
        'as' => 'en::register',
        'namespace' => NULL,
        'prefix' => 'en',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'en::register-action' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'en/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
          3 => 'guest',
          4 => 'throttle:5,1',
        ),
        'uses' => '\\TypiCMS\\Modules\\Core\\Http\\Controllers\\RegisterController@register',
        'controller' => '\\TypiCMS\\Modules\\Core\\Http\\Controllers\\RegisterController@register',
        'as' => 'en::register-action',
        'namespace' => NULL,
        'prefix' => 'en',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'en::login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'en/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
          3 => 'guest',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@showPasskeyLoginForm',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@showPasskeyLoginForm',
        'as' => 'en::login',
        'namespace' => NULL,
        'prefix' => 'en',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'en::otp-login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'en/otp-login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
          3 => 'guest',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@showOneTimePasswordLoginForm',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@showOneTimePasswordLoginForm',
        'as' => 'en::otp-login',
        'namespace' => NULL,
        'prefix' => 'en',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'en::send-one-time-password' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'en/otp-login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
          3 => 'guest',
          4 => 'throttle:5,1',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@submitOneTimePasswordLoginForm',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@submitOneTimePasswordLoginForm',
        'as' => 'en::send-one-time-password',
        'namespace' => NULL,
        'prefix' => 'en',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'en::login-code' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'en/otp-login-code',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
          3 => 'guest',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@showOneTimePasswordForm',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@showOneTimePasswordForm',
        'as' => 'en::login-code',
        'namespace' => NULL,
        'prefix' => 'en',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'en::submit-one-time-password' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'en/otp-login-code',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
          3 => 'guest',
          4 => 'throttle:5,1',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@submitOneTimePassword',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@submitOneTimePassword',
        'as' => 'en::submit-one-time-password',
        'namespace' => NULL,
        'prefix' => 'en',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'en::create-passkey' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'en/create-passkey',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
          3 => 'auth',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@showPasskeyCreationForm',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@showPasskeyCreationForm',
        'as' => 'en::create-passkey',
        'namespace' => NULL,
        'prefix' => 'en',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'en::logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'en/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@logout',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@logout',
        'as' => 'en::logout',
        'namespace' => NULL,
        'prefix' => 'en',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'en::stop-impersonation' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'en/stop-impersonation',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\ImpersonateController@stopImpersonation',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\ImpersonateController@stopImpersonation',
        'as' => 'en::stop-impersonation',
        'namespace' => NULL,
        'prefix' => 'en',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ar::register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ar/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
          3 => 'guest',
        ),
        'uses' => '\\TypiCMS\\Modules\\Core\\Http\\Controllers\\RegisterController@showRegistrationForm',
        'controller' => '\\TypiCMS\\Modules\\Core\\Http\\Controllers\\RegisterController@showRegistrationForm',
        'as' => 'ar::register',
        'namespace' => NULL,
        'prefix' => 'ar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ar::register-action' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ar/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
          3 => 'guest',
          4 => 'throttle:5,1',
        ),
        'uses' => '\\TypiCMS\\Modules\\Core\\Http\\Controllers\\RegisterController@register',
        'controller' => '\\TypiCMS\\Modules\\Core\\Http\\Controllers\\RegisterController@register',
        'as' => 'ar::register-action',
        'namespace' => NULL,
        'prefix' => 'ar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ar::login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ar/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
          3 => 'guest',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@showPasskeyLoginForm',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@showPasskeyLoginForm',
        'as' => 'ar::login',
        'namespace' => NULL,
        'prefix' => 'ar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ar::otp-login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ar/otp-login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
          3 => 'guest',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@showOneTimePasswordLoginForm',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@showOneTimePasswordLoginForm',
        'as' => 'ar::otp-login',
        'namespace' => NULL,
        'prefix' => 'ar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ar::send-one-time-password' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ar/otp-login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
          3 => 'guest',
          4 => 'throttle:5,1',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@submitOneTimePasswordLoginForm',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@submitOneTimePasswordLoginForm',
        'as' => 'ar::send-one-time-password',
        'namespace' => NULL,
        'prefix' => 'ar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ar::login-code' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ar/otp-login-code',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
          3 => 'guest',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@showOneTimePasswordForm',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@showOneTimePasswordForm',
        'as' => 'ar::login-code',
        'namespace' => NULL,
        'prefix' => 'ar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ar::submit-one-time-password' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ar/otp-login-code',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
          3 => 'guest',
          4 => 'throttle:5,1',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@submitOneTimePassword',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@submitOneTimePassword',
        'as' => 'ar::submit-one-time-password',
        'namespace' => NULL,
        'prefix' => 'ar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ar::create-passkey' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ar/create-passkey',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
          3 => 'auth',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@showPasskeyCreationForm',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@showPasskeyCreationForm',
        'as' => 'ar::create-passkey',
        'namespace' => NULL,
        'prefix' => 'ar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ar::logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ar/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@logout',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthController@logout',
        'as' => 'ar::logout',
        'namespace' => NULL,
        'prefix' => 'ar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ar::stop-impersonation' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ar/stop-impersonation',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
          1 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\JavaScriptData',
          2 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\ImpersonateController@stopImpersonation',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\ImpersonateController@stopImpersonation',
        'as' => 'ar::stop-impersonation',
        'namespace' => NULL,
        'prefix' => 'ar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passkeys.authentication_options' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'passkeys/authentication-options',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
        ),
        'uses' => 'Spatie\\LaravelPasskeys\\Http\\Controllers\\GeneratePasskeyAuthenticationOptionsController@__invoke',
        'controller' => 'Spatie\\LaravelPasskeys\\Http\\Controllers\\GeneratePasskeyAuthenticationOptionsController',
        'namespace' => NULL,
        'prefix' => '/passkeys',
        'where' => 
        array (
        ),
        'as' => 'passkeys.authentication_options',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passkeys.login' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'passkeys/authenticate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Spatie\\ResponseCache\\Middlewares\\DoNotCacheResponse',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthenticateUsingPasskeyController@__invoke',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\AuthenticateUsingPasskeyController',
        'namespace' => NULL,
        'prefix' => '/passkeys',
        'where' => 
        array (
        ),
        'as' => 'passkeys.login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::index-users' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read users',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\UsersAdminController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\UsersAdminController@index',
        'as' => 'admin::index-users',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::export-users' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users/export',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read users',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\UsersAdminController@export',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\UsersAdminController@export',
        'as' => 'admin::export-users',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::create-user' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create users',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\UsersAdminController@create',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\UsersAdminController@create',
        'as' => 'admin::create-user',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::edit-user' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users/{user}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read users',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\UsersAdminController@edit',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\UsersAdminController@edit',
        'as' => 'admin::edit-user',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::store-user' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create users',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\UsersAdminController@store',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\UsersAdminController@store',
        'as' => 'admin::store-user',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::update-user' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:update users',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\UsersAdminController@update',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\UsersAdminController@update',
        'as' => 'admin::update-user',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::impersonate-user' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users/{id}/impersonate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:impersonate users',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\ImpersonateController@start',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\ImpersonateController@start',
        'as' => 'admin::impersonate-user',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::profile' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:edit profile',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\ProfileController@edit',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\ProfileController@edit',
        'as' => 'admin::profile',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::update-profile' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:edit profile',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\ProfileController@update',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\ProfileController@update',
        'as' => 'admin::update-profile',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3mfKQTyvlZJGIb27' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:read users',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\UsersApiController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\UsersApiController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::3mfKQTyvlZJGIb27',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bXdtMGxzpTm5q0Ih' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/users/current/update-preferences',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:update users',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\UsersApiController@updatePreferences',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\UsersApiController@updatePreferences',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::bXdtMGxzpTm5q0Ih',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wT12GyLlJNmkI2g1' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:delete users',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\UsersApiController@destroy',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\UsersApiController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::wT12GyLlJNmkI2g1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tvoGVnuTPm98PEwD' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/passkeys/{passkey}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PasskeysApiController@destroy',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PasskeysApiController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::tvoGVnuTPm98PEwD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::htSWB5zJ9SV7lqUh' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/passkeys',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PasskeysApiController@store',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PasskeysApiController@store',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::htSWB5zJ9SV7lqUh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PL9AiD9GiN7cxPct' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/passkeys/generate-options',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PasskeysApiController@generatePasskeyOptions',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PasskeysApiController@generatePasskeyOptions',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::PL9AiD9GiN7cxPct',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mYABSgL2u3n0SO9W' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/users/{user}/passkeys',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PasskeysApiController@getPasskeys',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PasskeysApiController@getPasskeys',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::mYABSgL2u3n0SO9W',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::o3q2VQH3N8uTGPKX' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'up',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:1123:"function (\\Illuminate\\Http\\Request $request) {
                    $exception = null;

                    try {
                        \\Illuminate\\Support\\Facades\\Event::dispatch(new \\Illuminate\\Foundation\\Events\\DiagnosingHealth);
                    } catch (\\Throwable $e) {
                        if (app()->hasDebugModeEnabled()) {
                            throw $e;
                        }

                        report($e);

                        $exception = $e->getMessage();
                    }

                    $status = $exception ? 500 : 200;

                    if ($request->expectsJson()) {
                        return response()->json([
                            \'status\' => $exception ? \'down\' : \'up\',
                        ], $status);
                    }

                    return response(\\Illuminate\\Support\\Facades\\View::file(\'/Users/aldoyh/Sites/jareeda/vendor/laravel/framework/src/Illuminate/Foundation/Configuration\'.\'/../resources/health-up.blade.php\', [
                        \'exception\' => $exception,
                    ]), status: $status);
                }";s:5:"scope";s:54:"Illuminate\\Foundation\\Configuration\\ApplicationBuilder";s:4:"this";N;s:4:"self";s:32:"0000000000000c150000000000000000";}}',
        'as' => 'generated::o3q2VQH3N8uTGPKX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'storage.local' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'storage/{path}',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:3:{s:4:"disk";s:5:"local";s:6:"config";a:5:{s:6:"driver";s:5:"local";s:4:"root";s:47:"/Users/aldoyh/Sites/jareeda/storage/app/private";s:5:"serve";b:1;s:5:"throw";b:0;s:6:"report";b:0;}s:12:"isProduction";b:0;}s:8:"function";s:323:"function (\\Illuminate\\Http\\Request $request, string $path) use ($disk, $config, $isProduction) {
                    return (new \\Illuminate\\Filesystem\\ServeFile(
                        $disk,
                        $config,
                        $isProduction
                    ))($request, $path);
                }";s:5:"scope";s:47:"Illuminate\\Filesystem\\FilesystemServiceProvider";s:4:"this";N;s:4:"self";s:32:"0000000000000c110000000000000000";}}',
        'as' => 'storage.local',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'path' => '.*',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'storage.local.upload' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'storage/{path}',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:3:{s:4:"disk";s:5:"local";s:6:"config";a:5:{s:6:"driver";s:5:"local";s:4:"root";s:47:"/Users/aldoyh/Sites/jareeda/storage/app/private";s:5:"serve";b:1;s:5:"throw";b:0;s:6:"report";b:0;}s:12:"isProduction";b:0;}s:8:"function";s:325:"function (\\Illuminate\\Http\\Request $request, string $path) use ($disk, $config, $isProduction) {
                    return (new \\Illuminate\\Filesystem\\ReceiveFile(
                        $disk,
                        $config,
                        $isProduction
                    ))($request, $path);
                }";s:5:"scope";s:47:"Illuminate\\Filesystem\\FilesystemServiceProvider";s:4:"this";N;s:4:"self";s:32:"0000000000000c0f0000000000000000";}}',
        'as' => 'storage.local.upload',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'path' => '.*',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::index-pages' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/pages',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read pages',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesAdminController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesAdminController@index',
        'as' => 'admin::index-pages',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::create-page' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/pages/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create pages',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesAdminController@create',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesAdminController@create',
        'as' => 'admin::create-page',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::edit-page' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/pages/{page}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read pages',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesAdminController@edit',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesAdminController@edit',
        'as' => 'admin::edit-page',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::store-page' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/pages',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create pages',
          2 => 'TypiCMS\\Modules\\Core\\Http\\Middleware\\InheritParentPrivacy',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesAdminController@store',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesAdminController@store',
        'as' => 'admin::store-page',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::update-page' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/pages/{page}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:update pages',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesAdminController@update',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesAdminController@update',
        'as' => 'admin::update-page',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::create-page_section' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/pages/{page}/sections/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create page_sections',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsAdminController@create',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsAdminController@create',
        'as' => 'admin::create-page_section',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::edit-page_section' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/pages/{page}/sections/{section}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read page_sections',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsAdminController@edit',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsAdminController@edit',
        'as' => 'admin::edit-page_section',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::store-page_section' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/pages/{page}/sections',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:create page_sections',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsAdminController@store',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsAdminController@store',
        'as' => 'admin::store-page_section',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::update-page_section' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/pages/{page}/sections/{section}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:update page_sections',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsAdminController@update',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsAdminController@update',
        'as' => 'admin::update-page_section',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::sort-page_sections' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/pages/{page}/sections/sort',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsAdminController@sort',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsAdminController@sort',
        'as' => 'admin::sort-page_sections',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::index-page_sections' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/sections',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:read page_sections',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsAdminController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsAdminController@index',
        'as' => 'admin::index-page_sections',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::destroy-page_section' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/sections/{section}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
          1 => 'can:delete page_sections',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsAdminController@destroyMultiple',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsAdminController@destroyMultiple',
        'as' => 'admin::destroy-page_section',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin::show-404-page-in-admin' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/{uri}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'admin',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesAdminController@notFound',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesAdminController@notFound',
        'as' => 'admin::show-404-page-in-admin',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'uri' => '(.*)',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kgT6PeoyeixsoxoE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/pages',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:read pages',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesApiController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesApiController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::kgT6PeoyeixsoxoE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZuMaq4tXHvdPAD8n' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/pages/links-for-editor',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesApiController@linksForEditor',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesApiController@linksForEditor',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::ZuMaq4tXHvdPAD8n',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WmEnAgqNxjM9zGCN' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'api/pages/{page}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:update pages',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesApiController@updatePartial',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesApiController@updatePartial',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::WmEnAgqNxjM9zGCN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7XRDzxRj70STDMK8' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/pages/sort',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:update pages',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesApiController@sort',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesApiController@sort',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::7XRDzxRj70STDMK8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::LvV7UkzOJ7ZOfzwB' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/pages/{page}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:delete pages',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesApiController@destroy',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesApiController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::LvV7UkzOJ7ZOfzwB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vNpASC9tqYkcNNuI' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/pages/{page}/sections',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:read page_sections',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsApiController@index',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsApiController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::vNpASC9tqYkcNNuI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tEFINhXrSXokqX6U' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'api/pages/{page}/sections/{section}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:update page_sections',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsApiController@updatePartial',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsApiController@updatePartial',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::tEFINhXrSXokqX6U',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7TsmvdmrknQoblF3' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/pages/{page}/sections/{section}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'can:delete page_sections',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsApiController@destroy',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PageSectionsApiController@destroy',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::7TsmvdmrknQoblF3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mbCElTrfke0GfdTf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesPublicController@redirectToHomepage',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesPublicController@redirectToHomepage',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::mbCElTrfke0GfdTf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::upemGGcJw5thgHgI' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'en/{uri}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
        ),
        'uses' => '\\TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesPublicController@uri',
        'controller' => '\\TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesPublicController@uri',
        'prefix' => 'en/',
        'namespace' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::upemGGcJw5thgHgI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'uri' => '(.*)',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6uYBV9tqIKnWsf7l' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ar/{uri}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
        ),
        'uses' => '\\TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesPublicController@uri',
        'controller' => '\\TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesPublicController@uri',
        'prefix' => 'ar/',
        'namespace' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::6uYBV9tqIKnWsf7l',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'uri' => '(.*)',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::o0QOuQDwHpyS0ysm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{uri}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'public',
        ),
        'uses' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesPublicController@uri',
        'controller' => 'TypiCMS\\Modules\\Core\\Http\\Controllers\\PagesPublicController@uri',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::o0QOuQDwHpyS0ysm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'uri' => '(.*)',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.news.generate-image' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/news/{articleId}/generate-image',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'auth',
          1 => 'verified',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AiImageController@generate',
        'controller' => 'App\\Http\\Controllers\\Admin\\AiImageController@generate',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
        'as' => 'admin.news.generate-image',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.news.queue-generate-image' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/news/{articleId}/queue-generate-image',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'auth',
          1 => 'verified',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AiImageController@queueGenerate',
        'controller' => 'App\\Http\\Controllers\\Admin\\AiImageController@queueGenerate',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
        'as' => 'admin.news.queue-generate-image',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.news.image-status' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/news/{articleId}/image-status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'auth',
          1 => 'verified',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AiImageController@status',
        'controller' => 'App\\Http\\Controllers\\Admin\\AiImageController@status',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
        'as' => 'admin.news.image-status',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.news.clear-ai-image' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/news/{articleId}/clear-ai-image',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'auth',
          1 => 'verified',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AiImageController@clear',
        'controller' => 'App\\Http\\Controllers\\Admin\\AiImageController@clear',
        'namespace' => NULL,
        'prefix' => 'admin',
        'where' => 
        array (
        ),
        'as' => 'admin.news.clear-ai-image',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
