@extends('app')

@section('content')
<main class="signup-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h4 class="card-header text-center">Add Teacher</h4>
                    <div class="card-body">

                        @if(\Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{ \Session::get('success') }}</p>
                            </div>
                        @endif
                        
                        <form action="{{ route('teacher.custom') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Name" id="name" class="form-control" name="name"
                                    required autofocus>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email_address" class="form-control"
                                    name="email" required autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" id="password" class="form-control"
                                    name="password" required>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Add</button>
                            </div>
                        </form>
                    </div>
                </div>    
                &nbsp;
                <div class="card">    
                    <h4 class="card-header text-center">Remove Teacher</h4>
                    <div class="card-body">
                        <form method="ANY" action="{{ route('teacher.remove') }}">
                            <label>Select Teacher to Remove:</label>
                            <select name="teacher_2" id="id" class="form control input -sm">
                                @foreach ($userList as $item)
                                    <option>{{$item->name}}</option>
                                @endforeach
                            </select>
                            <hr>
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