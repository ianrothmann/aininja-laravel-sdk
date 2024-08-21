<?php

use IanRothmann\AINinja\AINinja;

it('can split names and surnames', function () {
    $handler = new AINinja;

    $result = $handler->splitNamesAndSurnames()
        ->addName(1, 'John Doe')
        ->addName(2, 'Jane Doe')
        ->get();

    expect($result->getResult()->toArray())->toBeArray()->toHaveLength(2);
});
