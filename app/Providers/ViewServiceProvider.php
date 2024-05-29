<?php

namespace App\Providers;

use App\Models\Branch;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
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
        View::composer('*', function ($view) {
            $branches = [];
            $branchWithCun = null;
            if (Auth::check()) {
                $user = Auth::user();
                $branches = $user->branches;

                $cun = session('cun');

                if ($cun) {
                    $branchWithCun = $branches->firstWhere('cun', $cun);
                }
            }
            $view->with('branches', $branches);
            $view->with('branchWithCun', $branchWithCun);
        });
    }
}
