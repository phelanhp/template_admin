<?php

namespace Modules\User\Model;

use App\User as BaseUser;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;
use Modules\Role\Model\Role;

/**
 * Class User
 *
 * @package Modules\User\Model
 */
class User extends BaseUser
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function save(array $options = [])
    {
        $insert = Request::all();
        $this->beforeSave($this->attributes, $insert);
        parent::save($options);
        $this->afterSave($insert);
    }

    public static function filter($filter){
        $query = self::query();
        if (isset($filter['name'])){
            $query->where('name', 'LIKE', '%' . $filter['name'] . '%');
        }

        return $query;
    }

    /**
     * @return HasMany
     */
    public function roles()
    {
        return $this->hasMany(UserRole::class);
    }

    /**
     * @return mixed belongsTo Role
     * Use like this: $this->role
     */
    public function getRoleAttribute()
    {
        return $this->roles->first()->role;
    }

    /**
     * @param $insert
     * @return bool
     */
    public function afterSave($insert)
    {
        if (isset($insert['role_id'])) {
            $role_id = (int)$insert['role_id'];
            if (!empty($role_id)) {
                if (isset($this->role->id)) {
                    UserRole::where('user_id', (int)$this->id)->update(['role_id' => $role_id]);
                } else {
                    $user_role = new UserRole();
                    $user_role->user_id = $this->id;
                    $user_role->role_id = $role_id;
                    $user_role->save();
                }
            }
        }

        return TRUE;
    }

    /**
     *
     */
    public function beforeSave($old_attributes, $insert){
    }

    public function afterChangePassword($insert)
    {

    }
}
