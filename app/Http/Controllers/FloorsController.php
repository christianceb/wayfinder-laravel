<?php

namespace App\Http\Controllers;

use App\Floor;
use App\Location;
use Illuminate\Http\Request;

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
}
