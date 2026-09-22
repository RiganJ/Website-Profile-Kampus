<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminTable
{
    /** @param list<string> $columns Trusted model columns, optionally relation.column. */
    public static function paginate(Builder $query, array $columns, string $name, int $default = 10): LengthAwarePaginator
    {
        $input = request()->query($name.'_search', '');
        $search = is_string($input) ? mb_substr(trim($input), 0, 150) : '';
        $requestedSize = request()->query($name.'_per_page', $default);
        $perPage = is_scalar($requestedSize) ? (int) $requestedSize : $default;
        $perPage = in_array($perPage, [5, 10, 25, 50], true) ? $perPage : $default;

        if ($search !== '') {
            $query->where(function (Builder $filter) use ($columns, $search): void {
                foreach ($columns as $column) {
                    if (str_contains($column, '.')) {
                        [$relation, $attribute] = explode('.', $column, 2);
                        $filter->orWhereHas($relation, fn (Builder $related) => $related->where($attribute, 'like', '%'.$search.'%'));
                    } else {
                        $filter->orWhere($column, 'like', '%'.$search.'%');
                    }
                }
            });
        }

        // Stable ordering when several records have identical timestamps.
        $query->orderByDesc($query->getModel()->getQualifiedKeyName());

        return $query->paginate($perPage, ['*'], $name.'_page')->withQueryString();
    }
}
