<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        try{
            $categoriesGlobal = Category::with('childs:id,c_name,c_parent_id,c_slug')->where('c_parent_id', 0)->get();
            $menusGlobal = Menu::all();
        } catch(\Exception $exception)
        {

        }
        View::share('categoriesGlobal', $categoriesGlobal ?? []);
        View::share('menusGlobal', $menusGlobal ?? []);
    }
}
