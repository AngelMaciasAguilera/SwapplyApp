<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        //First we ensure that the file exists in the local disk
        if(Storage::disk('local')->exists($image->ruta)){
            //If exists we remove it from the local disk
            $result = Storage::disk('local')->delete($image->ruta);
            //Once done we ensure that the remove was done
            if($result){
                //We remove it from the database
                $image -> delete();
                return back() -> with(['message' => 'The image deleted succesfully!']);
            }else{
                //If the image has some trouble removing the path we redirects the user indicating the error
                return back()->withErrors(['message' => 'The image coudnt be deleted'] )->withInput();
            }

        }
    }

    /**
     * Obtains the specific image of the sale
     */
    public function image(Request $request, $id)
    {
        $image = Image::find($id);
        if (file_exists(storage_path('app/private') . '/' . $image->ruta)) {
            return response()
                ->file(storage_path('app/private') . '/' . $image->ruta);
        }
        abort(404);
    }
}
