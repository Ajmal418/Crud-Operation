@extends('layouts.app')
@section('content')
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </div>
    </header>


    {{-- <div class="py-12 border border-danger">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <button class="btn btn-primary"><a href="{{ route('form') }}">Add Student</a></button>
                </div>
            </div>
            <div class="m-1 p-1">
                <table class="table" id='student_details'>
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Class</th>
                            <th>Teacher Name</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($output as $item)
                            <tr>
                                <td>{{ $item['student_name'] }}</td>
                                <td>{{ $item['class'] }}</td>
                                <td>{{ $item['teacher_name'] }}</td>
                                <td>
                                    <div class="d-flex  justify-content-center ">
                                        <div><button class="btn btn-primary"><a
                                                    href="{{ route('edit', $item['id']) }}">Edit</a></button></div>
                                        <div><button class="btn btn-primary mx-2"><a
                                                    href="{{ route('delete', $item['id']) }}">Delete</a></button></div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}
    <div class="py-12 border">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="col border-1">
        <div class="p-6 bg-white border-b border-gray-200">
            <button class="btn btn-primary"><a href="{{ route('form') }}">Add Student</a></button>
        </div>
        <div class="m-1 p-1 overflow-auto">
            <table class="table table-sm" id='student_details'>
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Teacher Name</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($output as $item)
                        <tr>
                            <td>{{ $item['student_name'] }}</td>
                            <td>{{ $item['class'] }}</td>
                            <td>{{ $item['teacher_name'] }}</td>
                            <td class="text-nowrap text-center">
                                <button class="btn btn-primary edit" data-bs-target="#Modal" data-bs-toggle="modal" data="{{$item['id']}}" >Edit</button>
                                <button class="btn btn-danger ms-1"><a
                                        href="{{ route('delete', $item['id']) }}">Delete</a></button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
        </div>
    </div>
    {{-- modal --}}
    <!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" id="submit">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3">
                    <div class="col">
                        <input type="text" class="form-control" id="student_name" name="student_name" value="" placeholder="full name of the  student" aria-label="First name" >
                        <span class="d-none text-danger" id="student_name_error"></span>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="class" name="class" placeholder="class Name" aria-label="Last name" >
                        <span class="d-none text-danger" id="class_error"></span>
                    </div>
                    <div class="col">
                        <input type="number" max="50000" class="form-control" id="anual_fees" name="anual_fees" placeholder="anual fees" aria-label="Last name" >
                        <span class="d-none text-danger" id="anual_fees_error"></span>
                    </div>
                    <div class="col ">
                        <input type="date" class="form-control" id="addmision_date" name="addmision_date" placeholder="addminsion_date" aria-label="Last name" >
                        <span class="d-none text-danger" id="addmision_date_error"></span>
                    </div>
                    {{-- <div class="col ">
                        <button type="submit" class="btn btn-primary " >submit</button>
                    </div> --}}
                    <div class="col col-12">
                        <select class="form-select input-lg" id="teacher"  aria-label="Default select example" aria-placeholder="select your class teacher">
                            <option value="">testing</option>  
                            @foreach ($teacehr as $key=>$val)
                            <option value="{{$val['teacher_id']}}">{{$val['teacher_name']}}</option>                           
                            @endforeach                           
                                                  
                        </select>
                        <span class="d-none text-danger" id="teacher_error"></span>
                        <input type="hidden" id="row_id" value="">
                    </div> 
                </div>
                <div class="modal-footer mt-4">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

    <script src="https://cdn.datatables.net/2.1.0/js/dataTables.js"></script>
    <script>
        // let table = new DataTable('#student_details', {
        $('#student_details').dataTable({
            responsive: true,
            searching: true,
            "bAutoWidth": false,
            "aoColumns": [{
                    sWidth: "30%"
                },
                {
                    sWidth: "10%"
                },
                {
                    sWidth: "30%"
                },
                {
                    sWidth: "30%"
                }
            ]
        });

        $('.edit').on('click', function(){
            id=$(this).attr('data')
            $.ajax({
                url: "{{ route('edit') }}",
                type: "post",
                dataType: "json",
                headers: {
                    'X_CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "id": id
                    
                },
                success: (response) => {
                        if(response.status=true){
                                output=response.data[0];
                              
                            $('#student_name').val(output.student_name)
                            $('#class').val(output.class)
                            $('#anual_fees').val(output.Yearly_fees)
                            $('#addmision_date').val(output.admission_date)
                            $('#row_id').val(output.id)
                            $('#teacher').val(output.teacher_id).prop('selected',true)
                        }else{
                           swal.fire({
                            icon:"error",
                            title: "Oops...",
                            text:"Something went wrong!"
                           })
                        }
                },
                error: (error) => {
                }
        });

    });

        $("#submit").submit(function(e) {
            e.preventDefault();
            const student_name = $('#student_name').val()
            const student_class = $('#class').val()
            const anual_fees = $('#anual_fees').val()
            const addmision_date = $('#addmision_date').val()
           const  row_id=$('#row_id').val()
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
                url: "{{ route('update') }}",
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
                    "row_id": row_id,
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
{{-- </x-app-layout> --}}
