<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $fillable = [
    		'nome', 'sala', 'quant_aluno', 'curso'
    ];
}
