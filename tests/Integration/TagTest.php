<?php

use IanRothmann\AINinja\AINinja;

it('can assign tags to text', function () {
    $handler = new AINinja;

    $result = $handler->assignTags()
        ->addCategory('1', 'Country')
        ->addTag('1', 'za', 'South Africa')
        ->addTag('1', 'ae', 'United Arab Emirates')
        ->addCategory('2', 'Topic')
        ->addTag('2', 'tax', 'Tax')
        ->addTag('2', 'acc', 'Accounting')
        ->basedOn('I am from South Africa and I am an accountant')
        ->get();

    expect($result->getCategories()->toArray())->toBeArray();
});
