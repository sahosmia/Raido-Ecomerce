<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        echo "bangladesh";
    }

    // profile update
    public function profile_update(Request $req)
    {
        $btn_name = $req->btn_name;
        $id = Auth::id();
        $name = $req->name;
        $email = $req->email;
        $address = $req->address;
        $facebook = $req->facebook;
        $instragram = $req->instragram;
        $twitter = $req->twitter;
        $linkedin = $req->linkedin;
        $blood = $req->blood;
        $phone = $req->phone;
        $old_password = $req->old_password;
        $password = $req->password;
        $confirmation_password = $req->confirmation_password;
        if ($btn_name == "all") {
            User::find($id)->update([
                'name' => $name,
                'email' => $email,
            ]);

            if ($address) {
                User::find($id)->update([
                    'address' => $address,
                ]);
            }
            if ($facebook) {
                User::find($id)->update([
                    'facebook' => $facebook,
                ]);
            }
            if ($instragram) {
                User::find($id)->update([
                    'instragram' => $instragram,
                ]);
            }
            if ($twitter) {
                User::find($id)->update([
                    'twitter' => $twitter,
                ]);
            }
            if ($linkedin) {
                User::find($id)->update([
                    'linkedin' => $linkedin,
                ]);
            }
            if ($blood) {
                User::find($id)->update([
                    'blood' => $blood,
                ]);
            }
            if ($phone) {
                User::find($id)->update([
                    'phone' => $phone,
                ]);
            }
            return back()->with('success', 'you are success to update your profile');
        } else {
            if (Hash::check($old_password, Auth::user()->password)) {
                User::find($id)->update([
                    'password' => bcrypt($password),
                ]);
                return back()->with('password_success', 'you are success to update your profile');
            } else {
                return back()->with('error', 'you password does not match with old password');
            }
        }
    }




    // front_profile
    public function front_profile()
    {
        return view('frontend.profile.profile');
    }

    // front_dashboard
    public function front_dashboard()
    {
        echo "bangladesh";
    }
}
