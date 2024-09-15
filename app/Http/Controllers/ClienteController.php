<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cliente;


class clienteController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-cliente|crear-cliente|editar-cliente|borrar-cliente')->only('index');
         $this->middleware('permission:crear-cliente', ['only' => ['create','store']]);
         $this->middleware('permission:editar-cliente', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-cliente', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //Con paginación
         $clientes = cliente::All();
         return view('clientes.index',compact('clientes'));
         //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $clientes->links() !!}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    $clientees = cliente::all();
    return view('clientes.crear', compact('clientees'));
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
         
        ]);

        cliente::create($request->all());

        return redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(cliente $cliente)
    {
        return view('clientes.editar',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cliente $cliente)
    {
         request()->validate([
            'titulo' => 'required',
            'contenido' => 'required',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index');
    }
}
