<?php

use IanRothmann\AINinja\AINinja;

it('can classify SOC 2018 Occupations based on context', function () {
    $handler = new AINinja;

    $result = $handler->classifyOccupation()
        ->addToContext('role_name', 'Software Engineer')
        ->get();

    expect($result->getCode())->toBe('15-1252');
    expect($result->getName())->toBe('Software Developers');
});
