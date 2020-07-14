<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //      
        return view('events.index', ['events' => Events::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validator($request->all())->validate();
        $events = $this->createEvents($request->all());

        return redirect(route("events.index", $events));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $events = Events::find($id);
        return view('events.show', ['events' => $events]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $events = events::find($id);
        return view('events.edit', ['events' => $events]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(events $events)
    {
    
        $this->validator(request()->all())->validate();

        $events->fill(request(['title']));
        $events->description = (request('description'));
        $events->start = (request('start'));
        $events->end = (request('end'));
        $events->location = (request('location'));

        $events->save();

        return redirect(route("events.show", $events));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $events = Events::whereId($id);
        $events->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event deleted');
    }
    protected function validator(array $data)
    {
        $rules = [
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:250'],
            'start' => [ 'required'],
            'end' => [ 'required'],
        ];

        switch (request()->getMethod()) {
            case "POST":
                $rules['location'] = ['required', 'string', 'max:50'];
                break;
        }

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration. This is exactly the same create()
     * method found in \App\Http\Controllers\Auth\RegisterController
     *
     * @param  array  $data
     * @return \App\Events
     */
    protected function createEvents(array $data)
    {
        return events::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'start' => $data['start'],
            'end' => $data['end'],
            'location' => $data['location']
        ]);
    }
}


