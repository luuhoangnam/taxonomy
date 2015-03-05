<?php

namespace Namest\Taxonomy;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ScopeInterface;

/**
 * Class TermScope
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package Namest\Taxonomy
 *
 */
class TermScope implements ScopeInterface
{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  EloquentBuilder|QueryBuilder $builder
     * @param  Model                        $model
     *
     * @throws \Exception
     */
    public function apply(EloquentBuilder $builder, Model $model)
    {
        /** @var Term $model */
        $taxonomyId = $model->getTaxonomyId();

        $query = $builder->getQuery();

        $columns = [
            'terms.id as id',
            'terms.name as name',
            'terms.created_at as created_at',
            'terms.updated_at as updated_at',
            'terms.taxonomy_id as taxonomy_id',
        ];

        $columns = $query->columns ?: $columns;

        $builder->join('taxonomies', 'taxonomies.id', '=', 'terms.taxonomy_id')
                ->where('taxonomies.id', '=', $taxonomyId)
                ->select($columns);
    }

    /**
     * Remove the scope from the given Eloquent query builder.
     *
     * @param  EloquentBuilder|QueryBuilder $builder
     * @param  Model                        $model
     *
     * @return void
     */
    public function remove(EloquentBuilder $builder, Model $model)
    {

    }
}
