<?php

use IanRothmann\AINinja\AINinja;

it('can generate a job description', function () {
    $handler = new AINinja();

    $result = $handler->generateJobDescription()
        ->basedOn('A Laravel Developer in PHP')
        ->get();

    expect($result->getSummary())->toBeString()
        ->and($result->getEducationRequirements())->toBeString()
        ->and($result->getExperienceRequirements())->toBeString()
        ->and($result->getEducationRequirements())->toBeString()
        ->and($result->getOtherRequirements())->toBeString();
});
