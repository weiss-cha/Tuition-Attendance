@extends('app')

@section('content')
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Create Class</h3>
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
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection