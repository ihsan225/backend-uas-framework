<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
 protected $table = 'book';
 protected $primaryKey = 'id_buku';
 protected $keyType = 'string';
 protected $fillable = ['kode_buku', 'judul_buku', 'genre_buku'];
}
