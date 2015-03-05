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
