@extends('login/layout')

@section('content')

</br>
<div class="card w-75">
    <div class="card-body">
        <h1 align="center" class="card-title">Registrar Referencia</h1> <br>
        <form action="{{ route("user.referencia.update", [$employee->idEmpleado,$referencia->idReferencia]) }}" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom01">Primer Nombre</label>
                    <input name="nombre" type="text" value="{{ $referencia->nombre }}" class="form-control" id="validationCustom01" placeholder="Primer Nombre" required>
                    <span class="text-danger">{{ $errors->first('nombre') }}</span>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">Segundo Nombre</label>
                    <input name="segundoNombre" type="text" value="{{ $referencia->segundoNombre }}" class="form-control" id="validationCustom02" placeholder="Segundo Nombre" >
                    <span class="text-danger">{{ $errors->first('segundoNombre') }}</span>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom01">Apellido Paterno</label>
                    <input name="apellidoPaterno" type="text" class="form-control" value="{{ $referencia->apellidoPaterno }}" id="validationCustom01" placeholder="Apellido Paterno" required>
                    <span class="text-danger">{{ $errors->first('apellidoPaterno') }}</span>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">Apellido Materno</label>
                    <input name="apellidoMaterno" type="text" class="form-control" value="{{ $referencia->apellidoMaterno }}" id="validationCustom02" placeholder="Apellido Materno" >
                    <span class="text-danger">{{ $errors->first('apellidoMaterno') }}</span>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationCustom01">Telefono</label>
                    <input name="celular" type="text" class="form-control" value="{{ $referencia->celular }}" id="validationCustom01" placeholder="Telefono" required>
                    <span class="text-danger">{{ $errors->first('celular') }}</span>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Actualizar</button>
        </form>
    </div>
</div>
@endsection