<?php

namespace App\Http\ViewComposers;

use App\Models\Menu;
use Illuminate\View\View;
use App\Models\Site_bilgi;
use App\Models\Site_Hizmet;


class MasterComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $siteHizmetler = Site_Hizmet::all();
        $siteBilgiler =  Site_bilgi::first();
        $menuler = Menu::all();
        $view->with('siteBilgiler', $siteBilgiler)->with('menuler',$menuler)->with('siteHizmetler',$siteHizmetler);
    }
}