<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Location;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('events.index', ['events' => Event::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create', [
            'locations' => [
                'campus' => Location::where('type', 0)->get(),
                'building' => Location::where('type', 1)->get(),
                'room' => Location::where('type', 2)->get()
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = Event::create($this->validator());

        return redirect()->route('events.show', $event);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', [
            'event' => $event,
            'locations' => [
                'campus' => Location::where('type', 0)->get(),
                'building' => Location::where('type', 1)->get(),
                'room' => Location::where('type', 2)->get()
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Event $event)
    {
        $event->update($this->validator());

        return view('events.show', ['event' => $event]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted');
    }

    protected function validator()
    {
        return request()->validate([
            'title' => ['required', 'max:50'],
            'start' => ['required'],
            'end' => ['required'],
            'location_id' => ['required', 'exists:App\Location,id'],
            'upload_id' => ['nullable', 'exists:App\Upload,id'],
        ]);
    }
}