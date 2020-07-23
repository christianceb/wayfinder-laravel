<?php


namespace App\Http\Controllers\api;


use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $events = Event::all();

        if ($request->has('location')) {
            $events = $events->whereIn('location_id', $request->location_id);
        }

        if ($request->has('title')) {
            $events = Event::where('title','like', "%{$request->title}%")->get();
        }

        if ($request->has('after')) {
            $events = Event::where('start', '>', $request->start)
                            ->orderBy('start', 'desc')->get();
        }

        return response([
            'locations' => EventResource::collection($events)->paginate(5),
            'message' => 'Retrieved Successfully',
        ], 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Location $location
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return response([
            'location' => new EventResource($event),
            'message' => 'Retrieved Successfully',
        ], 200);
    }
}
