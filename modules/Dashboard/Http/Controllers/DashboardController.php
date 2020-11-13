<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


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
        return view('Dashboard::index');
    }

    public function errorPage(){
        $error = 'This action is unauthorized.';
        return view('Dashboard::403', compact('error'));
    }
}
