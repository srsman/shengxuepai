@extends('layout')
@section('title')
    提示
@endsection
@section('navbar')
@endsection
@section('main')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3>升学派提示您：</h3>
                </div>
                <div class="panel-body">
                    <p>{!! $info !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            window.setTimeout(function() {
                window.location.href = "{{ $url }}";
            }, 3000)
        })
    </script>
@endsection