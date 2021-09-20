<?php

namespace App\Http\Controllers;

use App\Marketer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;   
class MarketerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {

        return view('marketer.index');
    }
    public function fetchstudent()
    {
        $reports = Marketer::all();
        return response()->json([
            'reports'=>$reports,
        ]);
        // return view('marketer.view_all_user_report');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name'=> 'required',
            'website_url'=>'required',
            'user_email'=>'required',
            'front_heading'=>'required',
            'future_image'=>'required|mimes:jpeg,png,jpg,gif|max:2048',
            'check_speed_mobile'=>'required|mimes:jpeg,png,jpg,gif|max:2048',
            'check_speed_pc'=>'required|mimes:jpeg,png,jpg,gif|max:2048',
            'gt_matrix_summry'=>'required|mimes:jpeg,png,jpg,gif|max:2048',
            'gt_mtrix_highlit_issue'=>'required|mimes:jpeg,png,jpg,gif|max:2048',
            'description'=>'required',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $report = new Marketer;
            $report->user_name = $request->input('user_name');
            $report->website_url = $request->input('website_url');
            $report->user_email = $request->input('user_email');
            $report->front_heading = $request->input('front_heading');
            // image_move
            if ($files = $request->file('future_image')) {
                $destinationPath = 'public/image/'; // upload path
                $profileImage = rand() . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $report->future_image = $profileImage;
            }
            if ($files = $request->file('check_speed_mobile')) {
                $destinationPath = 'public/image/'; // upload path
                $profileImage = rand() . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $report->check_speed_mobile = $profileImage;
            }
           
            // pc
            if ($files = $request->file('check_speed_pc')) {
                $destinationPath = 'public/image/'; // upload path
                $profileImage = rand() . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $report->check_speed_pc = $profileImage;
            } 
            // summry
            if ($files = $request->file('gt_matrix_summry')) {
                $destinationPath = 'public/image/'; // upload path
                $profileImage = rand() . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $report->gt_matrix_summry = $profileImage;
            }
            
            // issue
            if ($files = $request->file('gt_mtrix_highlit_issue')) {
                $destinationPath = 'public/image/'; // upload path
                $profileImage = rand() . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $report->gt_matrix_highlit_issue =$profileImage;
            }
            $report->description = $request->input('description');
            $report->save();
            return response()->json([
                'status'=>200,
                'message'=>'Report Added Successfully.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marketer  $marketer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reports=  Marketer::findOrfail($id); 
        if($reports)
        {
            return response()->json([
                'status'=>200,
                'reports'=> $reports,
            ]);
        }
        // return view('marketer.view');
      
    }
    public function result(Request $request)
    {
        $reports=  Marketer::findOrfail($request->user_id); 
        return view('marketer.view',compact('reports'));
      
    }
    public function add_reports(Marketer $marketer)
    {
        return view('marketer.add_new_report');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marketer  $marketer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $reports = Marketer::find($id);
        if($reports)
        {
            return response()->json([
                'status'=>200,
                'reports'=> $reports,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Student Found.'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marketer  $marketer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,$id)
    { 
        // dd($request->all());
      
       
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marketer  $marketer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $reports = Marketer::find($id);
        if($reports)
        {
            $reports->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Student Deleted Successfully.'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Student Found.'
            ]);
        }
    }
    public function update_report(Request $request, $id)
    {    
        $report = Marketer::find($id);
        if($report)
        {
            $report->user_name = $request->input('user_name');
            $report->website_url = $request->input('website_url');
            $report->user_email = $request->input('user_email');
            $report->front_heading = $request->input('front_heading');
            // image_move
            if ($files = $request->file('future_image')) {
                $destinationPath = 'public/image/'; // upload path
                $profileImage = rand() . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $report->future_image = $profileImage;
            }
            if ($files = $request->file('check_speed_mobile')) {
                $destinationPath = 'public/image/'; // upload path
                $profileImage = rand() . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $report->check_speed_mobile = $profileImage;
            }
            
            // pc
            if ($files = $request->file('check_speed_pc')) {
                $destinationPath = 'public/image/'; // upload path
                $profileImage = rand() . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $report->check_speed_pc = $profileImage;
            } 
            // summry
            if ($files = $request->file('gt_matrix_summry')) {
                $destinationPath = 'public/image/'; // upload path
                $profileImage = rand() . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $report->gt_matrix_summry = $profileImage;
            }
            
            // issue
            if ($files = $request->file('gt_mtrix_highlit_issue')) {
                $destinationPath = 'public/image/'; // upload path
                $profileImage = rand() . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $report->gt_matrix_highlit_issue =$profileImage;
            }
            $report->description = $request->input('description');
            $report->update();
            return response()->json([
                'status'=>200,
                'message'=>'Student Updated Successfully.'
            ]);
        }else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Student Found.'
            ]);
        }
           
    }
}
