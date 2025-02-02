<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $url = '/';
        if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin'){
            $url = 'users';
        }elseif(Auth::user()->role=='user'){
            $url = 'usersHome';
        }
        return redirect(url($url));
    }

    public function userHome(){
        $user = Auth::user();
        $userSales = Sale::where('user_id', $user->id)->paginate(10);
        return view('home', ['user' => $user]);
    }
}
