@extends('login/layout')
@section('content')
    <div class="btn btn-block btn-secondary" aria-labelledby="navbarDropdown">
        <a class="text-white" href="{{ route('logout') }}"
           onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
            {{ __('Cerrar sesion') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    <div class="card">
        <br>
        <div class="p-3 mb-2 bg-info text-white">
            <h2 align="center">{{$empleado->cargo->nombre}} </h2>
        </div>
        <div class="card-body">

            <div class="d-flex bd-highlight">
                <div class="p-2 flex-fill bd-highlight">
                    <img src="{{asset('images/'.$empleado->fotografia)}}" class="rounded-circle"
                         style=" width: 200px; height: 200px  ">

                    <h2 class="align-text-bottom">{{$empleado->fullName()}}</h2>
                    <a href="{{ route('user.edit',$empleado->idEmpleado)}}"
                       class="btn btn-primary">
                        Editar
                    </a>
                    <a class="float-left">
                    <form method="post" action="{{ route('empleados.update', $empleado->idEmpleado)}}">
                        @method('PATCH')
                        @csrf
                        <input class="btn btn-secondary" type="submit" value="Horas de trabajo">
                    </form>
                    </a>
                </div>
                <div class="p-2 flex-fill bd-highlight">
                    <h3> Cedula de Identidad: </h3> <br/>
                    <h3>Numero de Celular: </h3> <br/>
                    <h3>Fecha de Nacimiento: </h3> <br/>
                    <h3>Estado Civil: </h3> <br/>
                    <h3>Genero: </h3> <br/>
                    <h3>Fecha de Nacimiento: </h3> <br/>
                </div>
                <div class="p-2 flex-fill bd-highlight">
                    <h4> {{$empleado->ci}} </h4> <br/>
                    <h4> {{$empleado->celular}} </h4> <br/>
                    <h4> {{$empleado->fechaNacimiento}} </h4> <br/>
                    <h4> {{$empleado->estadoCivil}} </h4> <br/>
                    @if($empleado->genero==="F")
                        <h4> Femenino </h4> <br/>
                    @else
                        <h4> Masculino </h4> <br/>
                    @endif
                    <h4> {{$empleado->fechaNacimiento}} </h4> <br/>
                </div>
            </div>
            <hr>
            <div class="p-3 mb-2 bg-info text-white">
                <h2 align="center">Referencia </h2>
            </div>
            <div class="row">
                <div class="col">
                    <h2>Nombre Completo</h2>
                </div>
                <div class="col">
                    <h2>Telefono</h2>
                </div>
                <div class="col">
                    <h2>Accion</h2>
                </div>
            </div>
            <div class="row">
                @if($empleado->referencia)
                    <div class="col">
                        <h3>{{$empleado -> referencia ->fullName()}}</h3>
                    </div>
                    <div class="col">
                        <h3>{{$empleado -> referencia ->celular}}</h3>
                    </div>
                    <div class="col">
                        <a href="{{ route('user.referencia.edit',[$empleado->idEmpleado,$empleado->referencia->idReferencia])}}"
                           class="btn btn-primary">
                            <i class='fa fa-pencil-alt'></i>
                        </a>
                    </div>
                @else
                    <div class="col">

                    </div>
                    <div class="col">

                    </div>
                    <div class="col">
                        <a href="{{ route("user.referencia.create", $empleado->idEmpleado) }}"
                           class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>


                @endif
            </div>
            <div class="card-body d-flex justify-content-between align-items-center">
                <a href="{{ route("empleados.familiares.index", $empleado->idEmpleado) }}"
                   class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Familiares</a>
            </div>

            <div class="card-body d-flex justify-content-between align-items-center">
                <a href="../" class="btn btn-primary btn-sm">Retornar</a>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection