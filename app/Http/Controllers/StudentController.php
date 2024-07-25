<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentformRequest;
use App\Models\student;
use App\Models\teacher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function dashboard(){
       $output= student::join('teachers','students.class_teacher_id','=','teachers.teacher_id')
       ->select('teachers.teacher_name','students.student_name','students.class','students.id' )->get()->toArray();
       $teacehr = teacher::get()->toArray();
        
        return view('dashboard' ,compact('output','teacehr'));
    }



    public function  form(){
            $data=teacher::get()->toArray();
            
        return view('form',compact('data'));
    }

    public function  insert(StudentformRequest $request){
       
       
        $data= new student();
        $data->student_name=       $request->student_name;
        $data->class=         $request->class;
        $data->admission_date=        $request->addmision_date;
        $data->Yearly_fees=        $request->anual_fees;
        $data->class_teacher_id=        $request->teacher_name;
        $data->save();
        if($data){
            return response()->json(['status'=>true]);
        }else{
            return response()->json(['status'=>false]);
        }

    } 
    
    
    public function delete($id){
            $data=student::find($id);
            $data->delete();
            return redirect()->back();
    }

    public function edit(Request $request){

        $output= student::join('teachers','students.class_teacher_id','=','teachers.teacher_id')
        ->select('teachers.teacher_name','students.student_name','students.class','students.Yearly_fees','students.admission_date','teachers.teacher_id','students.id' )->where('students.id',$request->id)->get()->toArray();
        
        if($output){
            return response()->json(['data'=>$output,'status'=>true]);
        }else{
            return response()->json(['status'=>false]);

        }
    }

    public  function update(StudentformRequest $request){
        
        $data=[ 
       "student_name"=>      $request->student_name,
        'class'=>        strtoupper($request->class),
        'admission_date'=>        $request->addmision_date,
        'Yearly_fees'=>        $request->anual_fees,
        'class_teacher_id'=>        $request->teacher_name   
        ];    
       $output= student::where('id',$request->row_id)->update($data);
        if($output){
            return response()->json(['status'=>true]);
        }else{
            return response()->json(['status'=>false]);
        }
    }
}
