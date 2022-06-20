<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
		'email',
        'password'
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
	
	public function save_user($request){
		
		$this->first_name = $request->first_name;
		$this->last_name  = $request->last_name;
		$this->email 	  = $request->email;
		$this->password   = bcrypt($request->password);
		
		if($this->save()){
			$data = [
			    'user_id' => $this->id,
				'first_name'=>$request->first_name,
				'last_name'=>$request->last_name,
				'email'=>$request->email
			];
			return $data;
		}else{
			return array();
		}
	}
}
