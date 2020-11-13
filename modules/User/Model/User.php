<?php

namespace Modules\User\Model;

use App\User as BaseUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

/**
 * Class User
 *
 * @package Modules\User\Model
 */
class User extends BaseUser{

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function save(array $options = []){
        $insert = Request::all();
        parent::save($options);
        $this->afterSave($insert);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles(){
        return $this->hasMany(UserRole::class);
    }

    /**
     * @return mixed belongsTo Role
     * Use like this: $this->role
     */
    public function getRoleAttribute(){
        return $this->roles->first()->role;
    }

    /**
     * @param $role_id
     *
     * @return mixed
     */
    public function afterSave($insert){

        $query = UserRole::where('user_id', $this->id);

        if (isset($insert['role_id']) && $insert['role_id'] != $this->role->id){
            if ($query->count() > 0){
                UserRole::where('user_id', $this->id)->update(['role_id' => $insert['role_id']]);
            }else{
                $user_role          = new UserRole();
                $user_role->user_id = $this->id;
                $user_role->role_id = $insert['role_id'];
                $user_role->save();
            }
        }
        return TRUE;

    }
}
