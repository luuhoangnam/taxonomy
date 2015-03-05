<?php

namespace Namest\Taxonomy;

/**
 * Trait TermTrait
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package Namest\Taxonomy
 *
 */
trait TermTrait
{
    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootTermTrait()
    {
        static::addGlobalScope(new TermScope);
    }
}
