<?php

namespace App;

use App\Common\Support\PermissionPoliciesTrait;
use App\Common\Support\PermissionsTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable,HasRoles, PermissionPoliciesTrait, PermissionsTrait;

    public $preventAttrSet = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','department_id','calendar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'calendar'=>'array'
    ];

    public function getFirstRoleAttribute()
    {
        return !empty($this->roles[0]) ? $this->roles[0] : (new Role());
    }

    public function setPasswordAttribute($password)
    {
        if($password) {
            $this->attributes['password'] = $this->preventAttrSet?$password:bcrypt($password);
        }
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
