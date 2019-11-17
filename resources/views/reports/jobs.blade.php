@extends('layout')
@section('search')
    <form method="post" action="{{route('reports.selectJobs')}}">
        @csrf
        <label>Cantidad de empleados</label>
        <input class="input" name="number" type="text">
        <input class="btn btn-danger" value="Enviar"  type="submit">
    </form>
@endsection
@section('content')

    <h1>Lista de Cargos</h1>
    {!!$chart->html() !!}

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Cargo</th>
            <th>Cantidad de empleados</th>
        </tr>
        </thead>
        <tbody>

        @foreach($cargos as $cargo)
            <tr>
                <td>{{$cargo->nombre}}</td>
                <td>{{$cargo->empleados->count()}}</td>
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
