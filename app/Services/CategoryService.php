<?php

namespace App\Services;

use App\Models\Category;

class CategoryService extends ImageUploadService
{

    public $category_name;
    public $slug;
    public $description;
    public $image;

    public function __construct($category_name, $slug = null, $description = null, $image = null){
        $this->category_name = $category_name;
        $this->slug = $slug == null ? $category_name : $slug;
        $this->description = $description;
        $this->image = $image == null ? null : $image;
    }


    public function create(){
        //process image
        $filenameToStore = null;
        if($this->image !== null){
            $filenameToStore = Self::uploadImage($this->image);
        }
       //store category
       $category = Category::firstOrCreate([
           'name' => $this->category_name,
           'slug'    => $this->slug,
           'description' => $this->description,
           'image' => $filenameToStore
       ]);

       return $category;
    }    

    public function update($category_id)
    {
        //find the category
        $category = Category::findOrFail($category_id);
        $filenameToStore = $category->image;

        //if category has an image delete the old one and upload the new one
        if($this->image !== null){
            if($category->image !==  null){
             Self::deleteImage($category->image);
            }
            $filenameToStore = Self::uploadImage($this->image);
        }

        $category->update([
            'name' => $this->category_name,
            'slug'    => $this->slug,
            'description' => $this->description,
            'image' => $filenameToStore
        ]);  

        $newCategory = $category->refresh();
        return $newCategory;
    }

}