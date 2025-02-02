<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Sale;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::all();
        return view('mainview', ['sales' => $sales]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $maxImages = Setting::all()->first()-> maxImages;
        return view('userLayouts.createsale', ['maxImages' => $maxImages, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //We obtain the user ID
        $user = Auth::user()->id;

        //We store the thumbnail path in the attribute $thumbnailPath
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails','local');

        //We set the realThumbnailPath
        $realThumbnailPath = storage_path('app/private') . $thumbnailPath;
        //We create the sale
        $sale = Sale::create([
            'product' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'isSold' => 0,
            'category_id' => $request->category,
            'user_id' => $user,
            'img' => $realThumbnailPath
        ]);

        // Reeding the images that arrives through the request
        foreach ($request->file('imagenes') as $image) {
            $imagePath = $image->store('images','local');
            $realImagePath = storage_path('app/private') . $imagePath;
            //Saving the images using the saveMany method
            $sale->images()->create([
                'ruta' => $realImagePath,
            ]);
        }


        return redirect()->route('sale.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
