<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::all();
        return response()->json( $forms ,201);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:forms'],
            'photo' => ['required', 'image', 'max:3000'],
            'gender' => ['required', 'numeric', 'integer'],
            'skills' => ['required', 'string', 'max:255'],
        ]);

        // return response()->json($request->photo, 201);

        //get filename with extension
        $filenameWithExt = $request->file('photo')->getClientOriginalName();
        //get just file name (using standard php function)
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //get just extension
        $extension = $request->file('photo')->getClientOriginalExtension();
        //filename to store(uses a time php function to get current time)
        //this string is a unique name so that file with duplicate name do not get uploaded and
        //cause problems when viewing(same problem that occured in CISV photo gallery)
        $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);
        //upload image
        $request->file('photo')->storeAs('public/images', $filenameToStore);

        if($request->gender == 1){
            $gender = 'male';
        }
        elseif($request->gender == 2){
            $gender = 'female';
        }
        elseif($request->gender == 3){
            $gender = 'other';
        }

        Form::Create([
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $filenameToStore,
            'gender' => $gender,
            'skills' => $request->skills,
        ]);

        return response()->json( "Form Created !!" ,201);
    }

    public function show($id)
    {
        $form = Form::find($id);

        if($form){
            $form->skills = explode(",", $form->skills );
            return response()->json( $form ,201);
        }

        return response()->json( "Form Data Not Found !!" ,404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email'],
            'photo' => ['required', 'image', 'max:3000'],
            'gender' => ['required', 'numeric', 'integer'],
            'skills' => ['required', 'string', 'max:255'],
        ]);
        
        //get filename with extension
        $filenameWithExt = $request->file('photo')->getClientOriginalName();
        //get just file name (using standard php function)
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //get just extension
        $extension = $request->file('photo')->getClientOriginalExtension();
        //filename to store(uses a time php function to get current time)
        //this string is a unique name so that file with duplicate name do not get uploaded and
        //cause problems when viewing(same problem that occured in CISV photo gallery)
        $filenameToStore= $filename.'_'.time().'.'.Str::lower($extension);
        //upload image
        $request->file('photo')->storeAs('public/images', $filenameToStore);

        if($request->gender == 1){
            $gender = 'male';
        }
        elseif($request->gender == 2){
            $gender = 'female';
        }
        elseif($request->gender == 3){
            $gender = 'other';
        }

        $form = Form::find($id);
        if($form){
            $form->name = $request->name;
            $form->email = $request->email;
            if($request->hasFile('photo')){  //works if there is a new image uploaded
                Storage::delete('public/images/'.$form->photo);  //deletes previous file
            }
            $form->photo = $filenameToStore;
            $form->gender = $gender;
            $form->skills = $request->skills;
            $form->save();
            return response()->json( "Form Updated Successfully !!" ,201);
        }

        return response()->json('The Provided ID doesn\'t match any Form Records !!', 404);
    }

    public function destroy($id)
    {
        $form = Form::find($id);
        if($form){            
            $form->delete();
            return response()->json( "Form Deleted Successfully !!" ,201);
        }

        return response()->json('The Provided ID doesn\'t match any Form Data !!', 404);
    }
}