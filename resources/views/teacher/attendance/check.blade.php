@extends('app2')

@section('content')
<main class="signup-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
  
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 align="center">Student List</h3>
                                    <br>
                                    <table class="table table-bordered table-striped">
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>{{$date}}</th>
                                            </tr>
                                            
     
                                            @foreach($attendance_array as $row)
                                            <tr>
                                                
                                                <td>{{$row['id']}}</td>
                                                <td>{{$row['student_name']}}</td>             
                                                <td><?php echo $row["{$date}"]; ?></td>
                                            </tr>
                                            @endforeach


                                    </table>
                                </div>
                            </div>

                    </div>
                </div>    
            </div>
        </div>
    </div>
</main>
@endsection