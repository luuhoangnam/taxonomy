<?php

namespace Namest\Taxonomy;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Namest\Sluggable\HasSlug;

/**
 * Class Term
 *
 * @property int             taxonomy_id
 * @property string          name
 * @property-read $this      parent
 * @property-read Collection childs
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package Namest\Taxonomy
 *
 */
abstract class Term extends Model
{
    use TermTrait, HasSlug;

    protected $table = 'terms';

    protected $taxonomyId;

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->taxonomyId = $this->getTaxonomyId();
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function getTaxonomyId()
    {
        if (is_null($this->taxonomyId))
            throw new \LogicException('Taxonomy ID is not set for this taxonomy.
                                       Declare: "protected $taxonomyId = <id>;" in model');

        return $this->taxonomyId;
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($term) {
            /** @var Term $term */
            $term->taxonomy_id = $term->getTaxonomyId();

            return $term;
        });
    }

    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(get_class($this), 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function childs()
    {
        return $this->hasMany(get_class($this), 'parent_id');
    }
}
