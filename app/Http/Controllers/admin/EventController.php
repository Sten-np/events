<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventStoreRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Models\Event;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:index events', ['only' => ['index']]);
        $this->middleware('permission:show events', ['only' => ['show']]);
        $this->middleware('permission:create events', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit events', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete events', ['only' => ['delete', 'destroy']]);
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $events = Event::paginate(12);
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
     * @return RedirectResponse
     */
    public function store(EventStoreRequest $request): RedirectResponse
    {
        $event = new Event();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->time = $request->time;
        $event->location = $request->location;
        $event->price = $request->price;
        $event->save();
        return to_route('events.index')->with('status', 'Event created successfully');
    }

    /**
     * @param Event $event
     * @return View
     */
    public function show(Event $event): View
    {
        return view('admin.events.show', compact('event'));
    }

    /**
     * @param Event $event
     * @return View
     */
    public function edit(Event $event): View
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * @param EventUpdateRequest $request
     * @param Event $event
     * @return RedirectResponse
     */
    public function update(EventUpdateRequest $request, Event $event): RedirectResponse
    {
        $event->name = $request->name;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->time = $request->time;
        $event->location = $request->location;
        $event->price = $request->price;
        $event->save();

        return to_route('events.index')->with('status', 'Event updated successfully');
    }

    /**
     * @param Event $event
     * @return View
     */
    public function delete(Event $event): View
    {
        return view('admin.events.delete', ['event' => $event]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return to_route('events.index')->with('status', 'Event deleted successfully');
    }
}
