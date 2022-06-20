<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_followers extends Model
{
    use HasFactory;
	
	protected $fillable = [
        'user_id',
        'follower_id'
    ];
	
	public function save_user_followers($request){
		//dd($request->follower_id);
		$this->user_id = $request->personId;
		$this->follower_id  = $request->follower_id;
		
		if($this->save()){
			return true;
		}else{
			return false;
		}
	}
}
