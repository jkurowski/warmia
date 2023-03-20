<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Building;
use App\Models\Client;
use App\Models\ClientFile;
use App\Models\ClientNote;
use App\Models\Event;
use App\Models\File;
use App\Models\Floor;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Investment;
use App\Models\Page;
use App\Models\Property;
use App\Models\Settings;
use App\Models\Slider;
use App\Models\Url;
use App\Models\Box;

use App\Observers\ArticleObserver;
use App\Observers\BoxObserver;
use App\Observers\BuildingObserver;
use App\Observers\ClientFileObserver;
use App\Observers\ClientObserver;
use App\Observers\FileObserver;
use App\Observers\FloorObserver;
use App\Observers\GalleryObserver;
use App\Observers\ImageObserver;
use App\Observers\InvestmentObserver;
use App\Observers\PageObserver;
use App\Observers\PropertyObserver;
use App\Observers\SliderObserver;
use App\Observers\UrlObserver;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Models\Activity;
use Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Settings::class, function () {
            return Settings::make(storage_path('app/settings.json'));
        });
        $this->app->bind('App\Repositories\EloquentRepositoryInterface', 'App\Repositories\BaseRepository');
        $this->app->bind('App\Repositories\UserRepositoryInterface', 'App\Repositories\UserRepository');
        $this->app->bind('App\Repositories\SliderRepositoryInterface', 'App\Repositories\SliderRepository');
        $this->app->bind('App\Repositories\BoxRepositoryInterface', 'App\Repositories\Client\ClientRepository');
        $this->app->bind('App\Repositories\ArticleRepositoryInterface', 'App\Repositories\ArticleRepository');
        $this->app->bind('App\Repositories\PageRepositoryInterface', 'App\Repositories\PageRepository');
        $this->app->bind('App\Repositories\UrlRepositoryInterface', 'App\Repositories\UrlRepository');
        $this->app->bind('App\Repositories\ImageRepositoryInterface', 'App\Repositories\ImageRepository');
        $this->app->bind('App\Repositories\InvestmentRepositoryInterface', 'App\Repositories\InvestmentRepository');
        $this->app->bind('App\Repositories\SectionRepositoryInterface', 'App\Repositories\SectionRepository');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Activity::saving(function (Activity $activity) {
            $activity->properties = collect([
                "route"         => Request::getPathInfo(),
                "ipAddress"     => Request::ip(),
                "userAgent"     => Request::header('user-agent'),
                "locale"        => Request::header('accept-language'),
                "referer"       => Request::header('referer'),
                "methodType"    => Request::method()
            ]);
        });

        View::composer('admin.crm.client.*', function ($view) {
            $currentRoute = Route::current();
            $params = $currentRoute->parameters();
            if(isset($params['client'])){
                $view->with('clientLastEvents', Event::where("client_id", $params['client']['id'])
                    ->whereUserId(auth()->id())
                    ->limit(3)
                    ->latest()
                    ->get(['created_at', 'name']));

                $view->with('clientLastNotes', ClientNote::where("client_id", $params['client']['id'])
                    ->whereUserId(auth()->id())
                    ->limit(3)
                    ->latest()
                    ->get(['created_at', 'text']));

                $view->with('clientLastFiles', ClientFile::where("client_id", $params['client']['id'])
                    ->whereUserId(auth()->id())
                    ->limit(3)
                    ->latest()
                    ->get(['created_at', 'name', 'size']));
            }
        });

        view()->composer('*', function ($view) {
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', config('app.available_locales'));
        });

        Image::observe(ImageObserver::class);
        Gallery::observe(GalleryObserver::class);
        Article::observe(ArticleObserver::class);
        Client::observe(ClientObserver::class);
        Slider::observe(SliderObserver::class);
        Box::observe(BoxObserver::class);
        Article::observe(ArticleObserver::class);
        Page::observe(PageObserver::class);
        Url::observe(UrlObserver::class);
        Image::observe(ImageObserver::class);
        File::observe(FileObserver::class);
        ClientFile::observe(ClientFileObserver::class);

        /*
        |--------------------------------------------------------------------------
        | DeveloPro
        |--------------------------------------------------------------------------
        */
        Investment::observe(InvestmentObserver::class);
        Building::observe(BuildingObserver::class);
        Floor::observe(FloorObserver::class);
        Property::observe(PropertyObserver::class);
    }
}
