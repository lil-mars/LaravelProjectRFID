<?php


namespace App\Http\Controllers;


class TotalController
{
    public  function checkRole($id,$request) {
        $idRol = (int) $request->user()->idRol;
        $requestId = (string) $request->user()->idEmpleado;
        if ($idRol == 3 && $id != $requestId) {
            abort(404);
        }
    }
    public function checkRoleWithRequest ($request) {
        $idRol = (int) $request->user()->idRol;
        if ($idRol == 3) {
            abort(404);
        }
    }
}