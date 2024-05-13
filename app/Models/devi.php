<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class devi extends Model
{
    use HasFactory;

    protected $table = 'devi';

    protected $primaryKey = 'id';

    // Les colonnes de la table que vous souhaitez autoriser à remplir
    protected $fillable = [ 'id','numclient', 'dure','debut','fin','payer','restant','total','type','maison','nbchambre','nbtoilette','finition','pourcentage','totalpourcentage'];
}
