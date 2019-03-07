<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignacioAtraccion extends Model
{
  protected $table = "assign_emp_atraccions";
  
  protected $fillable = [
    'id_empleat',
    'id_atraccio',
    'data_inici',
    'data_fi'
  ];
}
