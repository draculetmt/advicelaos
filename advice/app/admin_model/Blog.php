<?php

namespace App\admin_model;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'content',
        'featured',
        'category_id'
      ];

      public function deleteImage()
{

Storage::delete($this->featured);

}
      



}
