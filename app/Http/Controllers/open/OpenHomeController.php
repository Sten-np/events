<?php

namespace App\Http\Controllers\open;

use App\Models\Home;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class OpenHomeController extends Controller
{

    /**
     * @return View
     */
    public function index(): View
    {
        $homes = Home::paginate(12);
        return view('open.homes.index', compact('homes'));
    }


    /**
     * @param Home $home
     * @return View
     */
    public function show(Home $home): View
    {
        return view('open.homes.show', compact('home'));
    }
}
