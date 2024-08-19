<?php

use IanRothmann\AINinja\AINinja;

it('can generate interview requirements', function () {
    $handler = new AINinja;

    $result = $handler->generateInterviewRequirements()
        ->basedOn('A Laravel Developer in PHP')
        ->get();

    expect($result->getSummary())->toBeString()
        ->and($result->getRequirements())->toBeString();
});
