<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();

        return view('welcome', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('registration');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => "required|max:255|regex:/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/u",
            'b_date' => 'required|date|before:tomorrow',
            'gender' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:students',
            'phone' => ['required', 'min:11', 'max:11', 'regex:/^[0-9]*$/'],
            'interest' => 'nullable',
            'batch' => 'required',
            'course' => 'required',
            'p_hour' => 'required|numeric|between:1,24',
            'image' =>'nullable|max:5120',
            'cv' => 'required|max:2048',
        ],
        [
            'p_hour.required' => 'The practice hours is required',
        ]
        );
        if($request->file('image')) {
            $path = public_path('upload/images');

            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
            
            $file = $request->file('image');
            $filename = uniqid().".".$file->extension();
            $file->move($path, $filename);
            $validated['image'] = $filename;
        }
        if($request->file('cv')) {
            $path = public_path('upload/cvs');

            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
            
            $file = $request->file('cv');
            $filename = uniqid().".".$file->extension();
            $file->move($path, $filename);
            $validated['cv'] = $filename;
        }

        Student::create($validated);
        return redirect()->route('student.index')->with('success', 'Student Register Succcessfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        // dd(json_encode($student->interest));
        return view('edit', compact('student'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => "required|max:255|regex:/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/u",
            'b_date' => 'required|date|before:tomorrow',
            'gender' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:students,email,' .$student->id,
            'phone' => ['required', 'min:11', 'max:11', 'regex:/^[0-9]*$/'],
            'interest' => 'nullable',
            'batch' => 'required',
            'course' => 'required',
            'p_hour' => 'required|numeric|between:1,24',
            'image' =>'nullable|max:5120',
            'cv' => 'max:2048',
        ],
        [
            'p_hour.required' => 'The practice hours is required',
        ]
        );
        if($request->file('image')) {
            if($student->image){
                $path = public_path('upload/images/');
                $image = $path.$student->image;
                // dd($image);
                unlink($image);
            }

            $path = public_path('upload/images');
            $file = $request->file('image');
            $filename = uniqid().".".$file->extension();
            $file->move($path, $filename);
            $validated['image'] = $filename;
        }
        if($request->file('cv')) {
            $path = public_path('upload/cvs/');
            $cv = $path.$student->cv;
            dd($cv);
            unlink($cv);
                        
            $file = $request->file('cv');
            $filename = uniqid().".".$file->extension();
            $file->move($path, $filename);
            $validated['cv'] = $filename;
        }

        $student->update($validated);
        return redirect()->route('student.index')->with('success', 'Updated Succcessfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        // Student::find($id)->delete();
        // Student::destroy($id);
        
        $path = public_path('upload/');
        $cv = $path."cvs/".$student->cv;
        // dd($image);
        $student->delete();
        if($student->image){
            $image = $path."images/".$student->image;
            unlink($image);
        }
        unlink($cv);
        return redirect()->route('student.index')->with('error', 'Deleted successfully!');
    }
}
