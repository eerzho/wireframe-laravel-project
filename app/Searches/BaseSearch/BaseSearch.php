<?php

namespace App\Searches\BaseSearch;

use App\Components\DateFormat\DateFormatHelper;
use App\Rules\SearchValidateIntegerRule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * @property Builder $builder
 * @property array   $searches
 * @property string  $sort
 */
abstract class BaseSearch
{
    private Builder $builder;
    private array $searches;
    private ?string $sort;

    /**
     * @return string
     */
    abstract protected function getNamespace(): string;

    /**
     * @return string
     */
    abstract protected function getModel(): string;

    /**
     * @return array
     */
    abstract protected function getSorts(): array;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->builder = app($this->getModel())->newQuery();
        $this->searches = $request->query('search', []);
        $this->sort = $request->query('sort');
    }

    /**
     * @return Builder
     */
    public function getQuery(): Builder
    {
        if ($this->isValidSearches()) {
            return $this->builder->whereRaw('0=1');
        }

        return $this->applyDecoratorsFromRequest();
    }

    /**
     * @return Builder
     */
    private function applyDecoratorsFromRequest(): Builder
    {
        foreach ($this->searches as $filterName => $value) {

            if (class_exists($decorator = $this->createFilterDecorator($filterName))) {
                $this->builder = $decorator::apply($this->builder, $value);

            } elseif (class_exists($decorator = $this->createFilterDecorator($filterName, true))) {
                $this->builder = $decorator::apply($this->builder, $value);
            }
        }

        if (in_array($this->sort, $this->getSorts())) {

            if ($isDesc = substr($this->sort, 0, 1) == '-') {
                $this->sort = substr($this->sort, 1, strlen($this->sort));
            }

            $this->builder->orderBy($this->sort, $isDesc ? 'asc' : 'desc');
        }

        return $this->builder;
    }

    /**
     * @param string $name
     * @param bool   $default
     *
     * @return string
     */
    private function createFilterDecorator(string $name, bool $default = false): string
    {
        return ($default ? __NAMESPACE__ : $this->getNamespace()) . '\\Filters\\' . Str::studly($name);
    }

    /**
     * @return bool
     */
    private function isValidSearches(): bool
    {
        if ($this->searches && $this->validationRules()) {

            $validator = Validator::make($this->searches, $this->validationRules());

            return $validator->fails();
        }

        return false;
    }

    /**
     * @return array
     */
    protected function validationRules(): array
    {
        return [
            'id'                         => new SearchValidateIntegerRule(),
            'period_created_at'          => 'array',
            'period_created_at.start_at' => [
                DateFormatHelper::DATETIME_VALIDATOR_FORMAT,
                'before:period_created_at.end_at',
            ],
            'period_created_at.end_at'   => [
                DateFormatHelper::DATETIME_VALIDATOR_FORMAT,
                'after:period_created_at.start_at',
            ],
            'period_updated_at'          => 'array',
            'period_updated_at.start_at' => [
                DateFormatHelper::DATETIME_VALIDATOR_FORMAT,
                'before:period_updated_at.end_at',
            ],
            'period_updated_at.end_at'   => [
                DateFormatHelper::DATETIME_VALIDATOR_FORMAT,
                'after:period_updated_at.start_at',
            ]
        ];
    }
}
