<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'Cargo';
    protected $primaryKey = 'idCargo';
    protected $fillable = [
        'idCargo','nombre','flexible'
    ];
    public function empleados()
    {
        return $this->hasMany('App\Empleado','idCargo','idCargo');
    }
    public function horarios()
    {
        return $this->hasMany('App\Horario','idCargo','idCargo');
    }

}