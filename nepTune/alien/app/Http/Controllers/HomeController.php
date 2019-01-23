<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // USER REGISTRATION AND UPDATE INFORMATION
    public function index()
    {
      $rDuplUserInformation = User::where('user_type','=','EdiToR')->get();
      return view('auth.register', compact('rDuplUserInformation'));
    }

    // This function create DUPL user
    public function store(Request $request)
    {
      if(Auth::user()->user_type != 'EdiToR')
      {
        $this->validate($request,[
              'name' => 'required|max:129',
              'email' => 'required|email|max:69|unique:users',
              'password' => 'required|confirmed|min:6',
        ]);

        $item= new User;
        $item->name =$request->name;
        $item->designation =$request->text_designation;
        $item->mobile =$request->text_mobile;
        $item->email = $request->email;
        $item->user_type = 'EdiToR';
        $item->user_reference = Auth::user()->id;
        $item->password = bcrypt($request->password);
        $item->is_active = $request->rdo_is_active;
        $item->ip_address = $request->ip();
        $item->remember_token = $request->_token;

        $item-> save();

        $request->session()->flash('alert-success', 'User information was successfully added.');
        return redirect('user-registration');
      }
      else
      {
        $request->session()->flash('alert-warning', 'Sorry you can not create user!');
        return redirect('user-registration');
      }

    }

    public function update(Request $request, $id)
    {
      if(Auth::user()->user_type != 'EdiToR')
      {
        $this->validate($request,[
            'name' => 'required|max:129',
        ]);

        $item= User::findOrFail($id);
        $item->name =$request->name;
        $item->designation =$request->text_designation;
        $item->mobile =$request->text_mobile;
        $item->is_active = $request->rdo_is_active;
        $item->remember_token = $request->_token;

        $item-> save();

        $request->session()->flash('alert-info', 'User information was successfully updated.');
        return redirect('user-registration');
      }
      else
      {
        $request->session()->flash('alert-warning', 'Sorry you can not update user information!');
        return redirect('user-registration');
      }
    }

    public function destroy(Request $request, $id)
    {
      if(Auth::user()->user_type != 'EdiToR')
      {
        $deleteUser= User::findOrFail($id);
        $deleteUser->delete();

        $request->session()->flash('alert-danger', 'User information was successfully delete.');
        return redirect('user-registration');
      }
      else
      {
        $request->session()->flash('alert-warning', 'Sorry you can not delete user!');
        return redirect('user-registration');
      }
    }
}
