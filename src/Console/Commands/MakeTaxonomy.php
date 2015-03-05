<?php

namespace Namest\Taxonomy\Console\Commands;

use Illuminate\Console\Command;
use Namest\Taxonomy\Creators\TaxonomyCreator;
use Namest\Taxonomy\Taxonomy;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class MakeTaxonomy
 * @package Namest\Taxonomy\Console\Commands
 */
class MakeTaxonomy extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:taxonomy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new taxonomy like Tag, Category,...';
    /**
     * @var TaxonomyCreator
     */
    private $creator;

    /**
     * Create a new command instance.
     *
     * @param TaxonomyCreator $creator
     */
    public function __construct(TaxonomyCreator $creator)
    {
        parent::__construct();
        $this->creator = $creator;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $name = $this->argument('name');
        list($namespace, $class, $path) = $this->parseClassName($name);

        $taxonomyId = $this->makeTaxonomy($class);

        $data = [
            'class'      => $class,
            'namespace'  => $namespace,
            'path'       => $path,
            'taxonomyId' => $taxonomyId,
        ];

        $this->creator->make('term', $data);

        $this->line("<info>Created Taxonomy:</info> {$data['path']}");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'Taxonomy name.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
//            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }

    /**
     * @param string $name
     *
     * @return array
     */
    private function parseClassName($name)
    {
        $segments  = explode('/', $name);
        $class     = array_pop($segments);
        $namespace = implode("\\", $segments);
        $path      = app_path() . "/{$class}.php";

        return [$namespace, $class, $path];
    }

    /**
     * @param string $name
     *
     * @return int
     */
    private function makeTaxonomy($name)
    {
        $taxonomy = new Taxonomy;

        $taxonomy->name        = $name;
        $taxonomy->description = '';
        $taxonomy->save();

        return $taxonomy->id;
    }

}
