<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
	
	protected $fillable = [
        'page_name',
        'page_author'
    ];
	
	public function save_page($request){
		
		$this->page_name = $request->page_name;
		$this->page_author  = $request->page_author;
		
		if($this->save()){
			return true;
		}else{
			return false;
		}
	}
}
