<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;

class ContentCategoryController extends Controller
{

    public function index()
    {
      $qItems=DB::table('cms_contents_category')->get();
      return view('adminDashBoard/page-contents.contents-category', compact('qItems'));
    }

    public function store(Request $request)
    {
      if(!empty($request->txtCatName) && !(DB::table('cms_contents_category')->where('coca_name', $request->txtCatName)->exists()))
      {
        DB::table('cms_contents_category')->insert([
            'coca_name' => $request->txtCatName,
            'coca_bangla_name' => $request->txtCatBanglaName,
            'coca_is_active' => $request->rdoIsActive,
            'coca_user_ip' => $request->ip(),
            'coca_update_user' => Auth::user()->id,
            'remember_token' => $request->_token,
            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' =>  date('Y-m-d H:i:s')
        ]);
        $request->session()->flash('alert-success', 'Contents Category information is successfully added.');
      }

      return redirect('contents-category');
    }


    public function update(Request $request, $id)
    {
      DB::table('cms_contents_category')->where('id', $id)->update([
          'coca_name' => $request->txtCatName,
          'coca_bangla_name' => $request->txtCatBanglaName,
          'coca_is_active' => $request->rdoIsActive,
          'coca_user_ip' => $request->ip(),
          'coca_update_user' => Auth::user()->id,
          'remember_token' => $request->_token,
          'updated_at' =>  date('Y-m-d H:i:s')
      ]);
      $request->session()->flash('alert-info', 'Contents Category information is successfully updated.');

      return redirect('contents-category');
    }

}
