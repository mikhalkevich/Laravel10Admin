<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class BookFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];
    public function name($name)
    {
        return $this->where('name', 'LIKE', '%'.$name.'%');
    }
    public function year($value){
        return $this->where('year', $value);
    }
    public function catalog(int $id){
        if($id > 0){
            return $this->where('catalog_book_id', $id);
        }
    }
    public function cover(bool $bool){
        return $this->whereHas('covers');
    }
    public function link(bool $bool){
        dd($bool);
    }
}
