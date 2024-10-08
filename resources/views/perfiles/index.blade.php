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
                        <thead style="background: linear-gradient(45deg,#070f4b, #000000)">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Cuenta Principal</th>
                                    <th style="color:#fff;">Pin</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Usuario</th>
                                    <th style="color:#fff;">Fecha de vencimiento</th>
                                    
                                    <th style="color:#fff;">Pagado</th>
                                    <th style="color:#fff;">Acciones</th>
                              </thead>
                              <tbody >
                              @php
                        
                        use Carbon\Carbon;
                    @endphp
                              @foreach ($perfiles as $perfile)
                            <tr>
                                <td style="display: none;">{{ $perfile->id }}</td>
                                <td>{{ $perfile->cuenta->plataforma }} <br>Correo: {{ $perfile->cuenta->correo }} <br>Contraseña: {{ $perfile->cuenta->contrasena }} <br>Perfil: {{ $perfile->nombre }} <br>Vencimiento: {{ $perfile->dias_restantes }}</td>
                                <td>{{ $perfile->pin }}</td>
                                <td>{{ $perfile->nombre }}</td>
                                <td>{{ $perfile->cliente->nombre }}  {{ $perfile->cliente->numero }}</td>
                                <td>{{ $perfile->dias_restantes }}</td>
                                
                                <td> @php
                $fecha_actual = Carbon::now();
                $dias_restantes = Carbon::parse($perfile->dias_restantes)->diffInDays($fecha_actual, false);
            @endphp
            @if($dias_restantes < 0)
                <span style="color: green;">&#x2714;</span> <!-- Icono verde -->
            @else
                <span style="color: red;">&#x2716;</span> <!-- Icono rojo -->
            @endif</td>
                                <td>
                                    <form action="{{ route('perfiles.destroy',$perfile->id) }}" method="POST">
                                       
                                        <a class="btn btn-info" href="{{ route('perfiles.edit',$perfile->id) }}">Editar</a>
                                    

                                        @csrf
                                        @method('DELETE')
                                      
                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                      
                                    </form>
                                    {!! Form::open(['route' => 'perfiles.renew', 'method' => 'GET']) !!}                         
                                                        {!! Form::hidden('id_perfil', $perfile->id)!!}
                                                        
                                                        {!! Form::submit('Renovar', ['class' => 'btn btn-warning w-500']) !!}
                                                    {!! Form::close() !!}
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
        [10, 15, 20],
        [10, 15, 20]
    ],

    columns: [
    { Id: 'Id' },
    { Cuenta: 'Cuenta Principal' },
    { Clave: 'Pin' },
    { Direccion: 'Nombre' },
    { Usuario: 'Usuario' },
    { FechaVencimiento: 'Fecha de vencimiento' },
   
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
