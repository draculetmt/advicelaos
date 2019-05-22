<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\admin_model\suppliers;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Session;
Session_start();

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_supplier_info=DB::table('suppliers')->get();
        $manage_supplier=view('admin.pages.supplier.supplier')
        ->with('all_supplier_info', $all_supplier_info );
        return view('admin.index')
            ->with('admin.all_supplier', $manage_supplier);
        // return view('admin.pages.supplier.supplier');
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
        $data['supplier_name']=$request->supplier_name;
        $data['supplier_surname']=$request->supplier_surname;
        $data['supplier_address']=$request->supplier_address;
        $data['supplier_email']=$request->supplier_email;
        $data['supplier_phone']=$request->supplier_phone;
        $data['publication_status']=$request->publication_status;
        DB::table('suppliers')->insert($data);
        Session::put('message','ການເພີ່ມຜູ້ສະໜອງລຳເລັດແລ້ວ...!');
        return Redirect::to('/all-supplier');
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
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
    public function edit($supplier_id)
    {
        $supplier_info = DB::table('suppliers')
            ->where('supplier_id', $supplier_id)
            ->first(); 
            $supplier_info=view('admin.pages.supplier.update_supplier')
            ->with('supplier_info', $supplier_info );
            return view('admin.index')
                ->with('admin.pages.supplier.update_supplier', $supplier_info);
        // return view('admin.pages.supplier.update_supplier');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $supplier_id)
    {
        $data=array();
        $data['supplier_name'] = $request->supplier_name;
        $data['supplier_surname'] = $request->supplier_surname;
        $data['supplier_address'] = $request->supplier_address;
        $data['supplier_email'] = $request->supplier_email;
        $data['supplier_phone'] = $request->supplier_phone;
        DB::table('suppliers')
         ->where('supplier_id', $supplier_id)
         ->update($data); 

         Session::get('message','ຜູ້ສະໜອງໄດ້ແກ້ໄຂສຳເລັດແລ້ວ');
         return Redirect::to('/all-supplier');
        // return view('admin.pages.supplier.update_supplier');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($supplier_id)
    {
        DB::table('suppliers')
            ->where('supplier_id', $supplier_id)
            ->delete();
            Session::get('message', 'ຜູ້ສະໜອງຖຶກລົບແລ້ວ !');
            return Redirect:: to('/all-supplier');
    }
    public function unactive_supplier($supplier_id)
    {
         DB::table('suppliers')
            ->where('supplier_id', $supplier_id)
            ->update(['publication_status'=>0] );
            Session::put('message','ຜູ້ສະໜອງປິດໃຊ້ງານສຳເລັດແລ້ວ...!');
            return Redirect::to('/all-supplier');
    }
    public function active_supplier($supplier_id)
    {
        DB::table('suppliers')
            ->where('supplier_id', $supplier_id)
            ->update(['publication_status'=>1] );
            Session::put('message','ຜູ້ສະໜອງເປິດໃຊ້ງານລຳເລັດແລ້ວ...!');
            return Redirect::to('/all-supplier');
    }
}
