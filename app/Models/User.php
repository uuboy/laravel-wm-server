<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use Auth;

class User extends Authenticatable implements MustVerifyEmailContract, JWTSubject
{
    use MustVerifyEmailTrait;
    use HasRoles;

    use Notifiable {
        notify as protected laravelNotify;
    }

    public function notify($instance)
    {

        // 只有数据库类型通知才需提醒，直接发送 Email 或者其他的都 Pass
        if (method_exists($instance, 'toDatabase')) {
                // 如果要通知的人是当前用户，就不必通知了！
            if ($this->id == Auth::id()) {
                return;
            }
            $this->increment('notification_count');
        }

        $this->laravelNotify($instance);
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','weixin_session_key', 'weapp_openid','avatar','phone',
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($value)
    {
        // 如果值的长度等于 60，即认为是已经做过加密的情况
        if (strlen($value) != 60) {

            // 不等于 60，做密码加密处理
            $value = bcrypt($value);
        }

        $this->attributes['password'] = $value;
    }

    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }

    public function isParterOf($model)
    {
       return DB::table('parters')->where([
            ['repository_id', '=', $model->id],
            ['user_id', '=', $this->id],
        ])->exists();
    }

    public function parterRepositories()
    {

        return $this->BelongsToMany(Repository::class,'parters');
    }


    public function repositories()
    {

        return $this->hasMany(Repository::class);

    }


    public function receiverInventories()
    {
        return $this->hasMany(Inventory::class,'receiver_id');
    }

    public function ownerInventories()
    {
        return $this->hasMany(Inventory::class,'owner_id');
    }

    public function UpdateRepositories()
    {
        return $this->hasMany(Repository::class,'last_updater_id');
    }

    public function UpdateGoods()
    {
        return $this->hasMany(Good::class,'last_updater_id');
    }

    public function UpdateInventories()
    {
        return $this->hasMany(Good::class,'last_updater_id');
    }

    public function UpdateBills()
    {
        return $this->hasMany(Bill::class,'last_updater_id');
    }

    public function scopeRecentUpdated($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }
    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }
}
