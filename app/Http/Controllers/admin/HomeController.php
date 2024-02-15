<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomeStoreRequest;
use App\Http\Requests\HomeUpdateRequest;
use App\Models\Home;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends Controller

{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:index homes', ['only' => ['index']]);
        $this->middleware('permission:show homes', ['only' => ['show']]);
        $this->middleware('permission:create homes', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit homes', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete homes', ['only' => ['delete', 'destroy']]);
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $homes = Home::paginate(12);
        return View('admin.homes.index', compact('homes'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.homes.create');
    }

    /**
     * @param homeStoreRequest $request
     * @return RedirectResponse
     */
    public function store(HomeStoreRequest $request): RedirectResponse
    {
        $home = new Home();
        $home->name = $request->name;
        $home->description = $request->description;
        $home->date = $request->date;
        $home->time = $request->time;
        $home->location = $request->location;
        $home->save();
        return to_route('homes.index')->with('status', 'Event created successfully');
    }

    /**
     * @param Home $home
     * @return View
     */
    public function show(Home $home): View
    {
        return view('admin.homes.show', compact('home'));
    }

    /**
     * @param Home $home
     * @return View
     */
    public function edit(home $home): View
    {
        return view('admin.homes.edit', compact('home'));
    }

    /**
     * @param HomeUpdateRequest $request
     * @param Home $home
     * @return RedirectResponse
     */
    public function update(HomeUpdateRequest $request, Home $home): RedirectResponse
    {
        $home->name = $request->name;
        $home->description = $request->description;
        $home->date = $request->date;
        $home->time = $request->time;
        $home->location = $request->location;
        $home->save();

        return to_route('homes.index')->with('status', 'Event updated successfully');
    }

    /**
     * @param Home $home
     * @return View
     */
    public function delete(Home $home): View
    {
        return view('admin.homes.delete', ['homes' => $home]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Home $home)
    {
        $home->delete();
        return to_route('events.index')->with('status', 'Event deleted successfully');
    }
}
