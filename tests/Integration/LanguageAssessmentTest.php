<?php

use IanRothmann\AINinja\AINinja;

it('can assess language proficiency', function () {
    $handler = new AINinja();

    $result = $handler->assessLanguage()
        ->forURL('https://ain-public.s3.eu-west-1.amazonaws.com/speech.mp3')
        ->forLanguage('en-US')
        ->aboutTopic("Today's tasks at work")
        ->get();

    expect($result->getTranscription())->toBeString()
        ->and($result->wasSuccessful())->toBeBool()
        ->and($result->getConfidence())->toBeFloat()
        ->and($result->getOverallScore())->toBeFloat();
});
