<?php

use IanRothmann\AINinja\AINinja;

it('can merge lists and provide ids', function () {
    $handler = new AINinja;

    $result = $handler->mergeLists()
        ->addToMasterList(1, 'John Doe')
        ->addToMasterList(2, 'Jane Doe')
        ->addToAuxList(3, 'John Doe')
        ->addToAuxList(4, 'Jane Doe')
        ->get();
    expect($result->getResult()->toArray())->toBeArray()->toHaveLength(2);
});
