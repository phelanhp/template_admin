<?php

namespace Modules\User\Model;

use App\AppHelpers\Helper;
use App\User as BaseUser;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

/**
 * Class User
 *
 * @package Modules\User\Model
 */
class User extends BaseUser{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public static function filter($filter){
        $query = self::query();
        if(isset($filter['name'])){
            $query->where('name', 'LIKE', '%' . $filter['name'] . '%');
        }

        return $query;
    }

    public function save(array $options = []){
        $insert = Request::all();
        $this->beforeSave($this->attributes, $insert);
        parent::save($options);
        $this->afterSave($insert);
    }

    /**
     *
     */
    public function beforeSave($old_attributes, $insert){
    }

    /**
     * @param $insert
     */
    public function afterSave($insert){
        /** Update user role */
        UserRole::updateUserRole($this, $insert['role_id'] ?? null);
    }

    /**
     * @return HasMany
     */
    public function roles(){
        return $this->hasMany(UserRole::class);
    }

    /**
     * @return null
     */
    public function getRoleAttribute(){
        return $this->roles->first()->role ?? null;
    }
}
