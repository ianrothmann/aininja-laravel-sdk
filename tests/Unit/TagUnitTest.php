<?php

use IanRothmann\AINinja\AINinja;

it('can assign tags to text', function () {
    $handler = new AINinja;

    $result = $handler->assignTags()
        ->addCategory('1', 'Country')
        ->addTag('1', 'a', 'South Africa')
        ->addTag('1', 'b', 'United Arab Emirates')
        ->addCategory('2', 'Topic')
        ->addTag('2', 'c', 'Tax')
        ->addTag('2', 'd', 'Accounting')
        ->basedOn("I am from South Africa and I am an accountant")
        ->get();
    expect($result->getTagsForCategory('2')->first())->toEqual('f');
    expect($result->getCategories()->toArray())->toBeArray();
});
