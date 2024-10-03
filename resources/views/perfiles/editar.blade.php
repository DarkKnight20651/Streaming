@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Editar perfile</h3>
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

                        <form action="{{ route('perfiles.update', $perfile->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Campo ID perfile -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="id_perfile">ID perfile</label>
                                        <input type="text" name="id_perfile" class="form-control" value="{{ $perfile->id }}">
                                    </div>
                                </div>

                                <!-- Campo PIN -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="pin">PIN</label>
                                        <input type="text" name="pin" class="form-control" value="{{ $perfile->pin }}">
                                    </div>
                                </div>

                                <!-- Campo Nombre -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" name="nombre" class="form-control" value="{{ $perfile->nombre }}">
                                    </div>
                                </div>

                                <!-- Campo ID Usuario -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="search_cliente">Buscar Cliente</label>
                                        <input type="text" id="search_cliente" class="form-control" placeholder="Buscar por número de cliente...">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="id_usuario">Cliente</label>
                                        <select name="id_usuario" id="id_usuario" class="form-control" required>
                                            @foreach($clientes as $cliente)
                                            <option value="{{ $cliente->id }}" {{ $cliente->id == $perfile->id_usuario ? 'selected' : '' }}>
                                                {{ $cliente->numero }} {{ $cliente->nombre }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <!-- Campo Días Restantes -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="dias_restantes">Días Restantes</label>
                                        <input type="date" name="dias_restantes" class="form-control" value="{{ \Carbon\Carbon::parse($perfile->dias_restantes)->format('Y-m-d') }}">
                                    </div>
                                </div>

                                <!-- Campo Precio -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="precio">Precio</label>
                                        <input type="number" name="precio" class="form-control" value="{{ $perfile->precio }}">
                                    </div>
                                </div>

                                <!-- Campo Pagado -->
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="pagado">Pagado</label>
                                        <input type="number" name="pagado" class="form-control" value="{{ $perfile->pagado }}">
                                    </div>
                                </div>

                                <br>
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