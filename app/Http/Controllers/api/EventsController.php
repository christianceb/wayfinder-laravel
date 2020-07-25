<?php

namespace App\Http\Controllers\api;

use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventsController extends Controller
{
    private $showProps = ['attachment', 'location'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = Response::HTTP_BAD_REQUEST;
        $content = [];

        // Clamp per_page to 1-20 items
        $paginate = $request->has('per_page') ? max(1, min(20, $request->per_page)) : 5;

        $events = Event::with($this->showProps);

        if ($request->has('title')) {
            $events->where('title','like', "%{$request->title}%");
        }

        if ($request->has('after')) {
            $events->where([
                ['start', '>=', $request->after],
                ['end', '<=', $request->after]
            ])
            ->orWhere('end', '>=', $request->after)
            ->orderBy('start', 'asc');
        }

        if ($request->has('before')) {
            $events->where([
                ['start', '<=', $request->before],
                ['end', '>=', $request->before]
            ])
            ->orWhere('start', '<=', $request->before)
            ->orderBy('start', 'desc');
        }

        $events = $events->get();
        $status = Response::HTTP_NOT_FOUND;

        if ($events->isNotEmpty()) {
            $content['result'] = EventResource::collection($events)->paginate($paginate);
            $status = Response::HTTP_OK;
        }

        $content['message'] = Response::$statusTexts[$status];

        return response($content, $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return response([
            'result' => new EventResource($event->load($this->showProps)),
            'message' => Response::$statusTexts[Response::HTTP_OK],
        ], Response::HTTP_OK);
    }
}
