<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;

class SchoolManagementController extends Controller
{
    public function addSchoolForm()
    {
        return view('admin.settings.school.add-form');
    }

    public function schoolSave(Request $request)
    {
        $this->validate($request, [
            'school_name'=>'required|string'
        ]);

        $data = new School();
        $data->school_name = $request->school_name;
        $data->status = 1;
        $data->save();

        return back()->with('message', 'School Added Successfully');
    }

    public function schoolList()
    {
        $schools = School::all();
        return view('admin.settings.school.list', ['schools'=>$schools]);
    }

    public function schoolUnpublished($id)
    {
        $school = School::find($id);
        $school->status = 2;
        $school->save();

        return redirect('/school/list')->with('message', 'Shcool has been unpublished.');
    }

    public function schoolPublished($id)
    {
        $school = School::find($id);
        $school->status = 1;
        $school->save();

        return redirect('/school/list')->with('message', 'Shcool has been Published.');
    }

    public function schoolEditForm($id)
    {
        $school = School::find($id);

        return view('admin.settings.school.edit-form', ['school'=>$school]);
    }

    public function schoolUpdate(Request $request)
    {
        $this->validate($request, [
            'school_name'=>'required|string'
        ]);

        $school = School::find($request->school_id);
        $school->school_name = $request->school_name;
        $school->save();

        return redirect('/school/list')->with('message', 'Shcool Name Update Successfull.');
    }
    public function schoolDelete($id)
    {
        $school = School::find($id);
        $school->delete();

        return redirect('/school/list')->with('message', 'Shcool was Deleted.');
    }
}
