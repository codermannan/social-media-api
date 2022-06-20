<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Person_post;

class PersonPostController extends Controller
{
   
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
	 
    public function __construct(Person_post $personpost){
		$this->person_post_model = $personpost;
	}
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'person_id' => 'required',
            'post_title' => 'required',
			'post_text' => 'required'
        ]);
		
		if($validator->fails())
			return response()->json((object)$validator->errors()->all(), $status=400, $headers=[], $options=JSON_PRETTY_PRINT);
			
		//dd($request->all());
		$pagepost = $this->person_post_model->save_person_post($request);
		
		if($pagepost==true){
				
				$sddata = array(
					"success"  =>  true,
					"message" => "Your post has been published successfully",
					"data" => []
				);
				return response()->json($sddata, $status=200, $headers=[], $options=JSON_PRETTY_PRINT);

		}else{
				$sddata = array(
					"success"  =>  false,
					"message" => "Your post has not been published successfully",
					"data" => []
				);
				//dd($userdata);
				return response()->json($sddata, $status=404, $headers=[], $options=JSON_PRETTY_PRINT);
				
		}
    }
}
