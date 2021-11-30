<?php

namespace App\Http\Resources\BaseResource;

use App\Components\DateFormat\DateFormatHelper;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Collection;
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
        foreach ($fields as $key => $field) {

            if (class_exists($field)) {

                $result[$key] = $this->$key instanceof Collection ?
                    $field::collection($this->$key) :
                    new $field($this->$key);

            } elseif ($this->$field instanceof DateTimeInterface) {

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
            header('X-Pagination-Total:' . $resource->total());
            header('X-Pagination-Current-Page:' . $resource->currentPage());
            header('X-Pagination-Per-Page:' . $resource->perPage());
            $resource = $resource->getCollection();
        }

        return parent::collection($resource);
    }
}
