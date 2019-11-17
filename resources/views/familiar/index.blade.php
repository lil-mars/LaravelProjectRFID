@extends('login/layout')
@section('content')
    <div class="container">


        <br>
        <h3>Familiares del empleado: {{ $employee->fullName() }}</h3>
        <a href="{{route('empleados.familiares.create',$employee->idEmpleado)}}" class="btn btn-primary btn-circle btn-xl">
            <i class="fa fa-plus"></i>
        </a>
        <br>
        <br>
        <div>
            <input class="form-control" type="text" list="Options" id="tableInput" placeholder="Buscador">
        </div>
        <table id="tablita" class="table">
            <thead>
            <tr>
                <th>Nombre Completo</th>
                <th>CI</th>
                <th>Relacion</th>
                <th>Mostrar</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($family as $familiar)
                <tr>
                    <td>{{$familiar->fullName()}}</td>
                    <td>{{$familiar->ci}}</td>

                    <td>
                        {{ $familiar->tipoRelacion }}
                    </td>
                    <td>
                        <a href="{{ route('user.show',$familiar->idEmpleado)}}" class="btn btn-warning">
                            <i class='fas fa-eye'></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('empleados.familiares.edit',[$employee->idEmpleado,$familiar->idFamiliar])}}" class="btn btn-primary">
                            <i class='fas fa-pencil-alt'></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('empleados.familiares.destroy', [$familiar->idEmpleado, $familiar->idFamiliar]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" data-cat-id="{{$familiar->idEmpleado}}" class="btn btn-danger"
                                    data-toggle="modal" data-target="#deleteModal" >
                                <i class='fas fa-trash-alt'></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-body d-flex justify-content-between align-items-center">
        <a href="../" class="btn btn-primary btn-sm">Retornar</a>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/icons.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/datatable.min.js')}}"></script>
    <script src="{{asset('js/select2.full.min.js')}}"></script>

    <script>
        $(document).ready( function () {
            let table = $('#tablita').DataTable({
                'dom':'lrtip',
                "language": {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            });

            $('#tableInput').on('keyup click',function () {
                table.search($(this).val()).draw();
                console.log($('#tableInput').val());
            });
        } );
    </script>
@endsection