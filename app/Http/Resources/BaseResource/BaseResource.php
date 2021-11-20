<?php

namespace App\Http\Resources\BaseResource;

use App\Components\DateFormat\DateFormatHelper;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseResource extends JsonResource
{
    abstract public static function getFields(): array;

    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $fields = $this->getFields();

        $result = [];
        foreach ($fields as $field) {
            if ($this->$field instanceof DateTimeInterface) {
                /** @var Carbon $date */
                $date = $this->$field;
                $result[$field] = $date->format(DateFormatHelper::DATETIME_FORMAT);
            } else {
                $result[$field] = $this->$field;
            }
        }

        return $result;
    }

    /**
     * @param mixed $resource
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public static function collection($resource)
    {
        if ($resource instanceof LengthAwarePaginator) {
            header('x-pagination-total:' . $resource->total());
            header('x-pagination-current-page:' . $resource->currentPage());
            header('x-pagination-per-page:' . $resource->perPage());
            $resource = $resource->getCollection();
        }

        return parent::collection($resource);
    }
}
