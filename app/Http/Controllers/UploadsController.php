<?php

namespace App\Http\Controllers;

use App\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class UploadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('uploads.index', [
            "uploads" => Upload::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uploads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = Response::HTTP_BAD_REQUEST;
        $content = [];

        $file = request("file");

        $toValidate = [
            "file" => $file,
            "title" => basename($file->getClientOriginalName(), ".".$file->getClientOriginalExtension()),
            "mime_type" => $file->getClientMimeType(),
            "size" => $file->getSize()
        ];

        // title length is maxed to 225 so that in URI, there is enough length when extension and path is compounded
        $validator = Validator::make($toValidate, [
            'file' => ['required', 'image', 'max:10000'],
            'title' => ['required', 'max:225', 'alpha_dash'],
            'mime_type' => ['required'],
            'size' => ['required']
        ]);

        if ($validator->fails()) {
            $content['errors'] = $validator->errors();
        }
        else
        {
            $path = "uploads/" . date("Y") . "/" . date("m");
            // Run uploads routine
            // Save validated file and its URI
            if (config("filesystems.default") == "s3")
            {
                $toValidate['uri'] = $toValidate['file']->storePublicly($path);
                $toValidate['remote_url'] = Storage::disk('s3')->url($toValidate['uri']);
            }
            else
            {
                $toValidate['uri'] = $toValidate['file']->store($path, "public");
            }
            
            $upload = Upload::create($toValidate);

            // Run necessary routine to show a meaningful JSON response
            $content['upload'] = $upload;
            $status = Response::HTTP_OK;
        }

        $content['message'] = Response::$statusTexts[$status];

        return response()->json(['upload' => $upload], $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Upload $upload)
    {
        return view('uploads.show', [
            'upload' => $upload,
        ]);
    }

    public function byId(Upload $upload)
    {
        $status = Response::HTTP_OK;

        return response()->json([
            "upload" => $upload,
            "message" => Response::$statusTexts[$status]
        ], $status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Upload $upload)
    {
        return view('uploads.edit', [
            'upload' => $upload
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Upload $upload)
    {
        request()->validate([
            'title' => 'required'
        ]);

        $upload->fill(request(['title']));
        $upload->save();

        return redirect(route('uploads.show', $upload));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Upload $upload)
    {
        Storage::delete($upload->uri);
        $upload->delete();

        return redirect(route('uploads.index'));
    }
}
