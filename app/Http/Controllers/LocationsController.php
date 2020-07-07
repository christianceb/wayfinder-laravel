<?php

namespace App\Http\Controllers;

use App\Locations;
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
		// show all items inside Locations Table
		$allLocations = Locations::all();
		return view('locations.index', [
			'Locations' => $allLocations
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
				'locationsName' => ['required', 'max:50'],
				'locationsType' => 'required',
			]
		);

		$locations = new Locations();
		$locations->name = $request->locationsName;
		$locations->type = $request->locationsType;
		$locations->save();

		return redirect('/locations')->with('success', 'Location created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		// show a specific location by their id
		$locations = Locations::find($id);
        Return view('locations.show', [
            'locations'=>$locations
        ]);
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
		return view('locations.update');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
