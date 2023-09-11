<?php

namespace App\Http\Repository;

use App\Models\Comment;

class CommentRepository extends CommonRepository
{
    public function __construct()
    {
        parent::__construct();
        //
    }

    public static function index()
    {
        return Comment::all();
    }

    public static function store( $request )
    {
        return Comment::create( $request->all() );
    }

    public static function update( $request, $comment )
    {

        if ( $request->has( 'comment' ) ) {
            $comment->comment = $request->comment;
        }

        if ( $request->has( 'project_id' ) ) {
            $comment->project_id = $request->project_id;
        }

        if ( $request->has( 'updated_by' ) ) {
            $comment->updated_by = $request->updated_by;
        }

        if ( $request->has( 'is_active' ) ) {
            $comment->is_active = $request->is_active == 1 ? 1 : 0;
        }

        return $comment->update();
    }

    public static function show( $id )
    {
        $comment = Comment::findOrFail( $id );

        return $comment;
    }

    public static function delete( $comment )
    {
        return $comment->delete();
    }

    public static function findById( $id )
    {
        return Comment::find( $id );
    }

}