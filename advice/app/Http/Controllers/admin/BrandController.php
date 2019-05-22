<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\admin_model\brand;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Session;
Session_start();

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_brand_info=DB::table('brands')->get();
        $manage_brand=view('admin.pages.brand.brand')
        ->with('all_brand_info', $all_brand_info );
        return view('admin.index')
            ->with('admin.all_brand', $manage_brand);
        //return view('admin.pages.brand.brand');
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
       $data['brand_id']=$request->brand_id;
       $data['brand_name']=$request->brand_name;
       $data['brand_desc']=$request->brand_desc;
       $data['publication_status']=$request->publication_status;

        DB::table('brands')->insert($data);
        Session::put('message','ການເພີ່ມປະເພດສິນຄ້າລຳເລັດແລ້ວ...!');
        return Redirect::to('/all-brand');
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
    public function edit($brand_id)
    {
            $brand_info = DB::table('brands')
            ->where('brand_id', $brand_id)
            ->first(); 
            $brand_info=view('admin.pages.brand.update_brand')
            ->with('brand_info', $brand_info );
            return view('admin.index')
                ->with('admin.pages.brand.update_brand', $brand_info);
        // return view('admin.pages.brand.update_brand');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $brand_id)
    {
        $data=array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_desc'] = $request->brand_desc;
        DB::table('brands')
         ->where('brand_id', $brand_id)
         ->update($data); 

         Session::get('message','ຍີຫໍ້ສິນຄ້າໄດ້ແກ້ໄຂສຳເລັດແລ້ວ');
         return Redirect::to('/all-brand');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($brand_id)
    {
        DB::table('brands')
            ->where('brand_id', $brand_id)
            ->delete();
            Session::get('message', 'ຍີຫໍ້ສິນຄ້າຖຶກລົບແລ້ວ !');
            return Redirect:: to('/all-brand');
    }
    public function unactive_brand($brand_id)
    {
         DB::table('brands')
            ->where('brand_id', $brand_id)
            ->update(['publication_status'=>0] );
            Session::put('message','ຍີຫໍ້ສິນຄ້າປິດໃຊ້ງານສຳເລັດແລ້ວ...!');
            return Redirect::to('/all-brand');
    }
    public function active_brand($brand_id)
    {
        DB::table('brands')
            ->where('brand_id', $brand_id)
            ->update(['publication_status'=>1] );
            Session::put('message','ຍີຫໍ້ສິນຄ້າເປິດໃຊ້ງານລຳເລັດແລ້ວ...!');
            return Redirect::to('/all-brand');
    }
}
