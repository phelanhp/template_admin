<?php

namespace Modules\User\Model;

use App\Http\Mail\SendMail;
use App\User as BaseUser;
use Exception;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

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

    public static function filter($filter)
    {
        $query = self::query();
        if(isset($filter['name'])){
            $query->where('name', 'LIKE', '%' . $filter['name'] . '%');
        }

        return $query;
    }

    public function save(array $options = [])
    {
        $insert = Request::all();
        $this->beforeSave($this->attributes, $insert);
        parent::save($options);
        $this->afterSave($insert);
    }

    /**
     *
     */
    public function beforeSave($old_attributes, $insert)
    {
    }

    /**
     * @param $insert
     * @return bool
     */
    public function afterSave($insert)
    {
        if(isset($insert['role_id'])){
            $role_id = (int)$insert['role_id'];
            if(!empty($role_id)){
                if(isset($this->role->id)){
                    UserRole::where('user_id', (int)$this->id)->update(['role_id' => $role_id]);
                }else{
                    $user_role          = new UserRole();
                    $user_role->user_id = $this->id;
                    $user_role->role_id = $role_id;
                    $user_role->save();
                }
            }
        }

        return TRUE;
    }

    /**
     * Send mail after change password
     */
    public function changePassword($password)
    {
        $detail = [
            'subject' => 'Change Your Password',
            'title'   => 'Change Your Password',
            'body'    => "<div><p>We noticed that you have changed your password recently</p></div>
                            <div><p>Your password has been changed to: <h3>$password</h3></p></div>
                            <div><p style=\"color:red\">Please contact with us if it is not you.</a></div>",
        ];

        /** Send email */
        $mail = new SendMail();
        $mail->to($this->email)
            ->subject($detail['subject'])
            ->title($detail['title'])
            ->body($detail['body'])
            ->view('User::mail.mail_change_password');

        try{
            Mail::send($mail);
        }catch(Exception $e){
            Session::flash('danger', 'Can not send email. Please check your Email config.');
        }
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
}
