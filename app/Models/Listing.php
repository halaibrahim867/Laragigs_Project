<?php
namespace App\Models;
class Listing{

    public static function all(){
       return [
            [
                'id'=> 1,
                'title'=>'Listing One',
                'description'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam dolorem eos excepturi reprehenderit, rerum saepe. Delectus esse fugit in minima modi, nam, nesciunt numquam pariatur porro provident quia temporibus, ut.',
            ],
            [
                'id'=>2,
                'title'=>'Listing two',
                'description'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam dolorem eos excepturi reprehenderit, rerum saepe. Delectus esse fugit in minima modi, nam, nesciunt numquam pariatur porro provident quia temporibus, ut.'
            ]
        ];
    }
    public  static function find($id){
        $listings= self::all();
        foreach ($listings as $listing){
            if ($listing['id']== $id){
                return$listing;
            }
        }
    }

}

