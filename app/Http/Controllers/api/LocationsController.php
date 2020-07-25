<?php

namespace App\Http\Controllers\api;

use App\Location;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class LocationsController extends Controller
{
    private $showProps = ['attachment', 'parent'];

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

        $locations = Location::with($this->showProps);

        if ($request->has('type')) {
            $locations->where('type', $request->type);
        }

        if ($request->has('name')) {
            $locations->where('name','like', "%{$request->name}%");
        }

        $locations = $locations->get();
        $status = Response::HTTP_NOT_FOUND;

        if ($locations->isNotEmpty()) {
            $content['result'] = LocationResource::collection($locations)->paginate($paginate);
            $status = Response::HTTP_OK;
        }

        $content['message'] = Response::$statusTexts[$status];

        return response($content, $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        return response([
            'result' => new LocationResource($location->load($this->showProps)),
            'message' => Response::$statusTexts[Response::HTTP_OK],
        ], Response::HTTP_OK);
    }
}
