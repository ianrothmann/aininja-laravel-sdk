<?php

use IanRothmann\AINinja\AINinja;

it('can generate JSON', function () {
    $obj = new AINinja();
    $result=$obj->generateJson()
        ->addInstruction('Generate a list of 10 numbers')
        ->addInstruction('The numbers must be between 1 and 10')
        ->expectJsonStructure([
            'numbers' => ['The array of numbers'],
        ])
        ->get()
        ->getResult();

    expect($result)->toHaveKey('numbers');
});
