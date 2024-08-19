<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\GenerateJsonProcessor;
use IanRothmann\AINinja\Processors\GenerateTextProcessor;

it('can generate run processors in async pools', function () {
    $startTime = microtime(true);

    $proc1 = new GenerateJsonProcessor;
    $proc1->addInstruction('Generate a list of 10 numbers')
        ->addInstruction('The numbers must be between 1 and 10')
        ->expectJsonStructure([
            'numbers' => ['The array of numbers'],
        ]);

    $proc2 = new GenerateTextProcessor;
    $proc2->addInstruction('Generate a list of 10 numbers')
        ->addInstruction('The numbers must be between 1 and 10');

    $obj = new AINinja;
    $results = $obj->pool([$proc1, $proc2])->toArray();

    // End timing
    $endTime = microtime(true);

    // Calculate execution time
    $executionTime = $endTime - $startTime;

    expect($results)->toBeArray()->toHaveLength(2);
});
