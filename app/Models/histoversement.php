<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class histoversement extends Model
{
    use HasFactory;

    protected $table = 'histoversement';

    protected $primaryKey = 'id';

    // Les colonnes de la table que vous souhaitez autoriser à remplir
    protected $fillable = [ 'id','iddevis', 'versement', 'reste','total','date','ancienreste','ancienpayer'];
}
