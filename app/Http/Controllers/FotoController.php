<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $rules = array(
            'file' => 'image|max:5000',
        );
        
        $validation = Validator::make($input, $rules);
        
        if ($validation->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validation);
        }
        
        $destinationPath = 'assets/img/tmp'; // upload path
        $namasli = $request->file('file')->getClientOriginalName();
        //$extension = $request->file('file')->getClientOriginalExtension(); // getting file extension
        //$fileName = rand(11111, 99999) . '.' . $extension; // renameing image
        $upload_success = $request->file('file')->move($destinationPath, $namasli); // uploading file to given path
        
        if ($upload_success) {
            return response()->json(['path' => $destinationPath . '/' . $namasli, 'nama' => $namasli], 200);
        } else {
            return response()->json('error', 400);
        }
    }

    public function delete(Request $request)
    {
        $file = $request->input('name');

        unlink(public_path().'/assets/img/tmp'.$file);

        return response()->json(['status' => 'Sukses'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

    }
}
