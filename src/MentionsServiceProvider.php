<?php
namespace Kaom\Mentions;

use Kaom\Mentions\Builder\MentionBuilder;
use Illuminate\Support\ServiceProvider;

class MentionsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('mentionBuilder', function ($app) {
            $form = new MentionBuilder($app['html'], $app['url'], $app['session.store']->getToken());

            return $form->setSessionStore($app['session.store']);
        });
    }

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $config = realpath(__DIR__.'/../config/mentions.php');
        $views  = realpath(__DIR__.'/../resources/views');
        $script = realpath(__DIR__.'/../resources/assets');

        $this->publishes([
            $config => config_path('mentions.php'),
            $views  => base_path('resources/views/vendor/mentions'),
            $script => public_path('scripts'),
        ]);

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mentions');

        require_once __DIR__.'/Http/routes.php';
    }
}
