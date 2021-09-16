<?php

namespace App\Providers;

use App\Models\Company;
use App\Observers\CompanyObserver;
use Illuminate\Support\Facades\Blade;
use Livewire\Component;
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
        Blade::directive('br2nl', function ($string) {
            return "<?php echo preg_replace('/\<br(\s*)?\/?\>/i', \"\n\", $string); ?>";
        });
        Company::observe(CompanyObserver::class);
    }
}
