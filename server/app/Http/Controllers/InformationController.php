<?php

namespace App\Http\Controllers;

use App\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Information::get());
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
        $this->validate($request,[
            'name' => 'required',
            'input_data' => 'required|array',
            'output_data' => 'required|array',
            'calculated_amount_month_wise' => 'required',
            'accumulated_yield' => 'required',
            'desired_pension_amount_month_wise' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'input_data' =>  $request->input_data,
            'output_data' =>  $request->output_data,
            'calculated_amount_month_wise' =>  $request->calculated_amount_month_wise,
            'accumulated_yield' =>  $request->accumulated_yield,
            'desired_pension_amount_month_wise' =>  $request->desired_pension_amount_month_wise,
        ];

        $resp = Information::create($data);

        if($resp)
            $message = ['success' => true, 'message' => 'Successfully saved'];
        else
            $message = ['success' => false, 'message' => 'Opps something went wrong'];
        
        return response()->json($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $information = Information::find($id);
        return response()->json($information);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function edit(Information $information)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Information $information)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $information = Information::find($id);
        $information->delete();
        return response()->json(Information::get());
    }
}
