<?php
/**
 * Created by IntelliJ IDEA.
 * User: migue
 * Date: 4/5/19
 * Time: 2:38 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;


class Listas extends Model
{
    protected $table='listas';
    protected $fillable = ['parcial1', 'parcial2','parcial2','parcial3'];
    protected $guarded = ['cvemat','nogpo','nua'];
    public $timestamps  = false;
}

