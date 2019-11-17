@extends('layout')

@section('content')

    <h1>Lista de empleados de los ultimos 3 anos</h1>
    {!!$chart->html() !!}


@endsection
@section('script')
    {!! Charts::scripts() !!}
    <script src="{{ asset('js/printThis.js') }}"></script>
    <script>
        $('#basic').on("click", function () {
            $('#report').printThis();
        });
    </script>
    {!! $chart->script() !!}
@endsection
