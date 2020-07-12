<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\events;

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
        return view('events.Event_index', ['events' => events::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('events.Event_create');
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

        $this->createEvent($request->all());

        return redirect()->route('events.index')
            ->with('success', 'Event created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(events $events)
    {
        //
        return view('events.Event_show', ['events' => $events]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(events $events)
    {
        //
        return view('events.Event_edit', ['events' => $events]);
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
        //
        $this->validator(request()->all())->validate();
    
        $events->fill(request(["title"]));
        $events->description = request('description');
        $events->start = request('start');
        $events->end = request('end');
        $events->location = request('location');
        $events->save();

        return redirect()->route('events.index')
            ->with('success', 'Event updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $events = events::whereId($id);
        $events->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event deleted');
    }

    protected function validator(array $data)
    {
        $rules = [
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:255',],
            'start' => ['required', 'date_format:"Y-m-d\TH:i"'],
            'end' => ['required', 'date_format:"Y-m-d\TH:i"'],
        ];

        switch(request()->getMethod()){
            case "POST":
                $rules['location'] = ['required', 'string', 'max:50'];
                break;

            default:
                break;
        }

        return Validator::make($data, $rules);
    }

    protected function createEvent(array $data)
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



