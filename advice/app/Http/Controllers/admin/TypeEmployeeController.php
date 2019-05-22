<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\admin_model\type_employee;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Session;
Session_start();
class TypeEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('admin.pages.employee.type_employee');
        $all_typeEmployee_info=DB::table('type_employees')->get();
        $manage_type_employee=view('admin.pages.employee.type_employee')
        ->with('all_typeEmployee_info', $all_typeEmployee_info );
        return view('admin.index')
            ->with('admin.type_employee', $manage_type_employee);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=array();
       $data['type_id']=$request->type_id;
       $data['type_employee']=$request->type_employee;
       $data['use_role']=$request->use_role;

        DB::table('type_employees')->insert($data);
        Session::put('message','ການເພີ່ມປະເພດພະນັກງານລຳເລັດແລ້ວ...!');
        return Redirect::to('/type-employee');
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
    public function edit($type_id)
    {
        $typeEmployee_info = DB::table('type_employees')
            ->where('type_id', $type_id)
            ->first(); 
            $typeEmployee_info=view('admin.pages.employee.update_type')
            ->with('typeEmployee_info', $typeEmployee_info );
            return view('admin.index')
                ->with('admin.pages.employee.update_type', $typeEmployee_info);
        // return view("admin.pages.employee.type_employee");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $type_id)
    {
        $data=array();
        $data['type_employee'] = $request->type_employee;
        $data['use_role'] = $request->use_role;
        DB::table('type_employees')
         ->where('type_id', $type_id)
         ->update($data); 

         Session::get('message','ປະເພດພະນັກງານໄດ້ແກ້ໄຂສຳເລັດແລ້ວ');
         return Redirect::to('/type-employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type_id)
    {
        DB::table('type_employees')
            ->where('type_id', $type_id)
            ->delete();
            Session::get('message', 'ປະເພດພະນັກງານຖຶກລົບແລ້ວ !');
            return Redirect:: to('/type-employee');
    }
}
