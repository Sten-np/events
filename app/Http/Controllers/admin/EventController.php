<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventStoreRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EventController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $events = Event::all();
        return View('admin.events.index', compact('events'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.events.create');
    }

    /**
     * @param EventStoreRequest $request
     */
    public function store(EventStoreRequest $request)
    {
        $event = new Event();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->location = $request->location;
        $event->save();
        return to_route('admin.events.index')->with('status'. 'Event created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
