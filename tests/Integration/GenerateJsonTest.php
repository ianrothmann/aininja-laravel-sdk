<?php

use IanRothmann\AINinja\AINinja;

it('can generate JSON without reasoning', function () {
    $obj = new AINinja;
    $result = $obj->generateJson()
        ->addInstruction('Generate a list of 10 numbers')
        ->addInstruction('The numbers must be between 1 and 10')
        ->withoutReasoning()
        ->expectJsonStructure([
            'numbers' => ['The array of numbers'],
        ])
        ->get()
        ->getResult();

    expect($result->toArray())->toHaveKey('numbers');
});

it('can generate JSON with default reasoning', function () {
    $obj = new AINinja;
    $result = $obj->generateJson()
        ->addInstruction('Generate a list of 10 numbers')
        ->addInstruction('The numbers must be between 1 and 10')
        ->expectJsonStructure([
            'numbers' => ['The array of numbers'],
        ])
        ->get()
        ->getResult();

    expect($result->toArray())->toHaveKey('numbers');
});

it('can generate JSON with advanced mode', function () {
    $obj = new AINinja;
    $result = $obj->generateJson()
        ->addInstruction('Generate a list of 10 numbers')
        ->addInstruction('The numbers must be between 1 and 10')
        ->expectJsonStructure([
            'numbers' => ['The array of numbers'],
        ])
        ->useAdvancedMode()
        ->get()
        ->getResult();

    expect($result->toArray())->toHaveKey('numbers');
});

it('can generate JSON with quick mode', function () {
    $obj = new AINinja;
    $result = $obj->generateJson()
        ->addInstruction('Generate a list of 10 numbers')
        ->addInstruction('The numbers must be between 1 and 10')
        ->expectJsonStructure([
            'numbers' => ['The array of numbers'],
        ])
        ->useQuickMode()
        ->get()
        ->getResult();

    expect($result->toArray())->toHaveKey('numbers');
});
