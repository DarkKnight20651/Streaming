@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Cuentas</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">


                        
                        <a class="btn btn-warning" href="{{ route('cuentas.create') }}">Nuevo</a>
                        

                        <table class="table table-striped mt-2 table_id" id="miTabla">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Correo</th>
                                    <th style="color:#fff;">Plataforma</th>
                                    <th style="color:#fff;">Disponibles</th>
                                    <th style="color:#fff;">Id proveedor</th>
                              </thead>
                              <tbody>
                            @foreach ($cuentas as $cuenta)
                            <tr>
                                <td style="display: none;">{{ $cuenta->id }}</td>
                                <td>{{ $cuenta->correo }} <br> {{ $cuenta->contrasena }}</td>
                                <td>{{ $cuenta->plataforma }}</td>
                                <td>{{ $cuenta->disponibles }}</td>
                                <td>
                                    <form action="{{ route('cuentas.destroy',$cuenta->id) }}" method="POST">
                                       
                                        <a class="btn btn-info" href="{{ route('cuentas.edit',$cuenta->id) }}">Editar</a>
                                    
                                         @csrf
                                        @method('DELETE')
                                      
                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                      
                                    </form>
                                    {!! Form::open(['route' => 'cuentas.ver_perfiles', 'method' => 'GET']) !!}                         
                                                        {!! Form::hidden('id_cuenta', $cuenta->id)!!}
                                                        
                                                        {!! Form::submit('Ver Perfiles', ['class' => 'btn btn-warning w-100']) !!}
                                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Ubicamos la paginacion a la derecha -->
                        {{-- <div class="pagination justify-content-end">
                            {!! $cuentas->links() !!}
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
        [5, 10,15],
        [5, 10,15]
    ],

    columns: [
        { Id: 'Id' },
        { Nombre: 'Correo' },
        { Clave: 'Plataforma' },
        { Direccion: 'Disponibles' },
        { Acciones: 'Id_Proveedor' }
    ],

    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
    }
});
    </script>
@endsection
