<?php

namespace App\Http\Resources\BaseResource;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @property int    $total
 * @property int    $currentPage
 * @property int    $perPage
 * @property string $collects
 */
abstract class BaseCollection extends ResourceCollection
{
    abstract protected function getCollects(): string;

    /**
     * @param LengthAwarePaginator $paginator
     */
    public function __construct(LengthAwarePaginator $paginator)
    {
        $this->total = $paginator->total();
        $this->currentPage = $paginator->currentPage();
        $this->perPage = $paginator->perPage();
        $this->collects = $this->getCollects();

        parent::__construct($paginator->items());
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'meta' => [
                'total'        => $this->total,
                'current_page' => $this->currentPage,
                'per_page'     => $this->perPage,
            ]
        ];
    }
}
