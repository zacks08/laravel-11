<?php

namespace App\Providers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RoutesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
         // Web padrão
        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        // API padrão
/*         Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));
 */
        // Organização de rotas
        Route::middleware('web')
        ->group(base_path('routes/comments.php'));


         Route::middleware('web')
        ->group(base_path('routes/users.php'));

         Route::middleware('web')
        ->group(base_path('routes/profile.php'));

         Route::middleware('web')
        ->group(base_path('routes/posts.php'));


    }
}
