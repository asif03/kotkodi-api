<?php

namespace App\Http\Repository;

use App\Models\File;

class FileRepository extends CommonRepository
{
    public function __construct()
    {
        parent::__construct();
        //
    }

    public static function findById($id)
    {
        return File::find($id);
    }

    public static function delete($file)
    {
        unlink($file->path);
        $file->delete();
        return true;
    }
}
