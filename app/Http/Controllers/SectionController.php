<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sections=Section::all();
        return view('sections.sections',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validateData=$request->validate([
            'section_name'=>'required|unique:sections',
            'description'=>'required'
                ]
        ,['section_name.required'=>'يرجي ادخال اسم القسم',
            'section_name.unique'=>'اسم القسم موجود مسبقا',
                'description.required'=>'يرجي ادخال الوصف']
        );
/*
        $input=$request->all();
        $db_exist=Section::where('section_name',$input['section_name'])->exists();
        if($db_exist){
            session()->flash('Error','خطا القسم موجود مسبقا');
            return redirect()->route('sections.index');

        }
        else {
            Section::create([
                'section_name' => $request->section_name,
                'description' => $request->description,
                'Created_by' => (Auth::user()->name)
            ]);
            session()->flash('Add','تم اضافة القسم بنجاح');
            return redirect()->route('sections.index');
        }
*/
Section::create([
                'section_name' => $request->section_name,
                'description' => $request->description,
                'Created_by' => (Auth::user()->name)
            ]);
        session()->flash('Add','تم اضافة القسم بنجاح');
        return redirect()->route('sections.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $section=Section::findOrFail($id);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $sections
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $sections)
    {

        $id= $request->id;
        $this->validate($request,[
            'section_name'=>'required|unique:sections',
            'description'=>'required'

        ],['section_name.required'=>'يرجي ادخال اسم القسم',
            'section_name.unique'=>'اسم القسم موجود مسبقا',
            'description.required'=>'يرجي ادخال الوصف']);
        $sections=Section::findOrFail($id);
        $sections->section_name=$request->section_name;
        $sections->description=$request->description;
        $sections->save();


       session()->flash('edit','تم التعديل بنجاح');
       return redirect()->route('sections.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->id;
        Section::find($id)->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/sections');
    }
}
