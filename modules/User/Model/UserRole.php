<?php

namespace Modules\User\Model;

use Modules\Base\Model\BaseModel;
use Modules\Role\Model\Permission;
use Modules\Role\Model\Role;

class UserRole extends BaseModel{

    protected $table = 'user_role';

    public $timestamps = FALSE;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(){
        return $this->belongsTo(Role::class);
    }
}
