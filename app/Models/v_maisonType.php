<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class v_maisonType extends Model
{
    use HasFactory;

    protected $table = 'v_maisontype';

    protected $primaryKey = 'id';

    // Les colonnes de la table que vous souhaitez autoriser à remplir
    protected $fillable = [ 'id','nom', 'idtype', 'nbchambre','nbtoilette','type','dure'];
}
