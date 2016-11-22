<?php namespace App;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, Notifiable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }
    public function hasRole($name)
    {
        foreach($this->roles as $role)
        {
            error_log($role->name."=".$name);
            if($role->name == $name) return true;
        }

        return false;
    }
    public function assignRole($role)
    {
        return $this->roles()->attach($role);
    }
    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }
    public function homeUrl()
    {
        if ($this->hasRole('user')) {
            $url = route('index');
        } else {
            $url = route('index');
        }
        return $url;
    }
}