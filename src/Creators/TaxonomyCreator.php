<?php

namespace Namest\Taxonomy\Creators;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Contracts\View\Factory as FactoryContract;
use Namest\Taxonomy\Taxonomy;

/**
 * Class TaxonomyCreator
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package Namest\Taxonomy\Creators
 *
 */
class TaxonomyCreator
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var FactoryContract
     */
    private $renderEngine;

    /**
     * @param Filesystem      $filesystem
     * @param FactoryContract $renderEngine
     */
    public function __construct(Filesystem $filesystem, FactoryContract $renderEngine)
    {
        $this->filesystem   = $filesystem;
        $this->renderEngine = $renderEngine;
    }

    /**
     * @param string $template
     * @param array  $data
     *
     * @return bool
     */
    public function make($template, $data = [])
    {
        $this->renderEngine->addLocation(__DIR__ . '/stubs');

        $contents = $this->renderEngine->make($template, $data)->render();

        $result = file_put_contents($data['path'], $contents);

        return $result;
    }
}
