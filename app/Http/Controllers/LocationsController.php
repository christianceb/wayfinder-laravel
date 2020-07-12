<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// show all items inside Location Table
		return view('locations.index', [
			'Locations' => Location::all()
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
		return view('locations.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		// validate the input for subject and description
		request()->validate(
			[
				'name' => ['required', 'max:50'],
				'type' => 'required',
			]
		);
		$locations = new Location();
		$locations->name = $request->name;
		$locations->type = $request->type;
		$locations->parent_id = $request->parent;
		$locations->save();

		return redirect(route('locations.index'))->with('success', 'Location created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Location $location)
	{
		// show a specific location by their id
		return view('locations.show', [
			'locations' => $location
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Location $location)
	{
		return view('locations.update', [
			'locations' => $location
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Location $location)
	{
		// update
		request()->validate(
			[
				'name' => ['required', 'max:50'],
				'type' => 'required',
			]
		);
        $location->fill(request(['name']));
        $location->fill(request(['type']));
        $location->fill(request(['parent_id']));
		$location->save();

		return redirect(route('locations.show', $location))->with('success', 'Location updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		// delete a particular location by their id's
		$locations = Location::findOrFail($id);
		$locations->delete();
		return redirect(route('locations.index'));
	}

	/**
     *  find the type of the parent
     *
     */
	public static function findTypeParent(Request $request)
    {
        // get all the data of locations table where its id equals to id-1
        $data = Location::select('name', 'id')->where('type',
            $request->id-1)->take(100)->get();
        return response()->json($data);
    }
}
