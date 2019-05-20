<?php

namespace App;

use App\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);
        return true;
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                 return true; 
            }   
        }
        return false;
    }
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function whatRole($user_id)
    {
        $rolename= Role::select('description')
                        ->join('role_user','role_user.role_id','roles.id')                        
                        ->where('role_user.user_id',$user_id)
                        ->first();        
        return $rolename->description;
    }

    public function whatModule($user_id)
    {
        $moduleauth= Role::select('module.id','module_option.id','module_description','icon_module','module_option_description','icon_module_option','route','correlative')
                        ->join('role_user','role_user.role_id','roles.id')                        
                        ->join('authorization','authorization.role_id','role_user.role_id')                        
                        ->join('module_option','module_option.id','authorization.module_option_id')
                        ->join('module','module.id','module_option.module_id')                        
                        ->where('role_user.user_id',$user_id)                        
                        ->get();        

        return $moduleauth;
    }

    public function sinceUser($user_id)
    {
        $since= Role::select('role_user.created_at')
                        ->join('role_user','role_user.role_id','roles.id')                        
                        ->where('role_user.user_id',$user_id)
                        ->first();        
        return $since->created_at;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status'
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
    ];
}
