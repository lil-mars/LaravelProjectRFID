@extends('layout')

@section('content')
    <div class="container">
        <div>
            <div class="">
                <a href="../" class="btn btn-primary btn-block">Retornar</a>
            </div>
            <div>
                <h1>{{ $empleado->fullName()}}</h1>
                <h1>{{ $empleado->cargo->nombre}}</h1>
            </div>
            @php
                $var = 0
            @endphp
            <br>
            <div>
                <form method="post" action="{{ route('empleados.update', $empleado->idEmpleado)}}">
                    @method('PATCH')
                    @csrf
                    <label>Fecha Inicio</label>
                    <input name="fechaInicio" type="date">
                    <label>Fecha Final</label>
                    <input name="fechaFin" type="date">
                    <input value="Enviar" type="submit">
                </form>
            </div>
            <div class="panel-body">
                {!! $calendar->calendar() !!}
            </div>
            @foreach($asistencias as $key => $value)
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th> {{$empleado->cargo->nombre }} </th>
                        <th> {{$empleado->weekday($key) }} - {{ $key }} </th>
                    </tr>
                    <tr>
                        <th> {{$empleado->fullName() }} </th>
                        <th> Entrada</th>
                        <th> Salida</th>
                        <th> Total Horas</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($value as $item)
                        <tr>
                            <td></td>
                            <td> {{  $item -> horaEntrada}} </td>
                            <td> {{  $item -> horaSalida}} </td>
                            <td> {{  $item -> horasDeTrabajo}} </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">TOTAL</td>
                        @if($value->sum('horasDeTrabajo') < 8)
                            <td class="btn btn-warning">  {{ $value->sum('horasDeTrabajo') }} </td>
                        @else
                            <td>  {{ $value->sum('horasDeTrabajo') }} </td>
                        @endif
                    </tr>
                    </tbody>
                </table>
            @endforeach
            <br>
        </div>
    </div>
@endsection
@section('script')

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/fullcalendar.min.js')}}"></script>


    {!! $calendar->script() !!}

@endsection
