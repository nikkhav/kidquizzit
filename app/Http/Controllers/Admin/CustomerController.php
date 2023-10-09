<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerStore;
use App\Http\Requests\CustomerTypeUpdate;
use App\Models\Customer;
use App\Models\CustomerType;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class CustomerController extends Controller
{
    public function __construct()
    {
        view()->share('types',$types = CustomerType::all());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
       return view('admin.pages.customer.index');
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
    public function store(CustomerStore $request)
    {
        $data = $request->toArray();
        $customer = Customer::latest()->first() ;

        $ID  = isset($customer?->id) ? $customer?->id : 1 ;
        $data['customer_number'] =str_pad($ID, 4, '0', STR_PAD_LEFT);
       Customer::create($data);
        return response()->json([
            'code' =>  200,
            'item' =>  $customer
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
        $item = Customer::find($id);
        $view = view('admin.pages.customer.form',compact('item'))->render();
        return response()->json([
            'code' => 200,
            'view' => $view 
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
        Customer::where('id', $id)->update($request->validated());

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
        Customer::where('id', $id)->delete();
        return response()->json([
            'code' => 200,
            'alet' => 'asd'
        ]);
    }
}
