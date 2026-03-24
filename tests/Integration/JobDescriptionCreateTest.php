<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\LangServePhpClient\Responses\RemoteRunnableStreamEvent;

it('can generate a job description', function () {
    $handler = new AINinja;
    $result = $handler->generateJobDescription()
        ->basedOn('A Laravel Developer in PHP')
        ->setTraceId('Test')
        ->stream(function (RemoteRunnableStreamEvent $response) {
            if ($response->getContent()) {
                // dd($response->getContent());
            }
        });

    expect($result->getSummary())->toBeString();
    expect($result->getEducationRequirements())->toBeString();
    expect($result->getExperienceRequirements())->toBeString();
    expect($result->getEducationRequirements())->toBeString();
    // expect($result->getOtherRequirements())->toBeString();
});
