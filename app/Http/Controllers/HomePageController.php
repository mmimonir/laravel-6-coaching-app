<?php

namespace App\Http\Controllers;

use App\HeaderFooter;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function addHeaderFooterForm()
    {
        return view('admin.home.add-header-footer-form');
    }

    public function headerAndFooterSave(Request $request)
    {
        $this->validate($request, [
            'owner_name'=>'required',
            'owner_department'=>'required',
            'mobile'=>'required',
            'address'=>'required',
            'copyright'=>'required'
        ]);

        $data = new HeaderFooter();
        $data->owner_name = $request->owner_name;
        $data->owner_department = $request->owner_department;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->copyright = $request->copyright;
        $data->status = $request->status;
        $data->save();

        return redirect('/home')->with('message', 'Header & Footer added successfully');
    }
}
