<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
//use Validator;

class AuthController extends Controller
{
    
	public function __construct(User $user){
		$this->user_model = $user;
	}

	public function register(Request $request){
		
		$validator = Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
			'email' => 'required|email|unique:users,email',
			'password' => 'required'
        ]);
		
		if($validator->fails())
			return response()->json((object)$validator->errors()->all(), $status=400, $headers=[], $options=JSON_PRETTY_PRINT);
			
		//dd($request->all());
		$userdata = $this->user_model->save_user($request);
		
		if(count($userdata)>0){
				
				$sddata = array(
					"success"  =>  true,
					"message" => "Registration has been done successfully",
					"data" => $userdata
				);
				return response()->json($sddata, $status=200, $headers=[], $options=JSON_PRETTY_PRINT);

		}else{
				$sddata = array(
					"success"  =>  false,
					"message" => "Registration has not been done successfully",
					"data" => []
				);
				//dd($userdata);
				return response()->json($sddata, $status=404, $headers=[], $options=JSON_PRETTY_PRINT);
				
		}
		
	}
	
	public function doLogin(Request $request)
    {
		try{
			$validator = Validator::make($request->all(),[
				'email' => 'required|email',
				'password' => 'required'
			]);
			
			if($validator->fails())
				return response()->json((object)$validator->errors()->all(), $status=400, $headers=[], $options=JSON_PRETTY_PRINT);
				
				
			$credentials = [
				'email'=> $request->email,
				'password' => $request->password,
			];
			
			if(Auth::attempt($credentials)) {
					
			$auth = Auth::user();
			//dd($auth);		
			//$email    = $request->email;
			//$password    = Hash::make($request->password);
			
				//dd($username);
				//$updatetoken = $this->user_model->loginData($username,$password,$refreshedtoken,$devicetype);
			
				//dd($auth);
				$userdata = array(
					"success" =>  true,
					"message" => "You have been successfully logged in!",
					"data" => [
						"token"      => $auth->createToken('LaravelSanctumAuth')->plainTextToken,
						"user_id" => $auth->id,
						"first_name" => $auth->first_name,
						"last_name"  => $auth->last_name,
						"email"  => $auth->email,
					]
				);
				
				return response()->json($userdata, $status=200, $headers=[], $options=JSON_PRETTY_PRINT);

			}else{
				$userdata = array(
					"success"  =>  false,
					"message" => "Incorrect login credential",
					"data" => (object)[]
				);
				//dd($userdata);
				return response()->json($userdata, $status=404, $headers=[], $options=JSON_PRETTY_PRINT);
				
			}

        } catch (\Exception $exception) {
			$error = $exception->getMessage();
			$userdata = array(
				"success"  =>  false,
				"message" => $error,
				"data" => (object)[]
			);
			//dd($userdata);
			return response()->json($userdata, $status=404, $headers=[], $options=JSON_PRETTY_PRINT);
        }
    }
}
