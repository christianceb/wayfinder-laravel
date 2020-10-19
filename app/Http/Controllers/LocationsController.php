<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class LocationsController extends Controller
{
	public $types = [
		"Campus",
		"Building",
		"Room"
	];

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// show all items inside Location Table
		return view('locations.index', [
			'locations' => Location::all()
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('locations.create', [
			'types' => $this->types
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
		$location = Location::create($this->validator());

		$location->parent_id = $location->type > 0 ? $request->parent_id : null;
		$location->save();

		return redirect()->route('locations.show', $location);
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
			'location' => $location
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
			'location' => $location,
			'types' => $this->types
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
		$location->update($this->validator());

		// Top level type do not have parents. For some reason, if type is set to 0, it still remembers
		// its old value, what? even the browser request doesnt have this set that Laravel has its own
		// mind!
		$location->parent_id = $location->type > 0 ? request('parent_id') : null;

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
		$location = Location::findOrFail($id);
		$location->delete();

		return redirect(route('locations.index'));
	}

	/**
	 *  Get locations whose type is given
	 */
	public function byType($type)
	{
		$status = Response::HTTP_BAD_REQUEST;
		$content = [];

		// Validate
		$values = ['type' => $type];
		$validator = Validator::make($values, [
			'type' => ['numeric', 'min:0', 'max:2'] // Because 2 is our highest type
		] );

		// Validation successful
		if (!$validator->fails()) {
			$locations = Location::select('name', 'id')
				->where('type', $type)
				->get();

			// Throw 404 if we have nothing
			$status = $locations->isNotEmpty() ? Response::HTTP_OK : Response::HTTP_NOT_FOUND;

			// Pass collections into an array in response
			if ($locations->isNotEmpty()) {
				$content['locations'] = $locations;
			}
		}

		$content['message'] = Response::$statusTexts[$status];

		return response()->json($content, $status);
	}

	public function dump(Request $request)
	{
		return response()->json(Location::all(), Response::HTTP_OK);
	}

	protected function validator()
	{
		return request()->validate([
			'name' => ['required', 'max:50'],
			'type' => 'required',
			'parent_id' => ['nullable', 'exists:App\Location,id'],
			'upload_id' => ['nullable', 'exists:App\Upload,id'],
			'address' => ['nullable', 'max:256'],
			'mp_id' => ['nullable', 'string', 'min:1', 'max:50'],
			'mp_type' => ['nullable', 'size:1'],
			'mp_lat' => ['nullable', 'numeric', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
			'mp_lng' => ['nullable', 'numeric', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/']
		]);
	}
}
