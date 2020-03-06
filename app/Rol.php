<?php


namespace App;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = "Rol";
    protected $primaryKey = "idRol";

    protected $fillable = [
        'idRol','nombre'
    ];
    public function empleados()
    {
        return $this->hasMany('App\Empleado','idRol','idRol');
    }
}