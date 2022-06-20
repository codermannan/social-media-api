<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Page_post;

class PagePostController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
	 
    public function __construct(Page_post $pagepost){
		$this->page_post_model = $pagepost;
	}
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	public function create(Request $request)
    {	
        $validator = Validator::make($request->all(),[
            //'page_id' => 'required',
            'post_by' => 'required',
			'post_title' => 'required',
			'post_text' => 'required'
        ]);
		
		if($validator->fails())
			return response()->json((object)$validator->errors()->all(), $status=400, $headers=[], $options=JSON_PRETTY_PRINT);
			
		//dd($request->all());
		$page = $this->page_post_model->save_page_post($request);
		
		if($page==true){
				
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
