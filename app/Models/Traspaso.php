<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traspaso extends Model
{
    use HasFactory;

    protected $table = 'traspasos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [ 
        "tras_estado"
    ];

    public function centro_distrubucion()
    {
        return $this->belongsTo(CentroDitrubucion::class,'centro_distrubucion_id');
    }

    public function detalle_traspaso()
    {
        return $this->belongsTo(DetalleTraspaso::class,'detalle_traspaso_id');
    }
}
