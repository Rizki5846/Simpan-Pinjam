<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenghitunganKnn extends Model {
    use HasFactory;

    protected $table = 'penghitunganKnn';
    protected $fillable = ['nama', 'nik', 'skor', 'kelayakan'];
}
