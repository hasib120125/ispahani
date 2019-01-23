<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use App\StaffDepartmentModel;

class StaffDepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
      if(empty($request->cmbIsTeacher))
      {
        $qItems=DB::table('cms_staff_department')->paginate(15);
        return view('adminDashBoard/administration.staff-department', compact('qItems'));
      }
      if(!empty($request->cmbIsTeacher))
      {
        $qItems=DB::table('cms_staff_department')->where('sfdp_is_teacher', $request->cmbIsTeacher)->paginate(15);
        return view('adminDashBoard/administration.staff-department', compact('qItems'));
      }

    }

    public function store(Request $request)
    {
      $this->validate($request, [
          'cmbIsTeacher' => 'required',
      ]);

      DB::table('cms_staff_department')->insert([
          'sfdp_name' => $request->txtDepartmentName,
          'sfdp_bangla_name' => $request->txtDepartmentBanglaName,
          'sfdp_is_teacher' => $request->cmbIsTeacher,
          'sfdp_is_active' => $request->rdoIsActive,
          'sfdp_user_ip' => $request->ip(),
          'sfdp_update_user' => Auth::user()->id,
          'remember_token' => $request->_token,
          'created_at' =>  date('Y-m-d H:i:s'),
          'updated_at' =>  date('Y-m-d H:i:s')
      ]);

      $request->session()->flash('alert-success', 'Teacher and Staff department information is successfully added.');
      return redirect('staff-department');

    }

    public function create(Request $request)
    {
      $qItems=DB::table('cms_staff_department')->where('sfdp_is_teacher', $request->rdoIsTeacherSearch)->orderBy('id', 'desc')->paginate(15);
      return view('adminDashBoard/administration.staff-department', compact('qItems'));
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
          'cmbIsTeacher' => 'required',
      ]);

      DB::table('cms_staff_department')->where('id', $id)->update([
          'sfdp_name' => $request->txtDepartmentName,
          'sfdp_bangla_name' => $request->txtDepartmentBanglaName,
          'sfdp_is_teacher' => $request->cmbIsTeacher,
          'sfdp_is_active' => $request->rdoIsActive,
          'sfdp_user_ip' => $request->ip(),
          'sfdp_update_user' => Auth::user()->id,
          'remember_token' => $request->_token,
          'created_at' =>  date('Y-m-d H:i:s'),
          'updated_at' =>  date('Y-m-d H:i:s')
      ]);

      $request->session()->flash('alert-info', 'Teacher and Staff department information is successfully update.');
      return redirect('staff-department');
    }

}
