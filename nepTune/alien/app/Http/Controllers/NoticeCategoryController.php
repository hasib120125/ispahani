<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;

class NoticeCategoryController extends Controller
{

    public function index()
    {
      $qItems=DB::table('cms_notice_category')->get();
      return view('adminDashBoard/notice.notice-category', compact('qItems'));
    }

    public function store(Request $request)
    {
      if(!empty($request->txtCatName) && !(DB::table('cms_notice_category')->where('noca_name', $request->txtCatName)->exists()))
      {
        DB::table('cms_notice_category')->insert([
            'noca_name' => $request->txtCatName,
            'noca_bangla_name' => $request->txtCatBanglaName,
            'noca_is_active' => $request->rdoIsActive,
            'noca_user_ip' => $request->ip(),
            'noca_update_user' => Auth::user()->id,
            'remember_token' => $request->_token,
            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' =>  date('Y-m-d H:i:s')
        ]);
        $request->session()->flash('alert-success', 'Notice Category information is successfully added.');
      }

      return redirect('notice-category');
    }

    public function update(Request $request, $id)
    {
      DB::table('cms_notice_category')->where('id', $id)->update([
          'noca_name' => $request->txtCatName,
          'noca_bangla_name' => $request->txtCatBanglaName,
          'noca_is_active' => $request->rdoIsActive,
          'noca_user_ip' => $request->ip(),
          'noca_update_user' => Auth::user()->id,
          'remember_token' => $request->_token,
          'updated_at' =>  date('Y-m-d H:i:s')
      ]);
      $request->session()->flash('alert-info', 'Notice Category information is successfully updated.');

      return redirect('notice-category');
    }

}
