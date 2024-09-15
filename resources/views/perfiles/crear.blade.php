@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear Perfil</h3>
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

                    <form action="{{ route('perfiles.store') }}" method="POST">
                        @csrf
                        <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="id_cuenta">Id Cuenta</label>
                    <input type="number" name="id_cuenta" class="form-control" value="{{ $id }}" readonly>
                </div>
            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="nombre">Nombre</label>
                                   <input type="text" name="nombre" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="pin">Pin</label>
                                   <input type="number" name="pin" class="form-control" required>
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
                                   <label for="precio">Precio</label>
                                   <input type="number" name="precio" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="pagado">Pagado</label>
                                   <input type="number" name="pagado" class="form-control" required>
                                </div>
                            </div>
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
                <option value="{{ $cliente->id }}">{{ $cliente->numero }} {{ $cliente->nombre }}</option>
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

<script>
    document.getElementById('search_cliente').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const select = document.getElementById('id_usuario');
        const options = select.getElementsByTagName('option');

        for (let i = 0; i < options.length; i++) {
            const option = options[i];
            const text = option.textContent.toLowerCase();
            option.style.display = text.includes(searchValue) ? '' : 'none';
        }
    });
</script>

@endsection
