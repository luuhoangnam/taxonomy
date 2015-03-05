# Getting Started

Provide an _elegant way_ to interact with taxonomies (tags, category, ...) in your Laravel app.

**Note**: The package is only support Laravel 5

# Installation

**Step 1**: Install package
```bash
composer require namest/taxonomy
```

**Step 2**: Register service provider in your `config/app.php`
```php
return [
    ...
    'providers' => [
        ...
        'Namest\Taxonomy\TaxonomyServiceProvider',
    ],
    ...
];
```

**Step 3**: Publish package migrations. Open your terminal and type:
```bash
php artisan vendor:publish --provider="Namest\Taxonomy\TaxonomyServiceProvider"
```

**Step 4**: Migrate the migration that have been published
```bash
php artisan migrate
```

**Step 5**: Create taxonomies in your terminal by artisan command
```bash
php artisan make:taxonomy Color
```

This command will create a taxonomy in database and  make the `Color` model in app/Color.php to reflect that taxonomy.

**Step 6**: Read API below and start _happy_

# API

```php
$tag = new Tag;
$tag->name = 'new tag';
$tag->slug = 'new-tag';
$tag->save();

$childTag = new Tag;
$childTag->name = 'child tag';
$childTag->slug = 'child-tag';

$childTag = $tag->childs->save($childTag);
$parent = $childTag->parent;
```

```
$tag = Tag::first();
echo $tag->name;
echo $tag->slug;

$childs = $tag->childs;
```

```
// Find tag has slug is 'new-tag'
$tag = Tag::hasSlug('new-tag')->first();
```
