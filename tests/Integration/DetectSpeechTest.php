<?php

use IanRothmann\AINinja\AINinja;

it('can detect speech from an audio URL', function () {
    $handler = new AINinja;

    $result = $handler->detectSpeech()
        ->onUrl('https://kaggle-audio-files-2.s3.amazonaws.com/03-01-02-01-02-02-05.wav')
        ->get();

    expect($result->getTotalSpeechSeconds())->toBeNumeric()
        ->and($result->getTimestamps()->toArray())->toBeArray()->not()->toBeEmpty();
});
