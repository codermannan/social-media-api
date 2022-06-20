<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_followers;
use Illuminate\Support\Facades\Validator;

class UserFollowersController extends Controller
{
   public function __construct(User_followers $user_followers)
    {
        $this->user_followers_model = $user_followers;
    }
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function create(Request $request)
    {	
        $validator = Validator::make($request->all(),[
            //'user_id' => 'required',
            'follower_id' => 'required'
        ]);
		//dd($request->personId);
		if($validator->fails())
			return response()->json((object)$validator->errors()->all(), $status=400, $headers=[], $options=JSON_PRETTY_PRINT);
			
		
		$page = $this->user_followers_model->save_user_followers($request);
		
		if($page==true){
				
				$sddata = array(
					"success"  =>  true,
					"message" => "The Page has been followed successfully",
					"data" => []
				);
				return response()->json($sddata, $status=200, $headers=[], $options=JSON_PRETTY_PRINT);

		}else{
				$sddata = array(
					"success"  =>  false,
					"message" => "The Page has not been followed successfully",
					"data" => []
				);
				//dd($userdata);
				return response()->json($sddata, $status=404, $headers=[], $options=JSON_PRETTY_PRINT);
				
		}
    }
}
