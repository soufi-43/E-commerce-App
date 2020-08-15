<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UnitController extends Controller
{

    public function index()
    {
        $units = Unit::paginate(env('PAGINATION_COUNT'));
        return view('admin.units.units')->with(['units' => $units
        ]);
    }
    public function search(Request $request){

    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_name' => 'required',
            'unit_code' => 'required'
        ]);

        $unit = new  Unit();
        $unit->unit_name = $request->input('unit_name');
        $unit->unit_code = $request->input('unit_code');
        $unit->save();
        Session::flash('message','Unit'.$unit->unit_name.'has been added');

        return redirect()->back();

    }

    public function update(Request $request){


    }

    public function delete(Request $request){
        $id = $request->input('unit_id') ;
        Unit::destroy($id) ;
        Session::flash('message','Unit has been deleted');
        return redirect()->back();


    }


}
