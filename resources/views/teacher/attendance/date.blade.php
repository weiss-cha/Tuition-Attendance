@extends('app2')

@section('content')
<main class="signup-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h4 class="card-header text-center">Check Record</h4>
                    <div class="card-body">
                        <form action="{{ route('check.attendance') }}" method="ANY">    
                            <label>Choose Date:</label>
                            <input type="date" name="date">
                            <input type="hidden" id="class" name="class" value="{{$class}}">
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