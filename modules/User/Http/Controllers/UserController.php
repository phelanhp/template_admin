<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Modules\Base\Model\Status;
use Modules\Role\Model\Role;
use Modules\User\Http\Requests\UserValidation;
use Modules\User\Model\User;

class UserController extends Controller{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $users = User::paginate(20);
        $statuses = Status::STATUSES;

        return view('User::index', compact('users','statuses'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate(){
        $roles    = Role::getArray();
        $statuses = Status::STATUSES;

        return view('User::create', compact('roles', 'statuses'));
    }

    /**
     * @param \Modules\User\Http\Requests\UserValidation $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(UserValidation $request){
        if (!empty($request->all()) && $request->password === $request->password_re_enter){
            $data = $request->all();
            unset($data['password_re_enter']);
            unset($data['role_id']);
            $user = new User($data);
            if ($user->save()){
                $request->session()->flash('success', 'User created successfully.');
            }
            $request->session()->flash('danger', 'User can not create.');
        }

        return redirect()->route('get.user.list');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUpdate($id){
        $roles    = Role::getArray();
        $user     = User::find($id);
        $statuses = Status::STATUSES;

        return view('User::update', compact('roles', 'user', 'statuses'));
    }

    /**
     * @param \Modules\User\Http\Requests\UserValidation $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUpdate(UserValidation $request, $id){
        $data = $request->all();
        if(empty($data['password'])){
            unset($data['password']);
        }
        unset($data['password_re_enter']);
        $user = User::find($id);
        try{
            $user->update($data);
            $request->session()->flash('success', 'User updated successfully.');
        }catch (\Exception $e){
            $request->session()->flash('danger', 'User cannot update.');
        }

        return redirect()->route('get.user.list');

    }

    public function postUpdateStatus(Request $request){
        $data = $request->all();
        if($data != null){
            $user = User::find($data['id']);
            if($user){
                $user->status = $data['status'];
                try{
                    $user->save();
                    $request->session()->flash('success', 'User updated successfully.');
                }catch (\Exception $e){
                    $request->session()->flash('danger', 'User cannot update.');
                }
            }
        }
        return TRUE;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProfile(){
        $id    = Auth::guard()->id();
        $roles = Role::getArray();
        $user  = User::find($id);
        $statuses = Status::STATUSES;

        return view('User::update', compact('roles', 'user', 'statuses'));
    }

    /**
     * @param \Modules\User\Http\Requests\UserValidation $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postProfile(UserValidation $request){
        $id   = Auth::guard()->id();
        $data = $request->all();
        if (empty($data['password'])){
            unset($data['password']);
        }
        $user = User::find($id);
        $user->update($data);
        $request->session()->flash('success', 'User updated successfully.');

        return redirect()->route('dashboard');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id){
        $user = User::find($id);
        $user->delete();
        $request->session()->flash('success', 'User deleted successfully.');

        return back();
    }
}
