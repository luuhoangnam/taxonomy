<?php

namespace Namest\Taxonomy;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Taxonomy
 *
 * @property string name
 * @property int    id
 * @property string description
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package Namest\Taxonomy
 *
 */
class Taxonomy extends Model
{
    /**
     * @return HasMany
     */
    public function terms()
    {
        return $this->hasMany(Term::class);
    }
}
