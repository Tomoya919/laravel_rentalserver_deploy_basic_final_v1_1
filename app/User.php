<?php
 
namespace App;
 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
 
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
}