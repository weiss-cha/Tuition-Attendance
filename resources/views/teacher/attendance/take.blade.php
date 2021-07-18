@extends('app2')

@section('content')

<main class="signup-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('date.attendance') }}" method="ANY">
                            <div align = "right">
                                <input type="hidden" id="class" name="class" value="{{$class}}">
                                <button type="submit" class="btn btn-primary">Check Record</button>
                            </div>
                        </form>

                        <form action="{{ route('take.attendance') }}" method="ANY">    
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 align="center">Student List</h3>
                                    <br>
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Attendance</th>
                                        </tr>
                                        @foreach($attendance_array as $row)
                                        <tr>
                                            <td>{{$row['id']}}</td>
                                            <td>{{$row['student_name']}}</td>
                                            <td>
                                                <input type="checkbox" id="student_name" name="student_name[]" value="{{$row['student_name']}}">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>

                                    <div align="right">
                                        <input type="hidden" id="class" name="class" value="{{$class}}">
                                        <button type="submit" class="btn btn-primary">Take Attendance</button>
                                    </div> 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</main>


@endsection
