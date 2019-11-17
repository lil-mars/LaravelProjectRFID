@extends('login.layout')

@section('content')

    <h1 class="login-box-msg">Editar usuario</h1>

    <form action="{{ route('user.update', $empleado->idEmpleado)}}" method="post" class="needs-validation"
          enctype="multipart/form-data" novalidate>
        @method('PUT')
        @csrf

        <input type="hidden" name="idEmpleado" value="{{$empleado->idEmpleado}}"/>

        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="validationCustom01">Primer Nombre</label>
                <input name="firstName" type="text" class="form-control" id="validationCustom01"
                       placeholder="Primer Nombre" value="{{$empleado->nombre}}" required>
                <span class="text-danger">{{ $errors->first('firstName') }}</span>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom02">Segundo Nombre</label>
                <input name="secondName" type="text" class="form-control" id="validationCustom02"
                       value="{{$empleado->segundoNombre}}" placeholder="Segundo Nombre">
                <span class="text-danger">{{ $errors->first('secondName') }}</span>
            </div>

        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="validationCustom03">Apellido Paterno</label>
                <input name="fatherName" type="text" class="form-control" id="validationCustom03"
                       value="{{$empleado->apellidoPaterno}}" placeholder="Apellido Paterno" required>
                <span class="text-danger">{{ $errors->first('fatherName') }}</span>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom04">Apellido Materno</label>
                <input name="motherName" type="text" class="form-control" id="validationCustom04"
                       value="{{$empleado->apellidoMaterno}}" placeholder="Apellido Materno">
                <span class="text-danger">{{ $errors->first('motherName') }}</span>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="validationCustom01">CI</label>
                <input name="ci" type="text" class="form-control" id="validationCustom01" value="{{$empleado->ci}}"
                       placeholder="CI" required>
                <span class="text-danger">{{ $errors->first('ci') }}</span>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom01">Telefono</label>
                <input name="phone" type="int" class="form-control" id="validationCustom01"
                       value="{{$empleado->celular}}" placeholder="telefono" required>
                <span class="text-danger">{{ $errors->first('phone') }}</span>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label for="validationCustom01">Genero</label>
                <br/>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="gender" value="{{$empleado->genero}}"
                           class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1">Femenino</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="gender" value="{{$empleado->genero}}"
                           class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">Masculino</label>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationCustom01"> Estado Civil</label>
                <div class="col-10">
                    <select id="inputState" class="form-control" name="civilStatus">
                        <option value="{{$empleado->estadoCivil }}">{{$empleado->estadoCivil }}</option>
                        <option value=" Soltero">Soltero</option>
                        <option value="Casado ">Casado</option>
                        <option value="Viudo ">Viudo</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationCustom01">Fecha Nacimiento</label>
                <div class="col-10">
                    <input class="form-control" name="birthdate" type="date" value="{{$empleado->fechaNacimiento}}"
                           id="example-date-input" placeholder="Fecha Naciemiento" >
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationCustom01"> RFID</label>
                <div class="col-10">
                    <input class="form-control" name="rfid" type="text" value="{{$empleado->rfidCode}}"
                           id="example-date-input"
                           placeholder=RFID>
                </div>
                <span class="text-danger">{{ $errors->first('rfid') }}</span>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="validationCustom03">Usuario</label>
                <input name="user" type="text" class="form-control" id="validationCustom03"
                       value="{{$empleado->usuario}}" placeholder="Usuario" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom04">Contraseña</label>
                <input name="password" type="password" class="form-control" id="validationCustom04"
                       value="{{$empleado->password}}" placeholder="Contraseña" required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="validationCustom03">Cargo</label>
                <select id="inputState" class="form-control" name="idCargo">
                    <option value="{{$empleado->cargo->idCargo }}">{{$empleado->cargo->nombre }}</option>
                    @foreach($cargos as $cargo)

                        <option value=" {{$cargo->idCargo }}" ?>
                            {{$cargo->nombre }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Please provide a valid city.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom04">Seleccionar un perfil</label>
                <input name="image" type="file" class="form-control" id="validationCustom04"
                       value="{{$empleado->fotografia}}">
                <span class="text-danger">{{ $errors->first('image') }}</span>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Actualizar</button>
    </form>
@endsection
