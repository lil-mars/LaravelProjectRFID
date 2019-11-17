<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = "Horario";
    protected $primaryKey = "idHorario";

    protected $fillable = [
        'idHorario','horaEntrada','horaSalida','horasDeTrabajo','idCargo','turno'
    ];

    public function cargo(){
        return $this->hasOne('App\Cargo','idCargo','idCargo');
    }
}
