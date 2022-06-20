<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Page $page)
    {
        $this->page_model = $page;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'page_name' => 'required|unique:pages,page_name',
            'page_author' => 'required'
        ]);
		
		if($validator->fails())
			return response()->json((object)$validator->errors()->all(), $status=400, $headers=[], $options=JSON_PRETTY_PRINT);
			
		//dd($request->all());
		$page = $this->page_model->save_page($request);
		
		if($page==true){
				
				$sddata = array(
					"success"  =>  true,
					"message" => "Page has been created successfully",
					"data" => []
				);
				return response()->json($sddata, $status=200, $headers=[], $options=JSON_PRETTY_PRINT);

		}else{
				$sddata = array(
					"success"  =>  false,
					"message" => "Page has not been created successfully",
					"data" => []
				);
				//dd($userdata);
				return response()->json($sddata, $status=404, $headers=[], $options=JSON_PRETTY_PRINT);
				
		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
