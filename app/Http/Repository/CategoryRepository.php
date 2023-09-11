<?php

namespace App\Http\Repository;

use App\Models\Category;

class CategoryRepository extends CommonRepository
{
    public function __construct()
    {
        parent::__construct();
        //
    }

    public static function index()
    {
        return Category::all();
    }

    public static function store( $request )
    {
        return Category::create( $request->all() );
    }

    public static function update( $request, $category )
    {

        if ( $request->has( 'category_name' ) ) {
            $category->category_name = $request->category_name;
        }

        if ( $request->has( 'is_active' ) ) {
            $category->is_active = $request->is_active == 1 ? 1 : 0;
        }

        return $category->update();
    }

    public static function show( $id )
    {
        $category = Category::findOrFail( $id );

        return $category;
    }

    public static function delete( $category )
    {
        return $category->delete();
    }

    public static function findById( $id )
    {
        return Category::find( $id );
    }

}