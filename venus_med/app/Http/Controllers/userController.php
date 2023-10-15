<?php

namespace App\Http\Controllers;

use App\admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use File;
use App\viloyat;
use App\tuman;
use App\kasalxona;

class userController extends Controller
{
    public function profile($id)
    {
        $getUserData = user::where('id', $id)->first();
        $viloyatlar = viloyat::all();
        $tumanlar = tuman::all();
        $kasalxonalar = kasalxona::all();
        return view('control.profile', [
            'getUserData' => $getUserData,
            'viloyatlar'=>$viloyatlar,
            'tumanlar'=>$tumanlar,
            'kasalxonalar'=>$kasalxonalar
        ]);
    }
    public function settings($id)
    {
        $viloyatlar = viloyat::all();
        $tumanlar = tuman::all();
        $kasalxonalar = kasalxona::all();
        $getUserData = user::where('id', $id)->first();
        return view('control.settings', [
            'getUserData' => $getUserData,
            'viloyatlar'=>$viloyatlar,
            'tumanlar'=>$tumanlar,
            'kasalxonalar'=>$kasalxonalar
        ]);
    }
    public function changeUserPhoto(Request $request, $id)
    {
        $user = user::where('id', $id)->first();
        File::delete(public_path('userPhotos/' . $user->photo));

        $photo = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('userPhotos'), $photo);
        user::where('id', $id)->update([
            'photo' => $photo,
        ]);
        return back();
    }
    public function editUserBySettings(Request $request, $id)
    {
        $user = user::where('id', $id)->first();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $user->photo,
            'viloyat_id' => $user->viloyat_id,
            'tuman_id' => $user->tuman_id,
            'kasalxona_id' => $user->kasalxona_id,
        ]);
        return back();
    }
    public function index()
    {
        $users = User::all();
        $admins = admin::all();
        $viloyatlar = viloyat::all();
        $tumanlar = tuman::all();
        $kasalxonalar = kasalxona::all();
        return view('control.users', [
            'viloyatlar' => $viloyatlar,
            'tumanlar' => $tumanlar,
            'kasalxonalar' => $kasalxonalar,
            'users' => $users,
            'admins' => $admins,
        ]);
    }
    public function addViloyatAdmin(Request $request)
    {
        $photo = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('userPhotos'), $photo);
        $newUSer = new User();
        $newUSer->name = $_POST['name'];
        $newUSer->email = $_POST['email'];
        $newUSer->admin = 2;
        $newUSer->password = Hash::make($_POST['password']);
        $newUSer->photo = $photo;
        $newUSer->viloyat_id = $_POST['viloyat_id'];
        $newUSer->save();
        return back();
    }
    public function addTumanAdmin(Request $request)
    {
        $photo = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('userPhotos'), $photo);
        $newUSer = new User();
        $newUSer->name = $_POST['name'];
        $newUSer->email = $_POST['email'];
        $newUSer->admin = 3;
        $newUSer->password = Hash::make($_POST['password']);
        $newUSer->photo = $photo;
        $newUSer->viloyat_id = $_POST['viloyat_id'];
        $newUSer->tuman_id = $_POST['tuman_id'];
        $newUSer->save();
        return back();
    }
    public function addKasalxonaAdmin(Request $request)
    {
        $photo = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('userPhotos'), $photo);
        $newUSer = new User();
        $newUSer->name = $_POST['name'];
        $newUSer->email = $_POST['email'];
        $newUSer->admin = 4;
        $newUSer->password = Hash::make($_POST['password']);
        $newUSer->photo = $photo;
        $newUSer->viloyat_id = $_POST['viloyat_id'];
        $newUSer->tuman_id = $_POST['tuman_id'];
        $newUSer->kasalxona_id = $_POST['kasalxona_id'];
        $newUSer->save();
        return back();
    }

    public function edit(Request $request, $id)
    {

        $user = user::where('id', $id)->first();
        File::delete(public_path('userPhotos/' . $user->photo));
        $photo = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('userPhotos'), $photo);
        user::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $photo,
            'viloyat_id' => $user->viloyat_id,
            'tuman_id' => $user->tuman_id,
            'kasalxona_id' => $user->kasalxona_id,
        ]);
        return back();
    }
    public function delete($id)
    {
        $user = User::where('id', $id)->first();
        File::delete(public_path('userPhotos/' . $user->photo)); // Use '.' for string concatenation
        User::where('id', $id)->delete();
        return back();
    }

    public function admin($id)
    {
        User::where('id', $id)->update(['admin' => 1]);
        return back();
    }
}
