<?php

namespace Modules\Role\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Model\BaseModel;
use Modules\User\Model\UserRole;

class Role extends BaseModel{

    use SoftDeletes;

    protected $table = 'roles';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public $timestamps = TRUE;

    const ADMINISTRATOR = 'Administrator';

    public static function filter($filter){
        $query = self::query();
        if (isset($filter['name'])){
            $query->where('name', 'LIKE', '%' . $filter['name'] . '%');
        }

        return $query;
    }

    public static function getName($id){
        $data = self::find($id);

        return $data->name;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(){
        return $this->hasMany(UserRole::class);
    }

    /**
     * @return bool
     */
    public function checkUserHasRole(){
        if(empty($this->users->first()->user)){
            return TRUE;
        }
        return FALSE;
    }

    /**
     * @return mixed
     */
    public static function getAdminRole(){
        return self::where('name', self::ADMINISTRATOR)->first();
    }
}
