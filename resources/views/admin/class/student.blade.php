@extends('app')

@section('content')
<main class="signup-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h4 class="card-header text-center">Register Student</h4>
                    <div class="card-body">

                        @if(\Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{ \Session::get('success') }}</p>
                            </div>
                        @endif
                        
                        <form action="{{ route('custom.student') }}" method="ANY">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Class Name" id="class_name" class="form-control" name="class_name" required
                                    autofocus>
                                @if ($errors->has('class_name'))
                                <span class="text-danger">{{ $errors->first('class_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Student Name" id="student_name" class="form-control" name="student_name"
                                    required autofocus>
                                @if ($errors->has('student_name'))
                                <span class="text-danger">{{ $errors->first('student_name') }}</span>
                                @endif
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Register</button>
                            </div>
                        </form>
                    </div>
                </div>    
                &nbsp;
                <div class="card">    
                    <h4 class="card-header text-center">Remove Student</h4>
                    <div class="card-body">
                        <form method="ANY" action="{{ route('remove.student') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Class Name" id="class_name_2" class="form-control" name="class_name_2" required
                                    autofocus>
                                @if ($errors->has('class_name_2'))
                                <span class="text-danger">{{ $errors->first('class_name_2') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Student Name" id="student_name_2" class="form-control" name="student_name_2" required
                                    autofocus>
                                @if ($errors->has('student_name_2'))
                                <span class="text-danger">{{ $errors->first('student_name_2') }}</span>
                                @endif
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Remove</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection