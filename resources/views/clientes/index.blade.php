@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Clientes</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">


                        
                        <a class="btn btn-warning" href="{{ route('clientes.create') }}">Nuevo</a>
                        

                        <table class="table table-striped mt-2 table_id" id="miTabla">
                                <thead style="background: linear-gradient(45deg,#070f4b, #000000)">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Numero</th>
                                    <th style="color:#fff;">Nombre</th>
                                    
                                    <th style="color:#fff;">Acciones</th>
                              </thead>
                              <tbody>
                            @foreach ($clientes as $cliente)
                            <tr>
                                <td style="display: none;">{{ $cliente->id }}</td>
                                <td>{{ $cliente->numero }}</td>
                                <td>{{ $cliente->nombre }}</td>
                                
                                <td>
                                    <form action="{{ route('clientes.destroy',$cliente->id) }}" method="POST">
                                       
                                        <a class="btn btn-info" href="{{ route('clientes.edit',$cliente->id) }}">Editar</a>
                                    

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
                            {!! $clientes->links() !!}
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
        { Numero: 'numero' },
        { Nombre: 'nombre' },
        { Acciones: 'acciones' },
        
    ],

    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
    }
});
    </script>
@endsection
