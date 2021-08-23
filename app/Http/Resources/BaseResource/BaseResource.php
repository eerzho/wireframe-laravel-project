<?php

namespace App\Http\Resources\BaseResource;

use App\Components\DateFormat\DateFormatHelper;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class BaseResource extends JsonResource
{
    abstract public static function getFields(): array;

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $fields = $this->getFields();

        $result = [];
        foreach ($fields as $field) {
            if ($this->$field instanceof \DateTimeInterface) {
                /** @var Carbon $date */
                $date = $this->$field;
                $result[$field] = $date->format(DateFormatHelper::DATETIME_FORMAT);
            } else {
                $result[$field] = $this->$field;
            }
        }

        return $result;
    }
}
