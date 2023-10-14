<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\viloyat;
use App\tuman;
use App\kasalxona;
use App\User;

class regionController extends Controller
{
    public function viloyat(){
        $viloyats = viloyat::all();
        // $tumans = tuman::all();
        // $kasalxonas = kasalxona::all();

        return view('regions.viloyat', [
            'viloyats'=>$viloyats
            // 'tumans'=>$tumans,
            // 'kasalxonas'=>$kasalxonas
        ]);
    }
    public function addViloyat(){
        $new = new viloyat();
        $new->name = $_POST['name'];
        $new->save();
        return back();
    }
    public function editViloyat(Request $request, $id){
        viloyat::where('id',$id)->update([
            "name" =>$request->name
        ]);
        return back();
    }



    public function tuman(){
        $viloyats = viloyat::all();
        $tumans = tuman::all();
        // $kasalxonas = kasalxona::all();

        return view('regions.tuman', [
            'viloyats'=>$viloyats,
            'viloyatlar'=>$viloyats,
            'tumans'=>$tumans
            // 'kasalxonas'=>$kasalxonas
        ]);
    }
    public function addTuman(){
        $new = new tuman();
        $new->viloyat_id = $_POST['viloyat_id'];
        $new->name = $_POST['name'];
        $new->save();
        return back();
    }
    public function editTuman(Request $request, $id){
        tuman::where('id',$id)->update([
            "viloyat_id" =>$request->viloyat_id,
            "name" =>$request->name
        ]);
        return back();
    }
    

    public function kasalxona(){
        $viloyats = viloyat::all();
        $tumans = tuman::all();
        $kasalxonas = kasalxona::all();

        return view('regions.kasalxona', [
            'viloyats'=>$viloyats,
            'tumans'=>$tumans,
            'kasalxonas'=>$kasalxonas
        ]);
    }
    public function addKasalxona(){
        $new = new kasalxona();
        $new->viloyat_id = $_POST['viloyat_id'];
        $new->tuman_id = $_POST['tuman_id'];
        $new->name = $_POST['name'];
        $new->save();
        return back();
    }
    public function editKasalxona(Request $request, $id){

        kasalxona::where('id',$id)->update([
            "viloyat_id" =>$request->viloyat_id,
            "tuman_id" =>$request->tuman_id,
            "name" =>$request->name
        ]);
        return back();
    }
    public function deleteKasalxona($id){
        kasalxona::where('id',$id)->delete();
        return back();
    }

}
