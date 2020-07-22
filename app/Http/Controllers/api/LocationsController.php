<?php


namespace App\Http\Controllers\api;


use App\Location;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use Illuminate\Http\Request;
use App\Support\Collection;


class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locations = Location::all();

        if ($request->has('type')) {
            $locations = $locations->whereIn('type', $request->type);
        }

        if ($request->has('name')) {
            $locations = Location::where('name','like', "%{$request->name}%")->get();
        }

        return response([
            'locations' => LocationResource::collection($locations)->paginate(5),
            'message' => 'Retrieved Successfully',
        ], 200);
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
            'location' => new LocationResource($location),
            'message' => 'Retrieved Successfully',
        ], 200);
    }
}
