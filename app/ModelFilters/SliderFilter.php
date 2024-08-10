<?php

namespace App\ModelFilters;

use Illuminate\Database\Eloquent\Builder;
use EloquentFilter\ModelFilter;


class SliderFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     *
     */
    public function search($value)
    {
        $query = $this;
        $fillableColumns = $query->getModel()->getFillable();
        return $query->where(function (Builder $query) use ($fillableColumns, $value) {
            foreach ($fillableColumns as $column) {
                $query->orWhere($column, 'LIKE', '%' . $value . '%');
            }
        });
    }

    public function isActive($value)
    {
        return $this->where('is_active', $value);
    }

    public function position($value)
    {
        return $this->where('position', $value);
    }
}
