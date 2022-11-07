<?php

namespace App\Services;

use App\Models\Tag;
use ErrorException;

class TagService{

    public function delete(Tag $tag)
    {
        $tag->deleteorFail();
    }
}
