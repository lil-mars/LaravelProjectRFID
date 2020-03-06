@extends('layout')
@section('content')
    <h1>Lista de empleados segun edad (mayor a menor)</h1>
    {!!$chart->html() !!}
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Edad</th>
            <th>Cantidad de empleados</th>
        </tr>
        </thead>
        <tbody>
        @foreach($filteredEmployees as $employee => $col)
            <tr>
                <td>{{$employee}}</td>
                <td>{{$col->count()}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
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