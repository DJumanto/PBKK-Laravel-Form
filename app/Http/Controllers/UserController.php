<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MahasiswaModel;

class UserController extends Controller
{
    public function index(){
        return view('form');
    }
    public function submitForm(Request $request){
        $userData = $request->validate([
            'name' => 'required|string|max:60',
            'nrp' => 'required|numeric',
            'email' => 'required|string|max:30',
            'phone' => 'required|numeric',
            'gpa' => 'required|numeric|between:2.50,99.99',
            'portrait' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        if($request->hasFile('portrait')) {
            $image = $request->file('portrait');
            $imageFileName = $request->input('nrp');
            $imageName = $imageFileName.'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
        }

        MahasiswaModel::create([
        'name' => $userData['name'],
        'nrp' => $userData['nrp'],
        'email' => $userData['email'],
        'phone' => $userData['phone'],
        'gpa' => $userData['gpa'],
        'portrait' => $imageName,
        ]);

        return redirect('/form')->with(['status' => 'success']);

    }

    public function showUsers(){
        $userResult = MahasiswaModel::all();
        return view
        (
            'show_users',
            [
                'users' => $userResult
            ]
        );
    }
}
