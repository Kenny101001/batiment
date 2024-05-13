<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maison extends Model
{
    use HasFactory;

    protected $table = 'maison';

    protected $primaryKey = 'id';

    // Les colonnes de la table que vous souhaitez autoriser à remplir
    protected $fillable = [ 'id','nom', 'type', 'nbchambre','nbtoilette'];

}
