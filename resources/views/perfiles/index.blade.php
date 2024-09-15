@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Perfiles</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">


                        
                        <a class="btn btn-warning" href="{{ route('perfiles.create') }}">Nuevo</a>
                        

                        <table class="table table-striped mt-2 table_id" id="miTabla">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Cuenta Principal</th>
                                    <th style="color:#fff;">Pin</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Usuario</th>
                                    <th style="color:#fff;">Fecha de vencimiento</th>
                                    <th style="color:#fff;">Precio</th>
                                    <th style="color:#fff;">Pagado</th>
                                    <th style="color:#fff;">Acciones</th>
                              </thead>
                              <tbody>
                            @foreach ($perfiles as $perfile)
                            <tr>
                                <td style="display: none;">{{ $perfile->id }}</td>
                                <td>{{ $perfile->id_cuenta }}</td>
                                <td>{{ $perfile->pin }}</td>
                                <td>{{ $perfile->nombre }}</td>
                                <td>{{ $perfile->id_usuario }}</td>
                                <td>{{ $perfile->dias_restantes }}</td>
                                <td>{{ $perfile->precio }}</td>
                                <td>{{ $perfile->pagado }}</td>
                                <td>
                                    <form action="{{ route('perfiles.destroy',$perfile->id) }}" method="POST">
                                       
                                        <a class="btn btn-info" href="{{ route('perfiles.edit',$perfile->id) }}">Editar</a>
                                    

                                        @csrf
                                        @method('DELETE')
                                      
                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                      
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Ubicamos la paginacion a la derecha -->
                        {{-- <div class="pagination justify-content-end">
                            {!! $perfiles->links() !!}
                        </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <!-- DATATABLES -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- BOOTSTRAP -->
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        new DataTable('#miTabla', {
    lengthMenu: [
        [2, 5, 10],
        [2, 5, 10]
    ],

    columns: [
    { Id: 'Id' },
    { Cuenta: 'Cuenta Principal' },
    { Clave: 'Pin' },
    { Direccion: 'Nombre' },
    { Usuario: 'Usuario' },
    { FechaVencimiento: 'Fecha de vencimiento' },
    { Precio: 'Precio' },
    { Pagado: 'Pagado' },
    { Acciones: 'Acciones' }
]
,

    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
    }
});
    </script>
@endsection
