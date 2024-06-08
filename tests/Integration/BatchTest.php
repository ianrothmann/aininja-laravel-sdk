<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\GenerateJsonProcessor;

it('can generate run processors in batches', function () {

    $proc1 = new GenerateJsonProcessor();
    $proc1->addInstruction('Generate a list of 10 numbers')
        ->addInstruction('The numbers must be between 1 and 10')
        ->expectJsonStructure([
            'numbers' => ['The array of numbers'],
        ]);

    $proc2 = new GenerateJsonProcessor();
    $proc2->addInstruction('Generate a list of 10 numbers')
        ->addInstruction('The numbers must be between 1 and 10')
        ->expectJsonStructure([
            'numbers' => ['The array of numbers'],
        ]);

    $obj = new AINinja();
    $results = $obj->batch([$proc1, $proc2])->toArray();

    expect($results)->toBeArray()->toHaveLength(2);
});
