<?php

namespace App\Providers;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Builder::macro('search', function ($field, $string) {
            return $string ? $this->where($field, 'like', '%' . $string . '%') : $this;
        });

        Builder::macro('toCsv', function () {
            $results = $this->get();
            if ($results->count() < 1) return;

            $titles = implode(',', array_keys((array) $results->first()));
            $values = $results->map(function ($result) {

                $dddd = implode(',', collect($result)->map(function ($thing) {


                    return '"' . $thing . '"';
                })->toArray());
                return $dddd;
            });

            $values->prepend($titles);

            return $values->implode("\n");
        });
    }
}
