@extends('layouts.app')
@section('content')
    <style>

    </style>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ADD STUDENT
            </h2>
        </div>
    </header>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="" id="submit">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3">
                    <div class="col">
                        <input type="text" class="form-control" id="student_name" name="student_name"
                            placeholder="full name of the  student" aria-label="First name">
                        <span class="d-none text-danger" id="student_name_error"></span>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="class" name="class" placeholder="class Name"
                            aria-label="Last name">
                        <span class="d-none text-danger" id="class_error"></span>
                    </div>
                    <div class="col">
                        <input type="number" max="50000" class="form-control" id="anual_fees" name="anual_fees"
                            placeholder="anual fees" aria-label="Last name">
                        <span class="d-none text-danger" id="anual_fees_error"></span>
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" id="addmision_date" name="addmision_date"
                            placeholder="addminsion_date" aria-label="Last name">
                        <span class="d-none text-danger" id="addmision_date_error"></span>
                    </div>
                    <div class="col ">
                        <button type="submit" class="btn btn-primary ">submit</button>
                    </div>
                    <div class="col">
                        <select class="form-select input-lg" id="teacher" aria-label="Default select example"
                            aria-placeholder="select your class teacher">
                            <option > please select the teacher</option>
                            @foreach ($data as $key => $val)
                                <option value="{{ $val['teacher_id'] }}">{{ $val['teacher_name'] }}</option>
                            @endforeach
                        </select>
                        <span class="d-none text-danger" id="teacher_error"></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $("#submit").submit(function(e) {
            e.preventDefault();
            const student_name = $('#student_name').val()
            const student_class = $('#class').val()
            const anual_fees = $('#anual_fees').val()
            const addmision_date = $('#addmision_date').val()
            const teacher_name = $('#teacher').find(":selected").val()
         
            if(student_name==""){
                $('#student_name_error').removeClass('d-none')
                $('#student_name_error').text('please insert the student name')

                return false
            }
            if(student_class==""){
                $('#class_error').removeClass('d-none')
                $('#class_error').text('please insert the class')

                return false
            }
            if(anual_fees==""){
                $('#anual_fees_error').removeClass('d-none')
                $('#anual_fees_error').text('please insert the anual_fees')

                return false
            }
            if(teacher_name==""){
                $('#teacher_name_error').removeClass('d-none')
                $('#teacher_name_error').text('please select the teacher')

                return false
            }
            if(addmision_date==""){
                $('#addmision_date_error').removeClass('d-none')
                $('#addmision_date_error').text('please select the teacher')

                return false
            }
            $.ajax({
                url: "{{ route('insert') }}",
                type: "post",
                dataType: "json",
                headers: {
                    'X_CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "student_name": student_name,
                    "class": student_class,
                    "anual_fees": anual_fees,
                    "addmision_date": addmision_date,
                    "teacher_name": teacher_name
                },
                success: (response) => {
                        if(response.status==true){
                            swal.fire({
                                title: "success",
                                text: "student successfully adds",
                                icon: "success"

                            }).then(()=>{
                                    window.location="{{route('dashboard')}}"  
                            });
                        }else{
                            swal.fire({
                            icon:"error",
                            title: "Oops...",
                            text:"Something went wrong!"
                           })
                        }
                },
                error: (error) => {

                    if (error.status == 422) {
                        $.each(error.responseJSON.errors, function(key, value) {

                            $(`#${key}_error`).removeClass('d-none');
                            $(`#${key}_error`).text(value);


                        });
                    }
                }
            })

        });
    </script>
@endsection
