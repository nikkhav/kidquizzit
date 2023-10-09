<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PositionStore;
use App\Http\Requests\PositionUpdate;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->canOrAbort('postion.index');
        return view('admin.pages.position.index');
    }

    public function list(){
        $item = Position::get();

        return response()->json([
            'code' => 200,
            'data' => $item
        ]);
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
    public function store(PositionStore $request)
    {
        Position::create($request->validated());
        return response()->json([
            'code' =>  200,
            'item' => $request->all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Position::find($id);
        return response()->json([
            'code' => 200,
            'data' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PositionUpdate $request, $id)
    {
        Position::where('id',$request->post('id'))->update($request->validated());

        return response()->json([
            'code' => 200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Position::where('id',$id)->delete();
        return response()->json([
            'code' => 200,
        ]);
    }
}
