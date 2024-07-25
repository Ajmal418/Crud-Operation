<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class StudentformRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * 
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    public function __construct(request $request)
    {
        // dd($request->all());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        return [
            "student_name"=>'required',
            "class" =>'required',
            "anual_fees"=>'required',
            "addmision_date"=>'required',
            "teacher_name"=>'required'
        ];
    }
}
