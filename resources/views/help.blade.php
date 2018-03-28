@extends('layout')
@section('main')
    <div class="row">
        <div class="col-md-12">
            <iframe src="{{ URL::asset('file/teach1.pdf') }}" width="100%" height="800px"/>
        </div>
    </div>
@endsection