<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Base\Model\Status;


class AuthController extends Controller{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getLogin(Request $request){
        if(Auth::check()){
            return redirect()->back();
        }
        return view('Auth::login');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request){

        $login = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        $request->session()->put('email', $request->input('email'));
        if (Auth::guard()->attempt($login , $request->has('remember'))) {
            if(Auth::user()->status == Status::STATUS_ACTIVE){
                return redirect()->route('dashboard');
            }
            $request->session()->flash('error','Your account is inactive. Please contact with admin page to get more information.');
            return $this->logout();
        }else{
            $request->session()->flash('error','Incorrect username or password');
            return redirect()->back();
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(){
        if(Auth::check()){
            session('email', Auth::user()->email);
            Auth::logout();
        }
        return redirect()->route('get.login.admin');
    }
}
