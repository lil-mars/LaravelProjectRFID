<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Familiar extends Model
{
    protected $primaryKey = 'idFamiliar';
    protected $table = 'Familiar';
    protected $fillable = [
        'idFamiliar','nombre','segundoNombre','apellidoMaterno',
        'apellidoPaterno','idEmpleado','ci','tipoRelacion'
    ];
    public $timestamps = false;

    public function fullName(){
        return $this->apellidoPaterno." ".$this->apellidoMaterno." ".$this->segundoNombre." ".$this->nombre;
    }
    public function empleado()
    {
        return $this->belongsTo('App\Empleado','idEmpleado','idEmpleado');
    }

}
