<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $fillable = ['name', 'phone', 'status'];
    public $timestamps = false;
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
