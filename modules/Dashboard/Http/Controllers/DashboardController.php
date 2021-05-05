<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;


class DashboardController extends Controller{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
    }

    public function index(Request $request){
        Config::set('app.locale', $request->session()->get('locale'));
        return view('Dashboard::index');
    }

    public function errorPage(){
        $error = 'This action is unauthorized.';
        return view('Dashboard::403', compact('error'));
    }

    public function changeLocale(Request $request, $key){
        $request->session()->put('locale',$key);
        return redirect()->back();
    }
}
