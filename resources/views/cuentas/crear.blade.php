@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear Cuenta</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>
                                @foreach ($errors->all() as $error)
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif

                    <form action="{{ route('cuentas.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="correo">Correo</label>
                                   <input type="email" name="correo" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="contrasena">Contraseña</label>
                                   <input type="text" name="contrasena" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="plataforma">Plataforma</label>
                                   <input type="text" name="plataforma" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="costo">Costo</label>
                                   <input type="text" name="costo" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="pagado">Pagado</label>
                                   <input type="text" name="pagado" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="disponibles">Disponibles</label>
                                   <input type="number" name="disponibles" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="dias_restantes">Fecha de Vencimiento</label>
                                   <input type="date" name="dias_restantes" class="form-control" value="{{ date('Y-m-d', strtotime('+30 days')) }}" requiered>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="id_proveedor">Proveedor</label>
                                   <select name="id_proveedor" class="form-control" required>
                                       @foreach($proveedores as $proveedor)
                                           <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                       @endforeach
                                   </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
