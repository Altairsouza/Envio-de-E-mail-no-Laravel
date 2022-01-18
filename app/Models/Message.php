<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // disable timestamps
   public $timestamps = false; //aqui ele esta dizendo q ele n tem uma timestamps ele criou com outro metodo e por tanto n precisa dela
    
}
