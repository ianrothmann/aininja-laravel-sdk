<?php

use IanRothmann\AINinja\AINinja;

it('can transcribe a URL', function () {
    $handler = new AINinja();

    $result = $handler->transcribeURL()
        ->forURL('https://kaggle-audio-files-2.s3.amazonaws.com/03-01-02-01-02-02-05.wav')
        ->withSummary()
        ->withComplement()
        ->withTopics()
        ->withSpeakerContext('The person speaking is Reinhardt')
        ->get();

    expect($result->getTranscription())->toBeString()
        ->and($result->getSRT())->toBeArray()
        ->and($result->getComplement())->toBeString()
        ->and($result->getSummary())->toBeString()
        ->and($result->getTopics())->toBeArray();
});
