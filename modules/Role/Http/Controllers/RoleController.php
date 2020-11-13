<?php

namespace Modules\Role\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Base\Model\Status;
use Modules\Role\Http\Requests\RoleValidation;
use Modules\Role\Model\Permission;
use Modules\Role\Model\Role;

class RoleController extends Controller{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
    }

    public function index(Request $request){
        $filter = $request->all();
        $roles  = Role::filter($filter)->paginate(20);

        return view('Role::index', compact('roles', 'filter'));
    }

    public function getCreate(){
        $statuses = Status::STATUSES;

        return $this->renderAjax('Role::form', compact('statuses'));
    }

    public function postCreate(RoleValidation $request){
        $role    = new Role($request->all());
        if ($role->save()){
            $request->session()->flash('success', 'Role updated successfully.');
        }

        return back();
    }

    public function getUpdate($id){
        $role     = Role::find($id);
        $statuses = Status::STATUSES;

        return $this->renderAjax('Role::form', compact('role', 'statuses'));
    }

    public function postUpdate(RoleValidation $request, $id){
        $role = Role::find($id);
        if ($role->update($request->all())){
            $request->session()->flash('success', 'Role updated successfully.');
        }

        return redirect()->back();
    }

    public function delete(Request $request, $id){
        $role = Role::find($id);
        if ($role->checkUserHasRole()){
            $role->delete();
            $request->session()->flash('success', 'Role deleted successfully.');
        }else{
            $request->session()
                    ->flash('error', 'Role cannot delete because has user belongs this role');
        }

        return back();
    }
}
