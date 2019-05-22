<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\admin_model\unit;
use DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Session;
Session_start();

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_unit_info=DB::table('units')->get();
        $manage_unit=view('admin.pages.unit.unit')
        ->with('all_unit_info', $all_unit_info );
        return view('admin.index')
            ->with('admin.all_unit', $manage_unit);
        //return view('admin.pages.unit.unit');
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
        $data=array();
       $data['unit_name']=$request->unit_name;
       $data['publication_status']=$request->publication_status;

        DB::table('units')->insert($data);
        Session::put('message','ການເພີ່ມຫົວໜ່ວຍສິນຄ້າລຳເລັດແລ້ວ...!');
        return Redirect::to('/all-unit');
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
    public function edit($unit_id)
    {
        $unit_info = DB::table('units')
        ->where('unit_id', $unit_id)
        ->first(); 
        $unit_info=view('admin.pages.unit.update_unit')
        ->with('unit_info', $unit_info );
        return view('admin.index')
            ->with('admin.pages.unit.update_unit', $unit_info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $unit_id)
    {
        $data=array();
        $data['unit_name'] = $request->unit_name;
        DB::table('units')
         ->where('unit_id', $unit_id)
         ->update($data); 

         Session::get('message','ຫົວໜ່ວຍສິນຄ້າໄດ້ແກ້ໄຂສຳເລັດແລ້ວ');
         return Redirect::to('/all-unit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($unit_id)
    {
        DB::table('units')
            ->where('unit_id', $unit_id)
            ->delete();
            Session::get('message', 'ຫົວໜ່ວຍສິນຄ້າຖຶກລົບແລ້ວ !');
            return Redirect:: to('/all-unit');
    }
    public function unactive_unit($unit_id)
    {
         DB::table('units')
            ->where('unit_id', $unit_id)
            ->update(['publication_status'=>0] );
            Session::put('message','ຍີຫໍ້ສິນຄ້າປິດໃຊ້ງານສຳເລັດແລ້ວ...!');
            return Redirect::to('/all-unit');
    }
    public function active_unit($unit_id)
    {
        DB::table('units')
            ->where('unit_id', $unit_id)
            ->update(['publication_status'=>1] );
            Session::put('message','ຍີຫໍ້ສິນຄ້າເປິດໃຊ້ງານລຳເລັດແລ້ວ...!');
            return Redirect::to('/all-unit');
    }
}
