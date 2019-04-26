<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.pages.user.listUser',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.user.addUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|max:32',
            'confirm-password' => 'required|same:password'
        ],
        [
            'name.required' => "This name field can't empty",
            'name.min' => "Please enter name > 3 character",
            'email.required' => "This Email field can't empty",
            'email.email' => "Please enter valid email format ",
            'email.unique' => "This email has already exist",
            'password.required' => "This Password field can't empty",
            'password.min' => "Please enter password > 3 character",
            'password.max' => "Please enter password < 32 character",
            'confirm-password.required' => "This Password Confirm field can't empty",
            'confirm-password.same' => "Please enter confirm password the same password"
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('add-user')->with('message','Add Successfully');
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
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.pages.user.editUser',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
        ],
        [
            'name.required' => "This name field can't empty",
            'name.min' => "Please enter name > 3 character",
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        if ($request->changPassword == "on") {
            $this->validate($request, [
                'password' => 'required|min:3|max:32',
                'confirm-password' => 'required|same:password'
            ],
            [
                'password.required' => "This Password field can't empty",
                'password.min' => "Please enter password > 3 character",
                'password.max' => "Please enter password < 32 character",
                'confirm-password.required' => "This Password Confirm field can't empty",
                'confirm-password.same' => "Please enter confirm password the same password"
            ]);
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('get-edit-user',['id' => $id])->with("message","Edit Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user')->with('message','Deleted Successfully');
    }

    public function getLogin(){
        return view('admin.pages.login');
    }
    public function postLogin(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ],[
            'email.required' => "This email field can't empty",
            'email.email' => "Please enter valid email format ",
            'password.required' => "This password field can't empty",
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login')->with('message',"Email or Password not correct");
        }

    }
    public function getLogout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
