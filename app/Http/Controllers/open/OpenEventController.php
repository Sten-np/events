<?php

namespace App\Http\Controllers\open;

use App\Models\Event;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class OpenEventController extends Controller
{

    /**
     * @return View
     */
    public function index(): View
    {
        $events = Event::paginate(12);
        return view('open.events.index', compact('events'));
    }


    /**
     * @param Event $event
     * @return View
     */
    public function show(Event $event): View
    {
        return view('open.events.show', compact('event'));
    }
}
