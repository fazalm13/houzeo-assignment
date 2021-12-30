<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserBasicDetails;
use Illuminate\Support\Facades\Validator;
use DB;
use DateTime;
use DataTables;

class Property_details extends Controller
{
    public function index()
    {
        return view('property_listing');
    }

    public function list()
    {
        $house = DB::table("assigned_tasks")->leftJoin("property_info",'property_info.house_id','=','assigned_tasks.house_id')->get(['assigned_tasks.id as task_id','assigned_tasks.created_at as assigned_created_at','title']);

        return Datatables::of($house)
                ->addIndexColumn()
                ->make(true);
    }

    public function form_validation()
    {
        return view('form_validation');
    }

    public function store(Request $request)
    {
        // Custom validation function for older than 15 years
        Validator::extend('olderThan', function($attribute, $value, $parameters)
        {
            $minAge = ( ! empty($parameters)) ? (int) $parameters[0] : 15;
            return (new DateTime)->diff(new DateTime($value))->y >= $minAge;
        },'DOB should be more than 15 years from current date!');

        $request->validate([
        'full_name'     => 'required|min:4|regex:/^[A-Za-z\s -]+$/',
        'dob'           => 'required|olderThan:15',
        'email'         => 'required',
        'phone_number'  => 'nullable|min:10',
        ],[
        'full_name.min' => 'Name should consists of min 4 characters!',
        'full_name.regex' => 'Name should consists of alphabets, spaces , hyphens allowed!',
        ]);  

       $userBasicDetails = new UserBasicDetails;
       $userBasicDetails->full_name = $request->full_name;
       $userBasicDetails->email = $request->email;
       $userBasicDetails->phone_number = $request->phone_number;
       $userBasicDetails->dob = $request->dob;
       $userBasicDetails->save();
       dd($userBasicDetails);
    }
}
