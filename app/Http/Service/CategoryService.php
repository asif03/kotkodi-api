<?php

namespace App\Http\Service;

use App\Http\Repository\CategoryRepository;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Response;

class CategoryService
{
    use RespondsWithHttpStatus;

    public function index()
    {
        $category = CategoryRepository::index();
        return $this->success( new CategoryCollection( $category ), Response::HTTP_OK );
    }

    /**
     * @OA\Schema(
     *      schema="Category",
     *      title="Category",
     *      description="Category create request body",
     *      type="object",
     *      @OA\Property(
     *          property="category_name",
     *          description="Name of project category",
     *          example="Art",
     *          type="string"
     *      )
     * )
     */
    public function create( $request )
    {
        $country = CategoryRepository::store( $request );

        if ( $country ) {
            return $this->success( trans( 'messages.create' ), Response::HTTP_CREATED );
        }

    }

    /**
     * @OA\Schema(
     *      schema="UpdateCategory",
     *      title="Update Category",
     *      description="Category update request body",
     *      type="object",
     *     @OA\Property(
     *          property="id",
     *          description="ID of category",
     *          example="2",
     *          type="integer"
     *      ),
     *      @OA\Property(
     *          property="category_name",
     *          description="Name of category",
     *          example="Bangladesh",
     *          type="string"
     *      )
     * )
     */
    public function update( $request )
    {
        $category = CategoryRepository::findById( $request->id );

        if ( !$category ) {
            return $this->success( trans( 'messages.notFound' ), Response::HTTP_NOT_FOUND );
        }

        if ( $category ) {
            $isUpdate = CategoryRepository::update( $request, $category );

            if ( $isUpdate ) {
                return $this->success( trans( 'messages.update' ), Response::HTTP_OK );
            }

        }

    }

    public function show( $id )
    {
        $category = CategoryRepository::findById( $id );

        if ( !$category ) {
            return $this->success( trans( 'messages.notFound' ), Response::HTTP_NOT_FOUND );
        }

        return $this->success( new CategoryResource( $category ), Response::HTTP_OK );
    }

    public function delete( $id )
    {
        $country = CategoryRepository::findById( $id );

        if ( !$country ) {
            return $this->success( trans( 'messages.notFound' ), Response::HTTP_NOT_FOUND );
        }

        return $this->success( CategoryRepository::delete( $country ) );
    }

}