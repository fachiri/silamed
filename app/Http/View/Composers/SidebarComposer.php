<?php

namespace App\Http\View\Composers;

use App\Models\Sosmed;
use Illuminate\View\View;

class SidebarComposer
{
    public function compose(View $view)
    {
        $sidebarLinks = Sosmed::all();
        $view->with('sidebarLinks', $sidebarLinks);
    }
}
