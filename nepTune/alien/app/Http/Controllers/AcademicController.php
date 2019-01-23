<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;

class AcademicController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('adminDashBoard/academic.program-information');
    }

    public function store(Request $request)
    {
        $sCategory=$request->txtCategory;

        if($sCategory=='ClasS')
        {
          if(!empty($request->txtName) && !(DB::table('cms_program')->where('prog_name', $request->txtName)->exists()))
          {
           DB::table('cms_program')->insert([
               'prog_name' => $request->txtName,
               'prog_bangla_name' => $request->txtBanglaName,
               'prog_is_active' => $request->rdoIsActive,
               'prog_user_ip' => $request->ip(),
               'prog_update_user' => Auth::user()->id,
               'remember_token' => $request->_token,
               'created_at' =>  date('Y-m-d H:i:s'),
               'updated_at' =>  date('Y-m-d H:i:s')
           ]);
           $request->session()->flash('alert-success', 'Class information is successfully added.');
          }
          else
          {
            $request->session()->flash('alert-danger', 'Class information already exists. Don not refresh again.');
          }

         $qItems=DB::table('cms_program')->select('id as iID','prog_name as sName','prog_bangla_name as sBanglaName','prog_is_active as sActive','updated_at as dLastUpdate')->get();

         return view('adminDashBoard/academic.program-information', compact('qItems','sCategory'));
        }
        elseif($sCategory=='GrouP')
        {
          if(!empty($request->txtName) && !(DB::table('cms_group')->where('grou_name', $request->txtName)->exists()))
          {
            DB::table('cms_group')->insert([
                'grou_name' => $request->txtName,
                'grou_bangla_name' => $request->txtBanglaName,
                'grou_is_active' => $request->rdoIsActive,
                'grou_user_ip' => $request->ip(),
                'grou_update_user' => Auth::user()->id,
                'remember_token' => $request->_token,
                'created_at' =>  date('Y-m-d H:i:s'),
                'updated_at' =>  date('Y-m-d H:i:s')
            ]);
            $request->session()->flash('alert-success', 'Group information is successfully added.');
          }

          $qItems=DB::table('cms_group')->select('id as iID','grou_name as sName','grou_bangla_name as sBanglaName','grou_is_active as sActive','updated_at as dLastUpdate')->get();
          return view('adminDashBoard/academic.program-information', compact('qItems','sCategory'));
        }
        elseif($sCategory=='ShifT')
        {
          if(!empty($request->txtName) && !(DB::table('cms_shift')->where('shif_name', $request->txtName)->exists()))
          {
            DB::table('cms_shift')->insert([
               'shif_name' => $request->txtName,
               'shif_bangla_name' => $request->txtBanglaName,
               'shif_is_active' => $request->rdoIsActive,
               'shif_user_ip' => $request->ip(),
               'shif_update_user' => Auth::user()->id,
               'remember_token' => $request->_token,
               'created_at' =>  date('Y-m-d H:i:s'),
               'updated_at' =>  date('Y-m-d H:i:s')
           ]);
           $request->session()->flash('alert-success', 'Shift information is successfully added.');
          }

          $qItems=DB::table('cms_shift')->select('id as iID','shif_name as sName','shif_bangla_name as sBanglaName','shif_is_active as sActive','updated_at as dLastUpdate')->get();
          return view('adminDashBoard/academic.program-information', compact('qItems','sCategory'));
        }
        elseif($sCategory=='VersioN')
        {
          if(!empty($request->txtName) && !(DB::table('cms_version')->where('vers_name', $request->txtName)->exists()))
          {
            DB::table('cms_version')->insert([
               'vers_name' => $request->txtName,
               'vers_bangla_name' => $request->txtBanglaName,
               'vers_is_active' => $request->rdoIsActive,
               'vers_user_ip' => $request->ip(),
               'vers_update_user' => Auth::user()->id,
               'remember_token' => $request->_token,
               'created_at' =>  date('Y-m-d H:i:s'),
               'updated_at' =>  date('Y-m-d H:i:s')
           ]);
           $request->session()->flash('alert-success', 'Version information is successfully added.');
          }

         $qItems=DB::table('cms_version')->select('id as iID','vers_name as sName','vers_bangla_name as sBanglaName','vers_is_active as sActive','updated_at as dLastUpdate')->get();
         return view('adminDashBoard/academic.program-information', compact('qItems','sCategory'));
        }
        elseif($sCategory=='DesignatioN')
        {
          if(!empty($request->txtName) && !(DB::table('cms_designation')->where('desi_name', $request->txtName)->exists()))
          {
            DB::table('cms_designation')->insert([
               'desi_name' => $request->txtName,
               'desi_bangla_name' => $request->txtBanglaName,
               'desi_is_active' => $request->rdoIsActive,
               'desi_user_ip' => $request->ip(),
               'desi_update_user' => Auth::user()->id,
               'remember_token' => $request->_token,
               'created_at' =>  date('Y-m-d H:i:s'),
               'updated_at' =>  date('Y-m-d H:i:s')
           ]);

           $request->session()->flash('alert-success', 'Designation information is successfully added.');
          }

         $qItems=DB::table('cms_designation')->select('id as iID','desi_name as sName','desi_bangla_name as sBanglaName','desi_is_active as sActive','updated_at as dLastUpdate')->get();
         return view('adminDashBoard/academic.program-information', compact('qItems','sCategory'));
        }
        elseif($sCategory=='SubjecT')
        {
          if(!empty($request->txtName) && !(DB::table('cms_subject')->where('subj_name', $request->txtName)->exists()))
          {
            DB::table('cms_subject')->insert([
               'subj_name' => $request->txtName,
               'subj_bangla_name' => $request->txtBanglaName,
               'subj_is_active' => $request->rdoIsActive,
               'subj_user_ip' => $request->ip(),
               'subj_update_user' => Auth::user()->id,
               'remember_token' => $request->_token,
               'created_at' =>  date('Y-m-d H:i:s'),
               'updated_at' =>  date('Y-m-d H:i:s')
           ]);
           $request->session()->flash('alert-success', 'Subject information is successfully added.');
          }

          $qItems=DB::table('cms_subject')->select('id as iID','subj_name as sName','subj_bangla_name as sBanglaName','subj_is_active as sActive','updated_at as dLastUpdate')->get();
          return view('adminDashBoard/academic.program-information', compact('qItems','sCategory'));
        }
        elseif($sCategory=='ReligioN')
        {
          if(!empty($request->txtName) && !(DB::table('cms_religion')->where('reli_name', $request->txtName)->exists()))
          {
            DB::table('cms_religion')->insert([
               'reli_name' => $request->txtName,
               'reli_bangla_name' => $request->txtBanglaName,
               'reli_is_active' => $request->rdoIsActive,
               'reli_user_ip' => $request->ip(),
               'reli_update_user' => Auth::user()->id,
               'remember_token' => $request->_token,
               'created_at' =>  date('Y-m-d H:i:s'),
               'updated_at' =>  date('Y-m-d H:i:s')
           ]);
           $request->session()->flash('alert-success', 'Religion information is successfully added.');
          }

          $qItems=DB::table('cms_religion')->select('id as iID','reli_name as sName','reli_bangla_name as sBanglaName','reli_is_active as sActive','updated_at as dLastUpdate')->get();
          return view('adminDashBoard/academic.program-information', compact('qItems','sCategory'));
        }
        elseif($sCategory=='BoarD')
        {
          if(!empty($request->txtName) && !(DB::table('cms_board')->where('boar_name', $request->txtName)->exists()))
          {
            DB::table('cms_board')->insert([
               'boar_name' => $request->txtName,
               'boar_bangla_name' => $request->txtBanglaName,
               'boar_is_active' => $request->rdoIsActive,
               'boar_user_ip' => $request->ip(),
               'boar_update_user' => Auth::user()->id,
               'remember_token' => $request->_token,
               'created_at' =>  date('Y-m-d H:i:s'),
               'updated_at' =>  date('Y-m-d H:i:s')
           ]);
           $request->session()->flash('alert-success', 'Board information is successfully added.');
          }

          $qItems=DB::table('cms_board')->select('id as iID','boar_name as sName','boar_bangla_name as sBanglaName','boar_is_active as sActive','updated_at as dLastUpdate')->get();
          return view('adminDashBoard/academic.program-information', compact('qItems','sCategory'));
        }
        elseif($sCategory=='VideoCategory')
        {
          if(!empty($request->txtName) && !(DB::table('cms_video_category')->where('vict_name', $request->txtName)->exists()))
          {
            DB::table('cms_video_category')->insert([
               'vict_name' => $request->txtName,
               'vict_bangla_name' => $request->txtBanglaName,
               'vict_is_active' => $request->rdoIsActive,
               'vict_user_ip' => $request->ip(),
               'vict_update_user' => Auth::user()->id,
               'remember_token' => $request->_token,
               'created_at' =>  date('Y-m-d H:i:s'),
               'updated_at' =>  date('Y-m-d H:i:s')
           ]);
           $request->session()->flash('alert-success', 'Video category is successfully added.');
          }

          $qItems=DB::table('cms_video_category')->select('id as iID','vict_name as sName','vict_bangla_name as sBanglaName','vict_is_active as sActive','updated_at as dLastUpdate')->get();
          return view('adminDashBoard/academic.program-information', compact('qItems','sCategory'));
        }
        else
        {
          $request->session()->flash('alert-warning', 'Sorry you are not chose any category.');
          return back();
        }

    }

    public function update(Request $request, $id)
    {
      $sCategory=$request->txtCategory;

      if($sCategory=='ClasS')
      {
        if(!empty($request->txtName))
        {
         DB::table('cms_program')->where('id', $id)->update([
             'prog_name' => $request->txtName,
             'prog_bangla_name' => $request->txtBanglaName,
             'prog_is_active' => $request->rdoIsActive,
             'prog_user_ip' => $request->ip(),
             'prog_update_user' => Auth::user()->id,
             'remember_token' => $request->_token,
             'updated_at' =>  date('Y-m-d H:i:s')
         ]);
         $request->session()->flash('alert-success', 'Class information is successfully updated.');
        }

       $qItems=DB::table('cms_program')->select('id as iID','prog_name as sName','prog_bangla_name as sBanglaName','prog_is_active as sActive','updated_at as dLastUpdate')->get();

       return view('adminDashBoard/academic.program-information', compact('qItems','sCategory'));
      }
      elseif($sCategory=='GrouP')
      {
        if(!empty($request->txtName))
        {
          DB::table('cms_group')->where('id', $id)->update([
              'grou_name' => $request->txtName,
              'grou_bangla_name' => $request->txtBanglaName,
              'grou_is_active' => $request->rdoIsActive,
              'grou_user_ip' => $request->ip(),
              'grou_update_user' => Auth::user()->id,
              'remember_token' => $request->_token,
              'updated_at' =>  date('Y-m-d H:i:s')
          ]);
          $request->session()->flash('alert-success', 'Group information is successfully updated.');
        }

        $qItems=DB::table('cms_group')->select('id as iID','grou_name as sName','grou_bangla_name as sBanglaName','grou_is_active as sActive','updated_at as dLastUpdate')->get();
        return view('adminDashBoard/academic.program-information', compact('qItems','sCategory'));
      }
      elseif($sCategory=='ShifT')
      {
        if(!empty($request->txtName))
        {
          DB::table('cms_shift')->where('id', $id)->update([
             'shif_name' => $request->txtName,
             'shif_bangla_name' => $request->txtBanglaName,
             'shif_is_active' => $request->rdoIsActive,
             'shif_user_ip' => $request->ip(),
             'shif_update_user' => Auth::user()->id,
             'remember_token' => $request->_token,
             'updated_at' =>  date('Y-m-d H:i:s')
         ]);
         $request->session()->flash('alert-success', 'Shift information is successfully updated.');
        }

        $qItems=DB::table('cms_shift')->select('id as iID','shif_name as sName','shif_bangla_name as sBanglaName','shif_is_active as sActive','updated_at as dLastUpdate')->get();
        return view('adminDashBoard/academic.program-information', compact('qItems','sCategory'));
      }
      elseif($sCategory=='VersioN')
      {
        if(!empty($request->txtName))
        {
          DB::table('cms_version')->where('id', $id)->update([
             'vers_name' => $request->txtName,
             'vers_bangla_name' => $request->txtBanglaName,
             'vers_is_active' => $request->rdoIsActive,
             'vers_user_ip' => $request->ip(),
             'vers_update_user' => Auth::user()->id,
             'remember_token' => $request->_token,
             'updated_at' =>  date('Y-m-d H:i:s')
         ]);
         $request->session()->flash('alert-success', 'Version information is successfully updated.');
        }

       $qItems=DB::table('cms_version')->select('id as iID','vers_name as sName','vers_bangla_name as sBanglaName','vers_is_active as sActive','updated_at as dLastUpdate')->get();
       return view('adminDashBoard/academic.program-information', compact('qItems','sCategory'));
      }
      elseif($sCategory=='DesignatioN')
      {
        if(!empty($request->txtName))
        {
          DB::table('cms_designation')->where('id', $id)->update([
             'desi_name' => $request->txtName,
             'desi_bangla_name' => $request->txtBanglaName,
             'desi_is_active' => $request->rdoIsActive,
             'desi_user_ip' => $request->ip(),
             'desi_update_user' => Auth::user()->id,
             'remember_token' => $request->_token,
             'created_at' =>  date('Y-m-d H:i:s'),
             'updated_at' =>  date('Y-m-d H:i:s')
         ]);

         $request->session()->flash('alert-success', 'Designation information is successfully updated.');
        }

       $qItems=DB::table('cms_designation')->select('id as iID','desi_name as sName','desi_bangla_name as sBanglaName','desi_is_active as sActive','updated_at as dLastUpdate')->get();
       return view('adminDashBoard/academic.program-information', compact('qItems','sCategory'));
      }
      elseif($sCategory=='SubjecT')
      {
        if(!empty($request->txtName))
        {
          DB::table('cms_subject')->where('id', $id)->update([
             'subj_name' => $request->txtName,
             'subj_bangla_name' => $request->txtBanglaName,
             'subj_is_active' => $request->rdoIsActive,
             'subj_user_ip' => $request->ip(),
             'subj_update_user' => Auth::user()->id,
             'remember_token' => $request->_token,
             'updated_at' =>  date('Y-m-d H:i:s')
         ]);
         $request->session()->flash('alert-success', 'Subject information is successfully updated.');
        }

        $qItems=DB::table('cms_subject')->select('id as iID','subj_name as sName','subj_bangla_name as sBanglaName','subj_is_active as sActive','updated_at as dLastUpdate')->get();
        return view('adminDashBoard/academic.program-information', compact('qItems','sCategory'));
      }
      elseif($sCategory=='ReligioN')
      {
        if(!empty($request->txtName))
        {
          DB::table('cms_religion')->where('id', $id)->update([
             'reli_name' => $request->txtName,
             'reli_bangla_name' => $request->txtBanglaName,
             'reli_is_active' => $request->rdoIsActive,
             'reli_user_ip' => $request->ip(),
             'reli_update_user' => Auth::user()->id,
             'remember_token' => $request->_token,
             'updated_at' =>  date('Y-m-d H:i:s')
         ]);
         $request->session()->flash('alert-success', 'Religion information is successfully updated.');
        }

        $qItems=DB::table('cms_religion')->select('id as iID','reli_name as sName','reli_bangla_name as sBanglaName','reli_is_active as sActive','updated_at as dLastUpdate')->get();
        return view('adminDashBoard/academic.program-information', compact('qItems','sCategory'));
      }
      elseif($sCategory=='BoarD')
      {
        if(!empty($request->txtName))
        {
          DB::table('cms_board')->where('id', $id)->update([
             'boar_name' => $request->txtName,
             'boar_bangla_name' => $request->txtBanglaName,
             'boar_is_active' => $request->rdoIsActive,
             'boar_user_ip' => $request->ip(),
             'boar_update_user' => Auth::user()->id,
             'remember_token' => $request->_token,
             'updated_at' =>  date('Y-m-d H:i:s')
         ]);
         $request->session()->flash('alert-success', 'Board information is successfully updated.');
        }

        $qItems=DB::table('cms_board')->select('id as iID','boar_name as sName','boar_bangla_name as sBanglaName','boar_is_active as sActive','updated_at as dLastUpdate')->get();
        return view('adminDashBoard/academic.program-information', compact('qItems','sCategory'));
      }
      elseif($sCategory=='VideoCategory')
      {
        if(!empty($request->txtName))
        {
          DB::table('cms_video_category')->where('id', $id)->update([
             'vict_name' => $request->txtName,
             'vict_bangla_name' => $request->txtBanglaName,
             'vict_is_active' => $request->rdoIsActive,
             'vict_user_ip' => $request->ip(),
             'vict_update_user' => Auth::user()->id,
             'remember_token' => $request->_token,
             'updated_at' =>  date('Y-m-d H:i:s')
         ]);
         $request->session()->flash('alert-success', 'Video category is successfully updated.');
        }

        $qItems=DB::table('cms_video_category')->select('id as iID','vict_name as sName','vict_bangla_name as sBanglaName','vict_is_active as sActive','updated_at as dLastUpdate')->get();
        return view('adminDashBoard/academic.program-information', compact('qItems','sCategory'));
      }
      else
      {
        $request->session()->flash('alert-warning', 'Sorry you are not chose any category.');
        return back();
      }
    }

}
