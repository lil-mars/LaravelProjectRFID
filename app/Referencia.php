<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    protected $table = "Referencia";
    public $timestamps = false;
    protected $primaryKey = "idReferencia";

    protected $fillable = [
        'idReferencia','nombre','segundoNombre','apellidoPaterno','apellidoMaterno','celular','idEmpleado '
    ];
    public function fullName(){
        return $this->apellidoPaterno." ".$this->apellidoMaterno." ".$this->segundoNombre." ".$this->nombre;
    }

    public function empleado()
    {
        return $this->belongsTo('App\Empleado','idEmpleado','idEmpleado');
    }
}