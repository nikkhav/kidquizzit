<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerTypeStore;
use App\Http\Requests\CustomerTypeUpdate;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class CustomerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.customer_type.index');
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
    public function store(CustomerTypeStore $request)
    {
        CustomerType::create($request->validated());
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
        $item = CustomerType::find($id);
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
    public function update(CustomerTypeUpdate $request, $id)
    {
        CustomerType::where('id', $request->post('id'))->update($request->validated());

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
        CustomerType::where('id', $id)->delete();
        return response()->json([
            'code' => 200,
        ]);
    }
}
