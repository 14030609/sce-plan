<?php
/**
 * Created by IntelliJ IDEA.
 * User: migue
 * Date: 5/1/19
 * Time: 8:21 AM
 */
use Illuminate\Database\Eloquent\Model;


class InscribirTaller extends Model
{
    protected $table = 'inscripciontaller';
    public $timestamps = false;
    public $incrementing=false;
//    protected  $primaryKey = 'cvetaller';

    protected $guarded = ['cvetaller','nua'];
}

