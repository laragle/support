<?php

namespace Laragle\Support\Scopes;

trait SearchScope
{
    public function scopeSearch($query, $q = '')
    {
        if ($q) {
            $columns = $this->getConnection()
                            ->getSchemaBuilder()
                            ->getColumnListing($this->getTable());

            $query->where(function($query) use ($columns, $q) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'like', "%{$q}%");
                }
            });           
        }

        return $query;
    }
}