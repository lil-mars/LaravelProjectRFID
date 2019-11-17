@extends('layout')

@section('content')
    <div class="container">
        <div>
            <br>
            <input class="form-control" type="text" list="Options" id="tableInput" placeholder="Buscador">
            <br>
            <form action="{{ route('compare') }}" method="post" hidden>
                @csrf
                <input class="form-control" type="text" id="rfidCode" name="rfidCode" value="">
                <input id="enviar" type="submit" >
            </form>

            <datalist id="Options" >
                <option value="Activado">
                <option value="Inactivo">
                <option value="Femenino">
                <option value="Masculino">
            </datalist>
        </div>
        <br>
        <table id="tablita" class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>CI</th>
                <th>Nombre Completo</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
            @foreach($empleaditos as $empleado)
                <tr>
                    <td>{{$empleado->idEmpleado}}</td>
                    <td>{{$empleado->ci}}</td>
                    <td >{{$empleado->fullName()}}</td>
                    <td >{{$empleado->ci}}</td>

            @endforeach
            {{--            Modal para borra el empleado        --}}

            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/all.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/datatable.min.js')}}"></script>

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
            let rfidCode = "";

            $( "body" ).on( "keypress", function(event) {
                if(event.key === "Enter"){
                    console.log(rfidCode);
                    $('#rfidCode').val(rfidCode);
                    $('#enviar').click();
                    rfidCode = "";
                }else{
                    rfidCode += event.key;
                }
            });
        } );
    </script>
@endsection