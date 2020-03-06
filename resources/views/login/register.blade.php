@extends('login/layout')

@section('content')

    <h1 class="login-box-msg">Registrar nuevo usuario</h1>

    <form action="{{ route('user.store')}}" method="post" class="needs-validation" enctype="multipart/form-data"
          novalidate>
        @csrf
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="validationCustom01">Primer Nombre</label>
                <input name="firstName" type="text" class="form-control" id="validationCustom01"
                       placeholder="Primer Nombre" required value="{{old('firstName')}}">
                <span class="text-danger">{{ $errors->first('firstName') }}</span>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom02">Segundo Nombre</label>
                <input name="secondName" type="text" class="form-control" id="validationCustom02"
                       placeholder="Segundo Nombre" value="{{old('secondName')}}">
                <span class="text-danger">{{ $errors->first('secondName') }}</span>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="validationCustom03">Apellido Paterno</label>
                <input name="fatherName" type="text" class="form-control" id="validationCustom03"
                       placeholder="Apellido Paterno" required value="{{old('fatherName')}}">
                <span class="text-danger">{{ $errors->first('fatherName') }}</span>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom04">Apellido Materno</label>
                <input name="motherName" type="text" class="form-control" id="validationCustom04"
                       placeholder="Apellido Materno" value="{{old('motherName')}}">
                <span class="text-danger">{{ $errors->first('motherName') }}</span>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="validationCustom01">CI</label>
                <input name="ci" type="text" class="form-control" id="validationCustom01" placeholder="CI" required value="{{old('ci')}}">
                <span class="text-danger">{{ $errors->first('ci') }}</span>
            </div>

            <div class="col-md-6 mb-3">
                <label for="validationCustom01">Telefono</label>
                <input name="phone" type="int" class="form-control" id="validationCustom01" placeholder="telefono"
                       required value="{{old('phone')}}">
                <span class="text-danger">{{ $errors->first('phone') }}</span>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label for="validationCustom01">Genero</label>
                <br/>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="gender" value="F" class="custom-control-input" value="{{old('gender')}}">
                    <label class="custom-control-label" for="customRadioInline1">Femenino</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="gender" value="M" class="custom-control-input" value="{{old('gender')}}">
                    <label class="custom-control-label" for="customRadioInline2">Masculino</label>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationCustom01"> Estado Civil</label>
                <div class="col-10">
                    <select id="inputState" class="form-control" name="civilStatus">
                        <option class="0">-- selecionar Estado Civil --</option>
                        <option value="Soltero">Soltero</option>
                        <option value="Casado ">Casado</option>
                        <option value="Viudo ">Viudo</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <label for="validationCustom01">Fecha Nacimiento</label>
                <div class="col-10">
                    <input class="form-control" name="birthdate" type="date" id="example-date-input"
                           placeholder="Fecha Naciemiento" value="{{old('birthdate')}}">
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <label for="validationCustom01"> RFID</label>
                <div class="col-10">
                    <input class="form-control" name="rfid" type="text" id="example-date-input"
                           placeholder=RFID value="{{old('rfid')}}">
                </div>
                <span class="text-danger">{{ $errors->first('rfid') }}</span>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-2 mb-3">
                <label for="validationCustom04">Rol</label>
                <select id="inputState" class="form-control" name="idRol" required>
                    <option class="0">-- selecionar rol --</option>
                    @foreach($roles as $rol)
                        <option value=" {{$rol->idRol }}" ?>
                            {{$rol->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationCustom03">Cargo</label>
                <select id="inputState" class="form-control" name="idCargo" required>
                    <option class="0">-- selecionar cargo --</option>
                    @foreach($cargos as $cargo)
                        <option value=" {{$cargo->idCargo }}">
                            {{$cargo->nombre }}
                            @if($cargo->horarios)
                                @foreach($cargo->horarios as $horario)

                                    {{$horario->horaEntrada}} a
                                    {{$horario->horaSalida}}
                                @endforeach
                            @else
                                El horario es flexible
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5 mb-3">
                <div class="custom-file">
                    <label for="validationCustom04">Seleccionar un perfil</label>
                    <input name="image" type="file" class="form-control" id="validationCustom04" value="{{old('image')}}">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
@endsection