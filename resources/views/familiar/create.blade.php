@extends('login/layout')
@section('content')

    <div class="container">
        <h1>Nuevo familiar</h1>
        <form action="{{route('empleados.familiares.store',$employeeId)}}" method="post">
            @csrf
            <div class="form-group">
                <label for="nombre" class="col-12 col-form-label">Nombre</label>
                <div class="col-sm-10" >
                    <input type="text" class="form-control" name="nombre" value="{{old('nombre')}}">
                    <span class="text-danger">{{ $errors->first('nombre') }}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="segundoNombre" class="col-12 col-form-label">Segundo nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="segundoNombre" value="{{old('segundoNombre')}}">
                    <span class="text-danger">{{ $errors->first('segundoNombre') }}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="apellidoPaterno" class="col-12 col-form-label">Apellido paterno</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="apellidoPaterno" value="{{old('apellidoPaterno')}}" >
                    <span class="text-danger">{{ $errors->first('apellidoPaterno') }}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="apellidoMaterno" class="col-12 col-form-label">Apellido materno</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="apellidoMaterno" value="{{old('apellidoMaterno')}}">
                    <span class="text-danger">{{ $errors->first('apellidoMaterno') }}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="ci" class="col-12 col-form-label">CI</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="ci" value="{{old('ci')}}">
                    <span class="text-danger">{{ $errors->first('ci') }}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="relations" class="col-12 col-form-label">Tipo de relacion</label>
                <select class="form-control-sm" name="relations" required>
                    <option selected>--- Opcion ---</option>
                    <option value="Hijo">Hijo</option>
                    <option value="Esposo">Esposo</option>
                </select>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection