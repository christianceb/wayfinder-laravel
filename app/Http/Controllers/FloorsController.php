<?php

namespace App\Http\Controllers;

use App\Floor;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class FloorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('floors.index', [
            "floors" => Floor::latest()->get()
        ]);
    }

	public function create()
	{
		return view('floors.create', [
			'buildings' => Location::where('type', 1)->whereNotNull('mp_lng')->whereNotNull('mp_lat')->latest()->get()
		]);
    }
    
    public function store(Request $request)
    {
        $floor = Floor::create($this->validator());

        return redirect()->route('floors.show', $floor);
    }

    public function show(Floor $floor)
    {
        return view('floors.show', ['floor' => $floor]);
    }

    public function edit(Floor $floor)
    {
        // TODO: I need some implementing!
        abort(404);
    }

    public function byBuilding($location) {
        $status = Response::HTTP_BAD_REQUEST;
		$content = [];

		// Validate
		$values = ['location' => $location];
		$validator = Validator::make($values, [
			'location' => ['exists:App\Location,id']
		]);

		// Validation successful
		if (!$validator->fails()) {
            $floors = Floor::where('location_id', $location)
                ->orderBy('order')
                ->with(['attachment'])
                ->get();

			// Throw 404 if we have nothing
			$status = $floors->isNotEmpty() ? Response::HTTP_OK : Response::HTTP_NOT_FOUND;

			// Pass collections into an array in response
			if ($floors->isNotEmpty()) {
				$content['floors'] = $floors;
			}
		}

		$content['message'] = Response::$statusTexts[$status];

		return response()->json($content, $status);
    }

	public function dump(Request $request)
	{
		return response()->json(Floor::all()->keyBy('id'), Response::HTTP_OK);
	}

    protected function validator()
    {
        return request()->validate([
			'name' => ['required', 'max:50'],
			'order' => ['required', 'integer', 'min:-16', 'max:16'],
			'location_id' => ['required', 'exists:App\Location,id'],
			'upload_id' => ['required', 'exists:App\Upload,id'],
			'ne_lat' => ['required', 'numeric', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
			'ne_lng' => ['required', 'numeric', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
			'sw_lat' => ['required', 'numeric', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
			'sw_lng' => ['required', 'numeric', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/']
		]);
    }
}
