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
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::where('isSold', '!=', 1)->orderBy('created_at','desc')->paginate(10);
        if(Auth::user() != null && (Auth::user()->role == 'admin' || Auth::user() -> role == 'superadmin')){
            return view('adminLayouts.adminSaleLayouts.index', ['sales' => $sales]);
        }else{
            return view('mainview', ['sales' => $sales]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $maxImages = Setting::all()->first()->maxImages;
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
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'local');

        //We create the sale
        $sale = Sale::create([
            'product' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'isSold' => 0,
            'category_id' => $request->category,
            'user_id' => $user,
            'img' => $thumbnailPath
        ]);

        // Reeding the images that arrives through the request
        foreach ($request->file('imagenes') as $image) {
            $imagePath = $image->store('images', 'local');
            //Saving the images using the saveMany method
            $sale->images()->create([
                'ruta' => $imagePath,
            ]);
        }

        return redirect()->route('sale.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $user = Auth::user();
        $relatedSales = Sale::where('category_id', $sale->category_id) ->where('id', '!=', $sale->id) ->where('isSold', '!=', 1) ->orderBy('created_at', 'desc') ->take(3)->get();
        return view('userLayouts.showsale', ['sale'=> $sale, 'relatedSales' => $relatedSales, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        $categories = Category::all();
        $maxImages = Setting::all()->first()->maxImages;
        return view('userLayouts.editsale', ['sale' => $sale, 'maxImages' => $maxImages, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $validator = Validator::make($request->all(), [
            'thumbnail' => '|file|max:2048', // 2MB = 2048KB
        ]);

        if ($validator->passes()) {
            //We ensures that it comes a thumbnail through the request
            if ($request->hasFile('thumbnail')) {
                if ($sale->img != null) {
                    //First we remove the old thumbnail if it has one from the local disk
                    if (Storage::disk('local')->exists($sale->img)) {
                        //If exists we remove it from the local disk
                        $result = Storage::disk('local')->delete($sale->img);
                        //Once done we ensure that the remove was done
                        if ($result) {
                            //We store the thumbnail path in the attribute $thumbnailPath
                            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'local');
                            $sale ->img = $thumbnailPath;
                        }
                    }
                }
            }

            $sale -> product = $request->name;
            $sale -> description = $request->description;
            $sale -> price = $request->price;
            $sale -> product = $request->name;
            $sale -> category_id = $request->category;

            if ($request->hasFile('imagenes') && is_array($request->file('imagenes'))) {
                // Reading the images that arrives through the request
                foreach ($request->file('imagenes') as $image) {
                    $imagePath = $image->store('images', 'local');
                    //Saving the images using the saveMany method
                    $sale->images()->create([
                        'ruta' => $imagePath,
                    ]);
                }
            }
            $sale -> save();
            return redirect()->route('sale.index');
        } else {
            return back()->withErrors(['message' => $validator->errors()->first() . ' ensures that the file doesnt have more than 2 mb of size'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('usersHome');

    }

    public function thumbnail(Request $request, $id)
    {
        $thumbnailPath = Sale::find($id)->img;
        if (file_exists(storage_path('app/private') . '/' . $thumbnailPath)) {
            return response()
                ->file(storage_path('app/private') . '/' . $thumbnailPath);
        }
        abort(404);
    }

    public function buySale($id)
    {
        $sale = Sale::where('id',$id)->first();
        $sale->isSold = 1;
        $sale -> save();
        return redirect()->route('sale.index')->with(['message' => 'Thank you for the purchase!']);
    }
}
