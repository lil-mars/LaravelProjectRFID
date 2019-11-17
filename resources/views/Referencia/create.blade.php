@extends('login/layout')
@section('content')
    </br>
    <div class="card w-75">
        <div class="card-body">
            <h1 align="center" class="card-title">Registrar Referencia</h1> <br>
            <form action="{{ route("user.referencia.store", $idEmpleado) }}" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom01">Primer Nombre</label>
                        <input value="{{old('name')}}" name="name" type="text" class="form-control" id="validationCustom01" placeholder="Primer Nombre" required>
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom02">Segundo Nombre</label>
                        <input value="{{old('secondName')}}" name="secondName" type="text" class="form-control" id="validationCustom02" placeholder="Segundo Nombre" >
                        <span class="text-danger">{{ $errors->first('secondName') }}</span>

                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom01">Apellido Paterno</label>
                        <input value="{{old('fatherName')}}" name="fatherName" type="text" class="form-control" id="validationCustom01" placeholder="Apellido Paterno" required>
                        <span class="text-danger">{{ $errors->first('fatherName') }}</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom02">Apellido Materno</label>
                        <input value="{{old('motherName')}}" name="motherName" type="text" class="form-control" id="validationCustom02" placeholder="Apellido Materno" >
                        <span class="text-danger">{{ $errors->first('motherName') }}</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom01">Telefono</label>
                        <input value="{{old('phone')}}" name="phone" type="text" class="form-control" id="validationCustom01" placeholder="Telefono" required>
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Registrar</button>
            </form>
        </div>
    </div>
@endsection