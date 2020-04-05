<?php

namespace App\Providers;

use App\Menu;
use App\Message;
use App\SocialNetwork;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

include app_path() . '/jdf.php';

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
        $menus = Menu::where('role','3')->get();
        // $new_messages_count = tr_num(Message::where('new', '=', '1')->count(), 'fa');
        $social_networks = SocialNetwork::all();

        View::share('menus', $menus);
        // View::share('new_messages_count', $new_messages_count);
        View::share('social_networks', $social_networks);
    }
}
