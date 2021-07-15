@extends('app')

@section('content')
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h4 class="card-header text-center">Create Class</h4>
                    <div class="card-body">

                        @if(\Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{ \Session::get('success') }}</p>
                            </div>
                        @endif
                        
                        <form method="ANY" action="{{ route('custom.class') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Class Name" id="class_name" class="form-control" name="class_name" required
                                    autofocus>
                                @if ($errors->has('class_name'))
                                <span class="text-danger">{{ $errors->first('class_name') }}</span>
                                @endif
                            </div>
                            <label>Select Teacher to Assign:</label>
                            <select name="teacher" id="id" class="form control input -sm">
                                @foreach ($userList as $item)
                                    <option>{{$item->name}}</option>
                                @endforeach
                            </select>
                            <hr>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
                &nbsp;
                <div class="card">    
                    <h4 class="card-header text-center">Remove Class</h4>
                    <div class="card-body">
                        <form method="ANY" action="{{ route('remove.class') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Class Name" id="class_name_2" class="form-control" name="class_name_2" required
                                    autofocus>
                                @if ($errors->has('class_name_2'))
                                <span class="text-danger">{{ $errors->first('class_name_2') }}</span>
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