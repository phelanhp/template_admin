<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Modules\Base\Model\Status;
use Modules\User\Model\User;


class AuthController extends Controller
{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        # parent::__construct();
    }

    /**
     * @param Request $request
     *
     * @return Factory|RedirectResponse|View
     */
    public function getLogin(Request $request)
    {
        if(Auth::check()){
            return redirect()->back();
        }
        return view('Auth::login');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function postLogin(Request $request)
    {

        $login = [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
        ];
        $request->session()->put('email', $request->input('email'));
        if(Auth::guard()->attempt($login, $request->has('remember'))){
            if(Auth::user()->status == Status::STATUS_ACTIVE){
                return redirect()->route('dashboard');
            }
            $request->session()->flash('error', 'Your account is inactive. Please contact with admin page to get more information.');
            return $this->logout();
        }else{
            $request->session()->flash('error', 'Incorrect username or password');
            return redirect()->back();
        }
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function logout()
    {
        if(Auth::check()){
            session('email', Auth::user()->email);
            Auth::logout();
        }
        return redirect()->route('get.login.admin');
    }

    /**
     * @param Request $request
     * @return Application|Factory|RedirectResponse|View
     */
    public function forgotPassword(Request $request)
    {
        if($request->post()){
            $user = User::where('email', $request->email)->first();
            if(!empty($user)){
                if(!empty($request->password)){
                    if(strlen($request->password) < 6){
                        $request->session()->flash('error', 'Password must be at least 6 characters');
                    }else{
                        if(!empty($request->re_enter_password)){
                            if($request->password === $request->re_enter_password){
                                $user->password = $request->password;
                                try{
                                    $user->save();
                                    $user->changePassword($request->password);
                                    $request->session()->flash('success', 'Your password changed successfully.');

                                    return redirect()->route('get.login.admin');
                                }catch(Exception $e){
                                    $request->session()->flash('error', 'Can not get new password.');
                                }
                            }else{
                                $request->session()->flash('error', 'Password not match.');
                            }
                        }else{
                            $request->session()->flash('error', 'Re-enter password.');
                        }
                    }
                }else{
                    $request->session()->flash('error', 'Enter new password.');
                }
            }else{
                $request->session()->flash('error', 'Your email not exist.');
            }

            return back();
        }

        return view('Auth::backend.forgot_password');
    }
}
