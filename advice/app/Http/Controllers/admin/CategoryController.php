<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\admin_model\category;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Session;
Session_start();

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('admin.pages.category.category');
        $all_category_info=DB::table('categories')->get();
        $manage_category=view('admin.pages.category.category')
        ->with('all_category_info', $all_category_info );
        return view('admin.index')
            ->with('admin.all_category', $manage_category);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.category.category');
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
       $data['cat_id']=$request->cat_id;
       $data['cat_name']=$request->cat_name;
       $data['cat_desc']=$request->cat_desc;
       $data['publication_status']=$request->publication_status;

        DB::table('categories')->insert($data);
        Session::put('message','ການເພີ່ມປະເພດສິນຄ້າລຳເລັດແລ້ວ...!');
        return Redirect::to('/all-category');
        // return $request->all();
    // $this->validate($request,[
    //     'cat_id'=>'requried',
    //     'cat_name'=>'required',
    //     'cat_desc'=>'required',
    //     'publication'=>'required',
    // ]);
    // $post = new post;
    // $post->cat_id=$request->cat_id;
    // $post->cat_name=$request->cat_name;
    // $post->cat_desc=$request->cat_desc;
    // $post->publication_status=$request->publication_status;
    // $post->save();
    // return Redirect::to('/all-category');

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
    public function edit($cat_id)
    {
            $category_info = DB::table('categories')
            ->where('cat_id', $cat_id)
            ->first(); 
            $category_info=view('admin.pages.category.update_cat')
            ->with('category_info', $category_info );
            return view('admin.index')
                ->with('admin.pages.category.update_cat', $category_info);
        // echo $cat_id;
        // return view('admin.pages.category.update_cat');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cat_id)
    {
        $data=array();
        $data['cat_name'] = $request->cat_name;
        $data['cat_desc'] = $request->cat_desc;

        DB::table('categories')
         ->where('cat_id', $cat_id)
         ->update($data); 

         Session::get('message','ປະເພດສິນຄ້າໄດ້ແກ້ໄຂສຳເລັດແລ້ວ');
         return Redirect::to('/all-category');
        // return view('admin.pages.category.update_cat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cat_id)
    {
        //
        DB::table('categories')
            ->where('cat_id', $cat_id)
            ->delete();
            Session::get('message', 'ປະເພດສິນຄ້າຖຶກລົບແລ້ວ !');
            return Redirect:: to('/all-category');
    }
    public function unactive_category($cat_id)
    {
         DB::table('categories')
            ->where('cat_id', $cat_id)
            ->update(['publication_status'=>0] );
            Session::put('message','ປະເພດສິນຄ້າປິດໃຊ້ງານສຳເລັດແລ້ວ...!');
            return Redirect::to('/all-category');
    }
    public function active_category($cat_id)
    {
        DB::table('categories')
            ->where('cat_id', $cat_id)
            ->update(['publication_status'=>1] );
            Session::put('message','ປະເພດສິນຄ້າເປິດໃຊ້ງານລຳເລັດແລ້ວ...!');
            return Redirect::to('/all-category');
    }
}
 