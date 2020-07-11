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
		return view('locations.index', [
			'Locations' => Locations::all()
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
		$locations->parent_id = $request->locationsParent;
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

		return view('locations.show', [
			'locations' => $locations
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
		$locations = Locations::find($id);

		return view('locations.update', [
			'locations' => $locations
		]);
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
		// update
		request()->validate(
			[
				'locationsName' => ['required', 'max:50'],
				'locationsType' => 'required',
			]
		);
		$locations = Locations::find($id);

		$locations->name = request('locationsName');
		$locations->type = request('locationsType');
		$locations->parent_id = request('locationsParent');
		$locations->save();

		return redirect('/locations/' . $id)->with('success', 'Location updated successfully.');
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
		$locations = Locations::findOrFail($id);
		$locations->delete();
		return redirect('/locations');
	}

	/**
     *  find the type of the parent
     *
     */
	public static function findTypeParent(Request $request)
    {
        // get all the data of locations table where its id equals to id-1
        $data = Locations::select('name', 'id')->where('type',
            $request->id-1)->take(100)->get();
        return response()->json($data);
    }
}
