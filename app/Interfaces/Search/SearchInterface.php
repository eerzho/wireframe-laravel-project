<?php

namespace App\Interfaces\Search;

use Illuminate\Http\Request;

interface SearchInterface
{
    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function search(Request $request);
}
