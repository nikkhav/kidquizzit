<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonalStore;
use App\Http\Requests\PesonalUpadate;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
class PersonalController extends Controller
{
    public function __construct()
    {
        $postions = Position::orderBy('name','asc')->get();
        $departments  = Department::orderBy('name','asc')->get();
        $roles = Role::whereNotIn('id',[1,2])->get();
        view()->share('postions' ,$postions);
        view()->share('departments' ,$departments);
        view()->share('roles' ,$roles);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $this->canOrAbort('personal.index');
       return view('admin.pages.personal.index');
    }

    public function list(){
        $items = User::where('type','worker')->with(['department','position'])
        ->get();
        return response()->json([
            'code' => 200,
            'data' => $items
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
    public function store(PersonalStore $request)
    {
        
        $user  = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->position_id = $request->position_id;
        $user->department_id = $request->department_id;
        $user->gender = $request->gender;
        $user->info = $request->info;
        $user->birthday = $request->birthday;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->whatsapp = 1;
        $user->password =  Hash::make($request->post('password'));

        if($request->file('file')){
            $dPath = 'profile/';
            $img   = $request->file('file');
            $fName = $img->getClientOriginalName();
            $exten = $img->getClientOriginalExtension();
            $request->file('file')->storeAs($dPath, $fName);
            $path  = $dPath . '' . $fName;
            Storage::disk('public')->put($path, file_get_contents($request->file('file')));
            $user->image =   $path ;
        }
      

       $user->save();
       $user->syncRoles($request->role_id);

       return response()->json([
        'code' => 200,
        'data' => $request->all()
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
        $item = User::where('id',$id)->first();
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
    public function update(PesonalUpadate $request, $id)
    {
      
        $data = [
            'name'          => $request->post('name'),
            'surname'       => $request->post('surname'),
            'password'      => Hash::make($request->post('password')),
            'email'         => $request->post('email'),
            'position_id'   => $request->post('position_id'),
            'department_id' => $request->post('department_id'),
            'gender'         => $request->post('gender'),
            'address'        => $request->post('address'),
            'info'           => $request->post('info'),
            'birthday'       => Carbon::createFromFormat('m/d/Y', $request->post('birthday'))->format('Y-m-d H:i:s'),
            'phone'          => $request->post('phone'),
            'whatsapp'       => 1,
           ];
    
           if($request->file('file')){
            $dPath = 'profile/';
            $img   = $request->file('file');
            $fName = $img->getClientOriginalName();
            $exten = $img->getClientOriginalExtension();
            $request->file('file')->storeAs($dPath, $fName);
            $path  = $dPath . '' . $fName;
            Storage::disk('public')->put($path, file_get_contents($request->file('file')));
            $data['image'] =   $path ;
            // return response()->json([
            //     'data' => $path
            // ],500);
        }
      
           User::where('id',$id )->update($data);

           $user = User::where('id',$id)->first();
           $user->syncRoles($request->role_id);
           return response()->json([
            'code' => $request->all(),
           ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id',$id)->delete();
        return response()->json([
            'code' => 200,
        ]);
    }

    public function test(){
        return response()->json([
            'data' =>'asdasdasdasd'
        ]);
    }

    public function image(Request $request){
        $dPath = 'profile/';
        $img   = $request->file('file');
        $fName = $img->getClientOriginalName();
        $exten = $img->getClientOriginalExtension();
        $request->file('file')->storeAs($dPath, $fName);
        $path  = $dPath . '' . $fName;
        Storage::disk('public')->put($path, file_get_contents($request->file('file')));
       return  $path;


    }
}
