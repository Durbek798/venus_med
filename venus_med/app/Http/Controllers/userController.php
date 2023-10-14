<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use File;   

class userController extends Controller
{
    public function index()
    {
        $users= User::all();
        return view('control.users',[
            'users'=>$users
        ]);
        
    }
    public function add(Request $request){
        $photo = time().'.'.$request->photo->extension();  
        $request->photo->move(public_path('userPhotos'), $photo);
        $newUSer = new User();
        $newUSer->name = $_POST['name'];
        $newUSer->email = $_POST['email'];
        $newUSer->password = Hash::make($_POST['password']);
        $newUSer->photo = $photo;
        $newUSer->save();
        return back();
    }
    public function edit(Request $request, $id) {
        $photo = time().'.'.$request->photo->extension();  
        $request->photo->move(public_path('userPhotos'), $photo);
        $user = User::where('id',$id)->first();
        File::delete(public_path('userPhotos/'.$user->photo));
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'photo' => $photo
        ]);
        return 'success';
    }
    public function delete($id){
        $user =  User::where('id', $id)->first();
        File::delete(public_path('userPhotos/'.$user->photo)); // Use '.' for string concatenation
        User::where('id', $id)->delete();
        return back();
    }

    public function admin($id) {
        User::where('id', $id)->update(['admin' => 1]); 
        return back();
    }


}
