@extends('login/layout')

@section('content')
    <div class="register-box">


        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Iniciar Sesion</p>

                <form action="{{ route('check')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input name="user" type="text" class="form-control" placeholder="Usuario">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" type="password" class="form-control" placeholder="Contrasena">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                </form>

            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
@endsection