<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class SubprogramasServicio extends Model {
    protected $table = 'subprogramaservicio';
    public $timestamps = false;
    public $incrementing=false;
    protected  $primaryKey = 'cvesubprograma';

}

