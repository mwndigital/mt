<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiningPageFile extends Model
{
    use HasFactory;

    protected $table = 'dining_page_files';
    protected $fillable = [
      'page_id',
      'file_name',
      'original_name',
      'file_path'
    ];

    public function diningPageContent(){
        return $this->belongsTo(DiningPageContent::class);
    }
}
