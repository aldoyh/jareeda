<?php

namespace App\Providers;

use Illuminate\Database\Query\Grammars\SQLiteGrammar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // SQLite compares JSON extracted values by their storage class (e.g. an
        // integer), while Laravel binds comparison values as strings. This makes
        // `where('status->en', '1')` return no rows. Cast the extracted value to
        // TEXT so JSON path comparisons behave like on MySQL.
        if (config('database.default') === 'sqlite') {
            $connection = DB::connection('sqlite');
            $connection->setQueryGrammar(new class($connection) extends SQLiteGrammar
            {
                protected function wrapJsonSelector($value)
                {
                    [$field, $path] = $this->wrapJsonFieldAndPath($value);

                    return 'CAST(json_extract(' . $field . $path . ') AS TEXT)';
                }
            });
        }
    }
}
