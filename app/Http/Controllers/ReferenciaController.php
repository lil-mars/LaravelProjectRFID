<?php

namespace App\Http\Controllers;

use App\Empleado;
use Illuminate\Http\Request;
use App\Referencia;

class ReferenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idEmpleado)
    {
        return view('Referencia.create', compact('idEmpleado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($idEmpleado, Request $request)
    {
        $this->validate($request,[
            'name' => 'regex:/^[a-zA-Z]+$/u',
            'secondName' => 'regex:/^[a-zA-Z]+$/u',
            'fatherName' => 'regex:/^[a-zA-Z]+$/u',
            'motherName' => 'regex:/^[a-zA-Z]+$/u',
            'phone' => 'numeric'
        ],[
            'regex' => 'Los caracteres no son validos',
            'numeric' => 'Debe ser numero',
        ]);
        $referencia = new Referencia();
        $referencia->nombre = ucfirst($request->get('name'));
        $referencia->segundoNombre = ucfirst($request->get('secondName'));
        $referencia->apellidoPaterno = ucfirst($request->get('fatherName'));
        $referencia->apellidoMaterno = ucfirst($request->get('motherName'));
        $referencia->celular = $request->get('phone');
        $referencia->idEmpleado = $idEmpleado;
        $referencia->save();
        return  redirect()->route('user.show', $idEmpleado);
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
    public function edit($idEmpleado,$idReferencia)
    {
        $employee = Empleado::find($idEmpleado);
        $referencia = Referencia::find($idReferencia);
        return view('Referencia.edit',compact('employee'),compact('referencia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$idEmpleado, $idReferencia)
    {
        $this->validate($request,[
            'nombre' => 'regex:/^[a-zA-Z]+$/u',
            'segundoNombre' => 'regex:/^[a-zA-Z]+$/u | nullable',
            'apellidoPaterno' => 'regex:/^[a-zA-Z]+$/u',
            'apellidoMaterno' => 'regex:/^[a-zA-Z]+$/u | nullable',
            'celular' => 'numeric'
        ],[
            'regex' => 'Los caracteres no son validos',
            'numeric' => 'Debe ser numero',
        ]);

        $referencia = Referencia::find($idReferencia);
        $referencia->update($request->all());

        return redirect()->route('user.show',$idEmpleado)->with('referencia', $referencia);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
