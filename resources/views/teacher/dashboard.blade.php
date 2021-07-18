@extends('app2')

@section('content')
<main class="signup-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h4 class="card-header text-center">Attendance</h4>
                    <div class="card-body">

                        @if(\Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{ \Session::get('success') }}</p>
                            </div>
                        @endif
                        
                        <form action="{{ route('custom.attendance') }}" method="ANY">
                            <label>Select Class:</label>
                            <select name="class" id="id" class="form control input -sm">
                                @foreach ($classList as $item)
                                    <option>{{$item->class_name}}</option>
                                @endforeach
                            </select>
                            <hr>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</main>
@endsection