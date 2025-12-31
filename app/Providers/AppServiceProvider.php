<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Number;
use App\Actions\ValidateCartStock;
use App\Services\SessionCartService;
use Illuminate\Support\Facades\Gate;
use App\Contract\CartServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Dotenv\Exception\ValidationException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CartServiceInterface::class, SessionCartService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Number::useCurrency('IDR');

        Gate::define('is_stock_avaliable', function (User $user = null) {
            try {
                ValidateCartStock::run($this->app->make(CartServiceInterface::class));
                return true;
            } catch (ValidationException $e) {
                session()->flash('error', $e->getMessage());
                return false;
            }
        });
    }
}
