<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleTraspaso extends Model
{
    use HasFactory;

    protected $table = 'detalle_traspasos';
    protected $primaryKey = 'id';
    public $timestamps = true; 

    protected $fillable = [ 
        "det_tra_cantidad",
        "det_tra_lote"
    ]; 

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class,'medicamento_id');
    }

    public function traspaso()
    {
        return $this->belongsTo(Traspaso::class,'traspaso_id');
    }
}
