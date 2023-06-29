<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class Book extends Model
{
    use HasFactory, Filterable;
    public $fillable = ['name', 'catalog_book_id', 'author_id', 'publishing_id', 'ibsn', 'status', 'year', 'user_id'];
    public function catalog(){
        return $this->belongsTo(CatalogBook::class, 'catalog_book_id');
    }
    public function author(){
        return $this->belongsTo(BookAuthor::class);
    }
    public function publish(){
        return $this->belongsTo(BookPublishing::class, 'publishing_id');
    }
    public function covers(){
        return $this->hasMany(BookCover::class);
    }
}
