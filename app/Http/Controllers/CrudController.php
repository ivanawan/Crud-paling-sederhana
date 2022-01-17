<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CrudController extends Controller
{
    public function index(){
        return view("welcome",[
            'persons'=>DB::table('persons')->get(),
        ]);
    }

    public function Store(Request $request){
        // dd($request->all());
        DB::table('persons')->insert($request->except('_token'));
        return redirect('/');
    }

    public function edit($id){
        return view('forms',[
            'edit'=>DB::table('persons')->where('id',$id)->first()
        ]);
    }
    public function update(Request $request, $id){
        DB::table('persons')->where('id', $id)->update($request->except('_token'));
         return redirect('/'); 
    }
    public function delete($id){
        DB::table('persons')->where('id', $id)->delete();
        return redirect('/');
    }
}
