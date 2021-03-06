<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function TotalUsersCount(){
        $total = DB::table('users')->count();
        return $total;
    }
    public static function today_users_count(){
        $today = Carbon::now()->format('Y-m-d');
        $from = $today.' 00:00:00';
        $to = $today.' 23:59:59';
        $total = DB::select("SELECT Count(id) as user_today_count FROM `users` WHERE created_at BETWEEN '$from' AND '$to'");
        foreach ($total as $t){
            $total = $t->user_today_count;
        }
        if($total==null) $total = 0;
        return $total;
    }
}
