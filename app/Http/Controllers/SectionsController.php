<?php

namespace App\Http\Controllers;
use App\Models\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;


class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //select All sections from sections table using elquoant
        $sections=sections::all();
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // request sent from the form to add new section
        //the request has name and description
        $input = $request->all();

        //check if the section is exists or not
        //if exists variable has the answer of the condition
//        $if_exist=Sections::where('name','=',$input["name"])->exists();
//        if($if_exist){
//            //if the section is exists then the controller can not add an exists one so it is error
//            session()->flash('Error','القسم مسجل بالفعل');
//            //then return to the view
//            return redirect('/sections');
//        }else{
//            //if is not exists it will add the new one
//            sections::create([
//                'name'=>$request->name,
//                'description'=>$request->description,
//                'created_by'=>(Auth::user()->name)
//            ]);
//
//            //flash mean to inform user that the new section was added
//            session()->flash('Add','تمت اضافة القسم بنجاح');
//            return redirect('/sections');
//        }


//        laravel validation
        $validated = $request->validate([
            'name' => 'required|unique:sections|max:255',
            'description' => 'required|max:255'
        ],[
            'name.required' => 'يرجي ادخال اسم القسم',
            'name.unique' => 'هذا القسم موجود بالفعل',
            'description.required' => 'يرجي ادخال الوصف'
        ]);

        sections::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'created_by'=>(Auth::user()->name)
        ]);

        return redirect('/sections');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(Sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request ,$id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
//        return 'Hello';

//        validation
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255'
        ],[
            'name.required' => 'يرجي ادخال اسم القسم',
            'description.required' => 'يرجي ادخال الوصف'
        ]);

        $section = Sections::findOrFail($id);
        $section->update($validated);
        return redirect()->route('sections.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Sections::findOrFail($id);
        $section->delete();
        return redirect()->route('sections.index');
    }
}
