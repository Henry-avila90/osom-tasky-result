<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Lead extends Model
{
    public $table = 'leads';
    public $fillable =[
        'name',
        'email',
        'phone'
    ];
}
