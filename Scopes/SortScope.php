<?php

namespace Laragle\Support\Scopes;

trait SortScope
{
    public function scopeSort($query, $sorters)
    {
        $columns = $this->getConnection()
                        ->getSchemaBuilder()
                        ->getColumnListing($this->getTable());

        if (is_null($sorters)) {
            $sorters = [['column' => 'id', 'direction' => 'desc']];
        }
        
        foreach ($sorters as $key => $sorter) {
            $column = $sorter['column'] ?? $sorter['field'];
            $direction = $sorter['direction'] ?? $sorter['dir'];

            if (in_array($column, $columns)) {
                $query->orderBy($column, $direction);
            }
        }

        return $query;
    }
}