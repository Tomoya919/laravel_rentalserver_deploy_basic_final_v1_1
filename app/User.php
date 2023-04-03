<?php
 
namespace App;
 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Follow;
 
class User extends Authenticatable
{
    use Notifiable;
 
 
    protected $fillable = [
        'name', 'email', 'password', 'profile',
    ];
 
    protected $hidden = [
        'password', 'remember_token',
    ];
 
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
 
    //リレーションを設定
    public function posts(){
        return $this->hasMany('App\Post');
    }
    public function isEditable($post){
        return $this->isAdmin() || $this->id === $post->user->id;
    }
    
    public function isAdmin(){
        return $this->admin === 1;
    }
    
    public function scopeRecommend($query, $self_id){
        return $query->where('id', '!=', $self_id)->latest()->limit(3);
    }
    
    public function follows(){
        return $this->hasMany('App\Follow');
    }
 
    public function follow_users(){
      return $this->belongsToMany('App\User', 'follows', 'user_id', 'follow_id');
    }
 
    public function followers(){
      return $this->belongsToMany('App\User', 'follows', 'follow_id', 'user_id');
    }
    
    public function isFollowing($user){
      $result = $this->follow_users->pluck('id')->contains($user->id);
      return $result;
    }
}