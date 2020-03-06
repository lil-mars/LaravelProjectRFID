@extends('layout')
@section('search')
    <form method="post" action="{{route('reports.selectChild')}}">
        @csrf
        <label>Cantidad de hijos</label>
        <input class="form" name="number" type="text">
        <input class="btn btn-primary" value="Enviar" type="submit">
    </form>
@endsection
@section('content')

    <div>
        <h1 class="col">Lista de empleados segun familiares</h1>
    </div>
    {!!$chart->html() !!}
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Empleado</th>
            <th>Cantidad de hijos</th>
        </tr>
        </thead>
        <tbody>
        @foreach($filteredEmployees as $employee)
            <tr>
                <td>{{$employee->fullName()}}</td>
                <td>{{$employee->familiares->where('tipoRelacion','Hijo')->count()}}</td>
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