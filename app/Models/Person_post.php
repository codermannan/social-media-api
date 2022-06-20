<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Person_post extends Model
{
   use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'person_id',
        'post_title',
		'post_text',
        'post_image'
    ];

   
	public function save_person_post($request){
		
		$this->person_id  = $request->person_id;
		$this->post_title = $request->post_title;
		$this->post_text  = $request->post_text;
		$this->post_image = $request->post_image;
		
		if($this->save()){
			return true;
		}else{
			return false;
		}
	}
	
	
}
