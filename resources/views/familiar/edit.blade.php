@extends('login/layout')
@section('content')
    <div class="container">
        <form action="{{route('empleados.familiares.update',[$employee->idEmpleado,$familiar->idFamiliar])}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-10">
                    <input value="{{ $familiar->nombre }}" type="text" class="form-control" name="nombre" required>
                    <span class="text-danger">{{ $errors->first('nombre') }}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="segundoNombre" class="col-sm-2 col-form-label">Segundo nombre</label>
                <div class="col-sm-10">
                    <input type="text" value="{{ $familiar->segundoNombre }}" class="form-control" name="segundoNombre">
                    <span class="text-danger">{{ $errors->first('segundoNombre') }}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="apellidoPaterno" class="col-sm-2 col-form-label">Apellido paterno</label>
                <div class="col-sm-10">
                    <input type="text" value="{{ $familiar->apellidoPaterno }}"class="form-control" name="apellidoPaterno" required>
                    <span class="text-danger">{{ $errors->first('apellidoPaterno') }}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="apellidoMaterno" class="col-sm-2 col-form-label">Apellido materno</label>
                <div class="col-sm-10">
                    <input type="text" value="{{ $familiar->apellidoMaterno }}" class="form-control" name="apellidoMaterno">
                    <span class="text-danger">{{ $errors->first('apellidoMaterno') }}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="ci" class="col-sm-2 col-form-label">CI</label>
                <div class="col-sm-10">
                    <input type="text" value="{{ $familiar->ci }}" class="form-control" name="ci" required>
                    <span class="text-danger">{{ $errors->first('ci') }}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="tipoRelacion" class="col-sm-2 col-form-label">Tipo de relacion</label>
                <select class="custom-select col-sm-2 col-form-label" name="tipoRelacion" required>
                    <option selected value="{{$familiar->tipoRelacion}}">{{$familiar->tipoRelacion}}</option>
                    <option value="Hijo">Hijo</option>
                    <option value="Esposo">Esposo</option>
                </select>
            </div>
            <div class="form-group">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </form>
    </div>
@endsection