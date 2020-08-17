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


    private function unitNameExists($unitName){
        $unit = Unit::where(
            'unit_name','=',$unitName
        )->first();
        if(!is_null($unit)){
            Session::flash('message','Unit Name ('.$unitName.') already exists');
            return false ;

        }
        return true ;
    }


    private function unitCodeExists($unitCode){
        $unit = Unit::where(
            'unit_code','=',$unitCode
        )->first();
        if(!is_null($unit)){
            Session::flash('message','Unit Code ('.$unitCode.') already exists');
            return false ;

        }
        return true ;
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_name' => 'required',
            'unit_code' => 'required'
        ]);


        $unitName = $request->input('unit_name');
        $unitCode = $request->input('unit_code');



        if(!$this->unitNameExists($unitName)){
            return redirect()->back();
        }
        if(!$this->unitCodeExists($unitCode)){
            return redirect()->back();
        }

        $unit = new  Unit();
        $unit->unit_name = $request->input('unit_name');
        $unit->unit_code = $request->input('unit_code');
        $unit->save();
        Session::flash('message','Unit'.$unit->unit_name.'has been added');

        return redirect()->back();

    }










    public function update(Request $request){


        $request->validate([
            'unit_name'=>'required',
            'unit_code'=>'required',
            'unit_id'=>'required',
        ]);

        $unitName = $request->input('unit_name');
        $unitCode = $request->input('unit_code');



        if(!$this->unitNameExists($unitName)){
            return redirect()->back();
        }
        if(!$this->unitCodeExists($unitCode)){
            return redirect()->back();
        }

        $unitID = intval($request->input('unit_id'));
        $unit = Unit::find($unitID);



        $unit->unit_name = $request->input('unit_name');
        $unit->unit_code = $request->input('unit_code');

        $unit->save() ;

        Session::flash('message', 'Unit' . $unit->unit_name . ' has been updated');
        return redirect()->back();







    }

    public function delete(Request $request){

        if (is_null($request->input('unit_id')) || empty($request->input('unit_id'))) {
            Session::flash('message', 'Unit ID required');
            return redirect()->back();


        }
        $id = $request->input('unit_id') ;
        Unit::destroy($id) ;
        Session::flash('message','Unit has been deleted');
        return redirect()->back();


    }


}
