<?php

use IanRothmann\AINinja\AINinja;

it('can transcribe a URL', function () {
    $handler = new AINinja;

    $result = $handler->transcribeURL()
        ->forURL('https://kaggle-audio-files-2.s3.amazonaws.com/03-01-02-01-02-02-05.wav')
        ->withSummary()
        ->withComplement()
        ->withTopics()
        ->withSpeakerContext('The person speaking is Reinhardt')
        ->wasAskedAQuestion('What are the dogs doing?')
        ->get();

    expect($result->getTranscription())->toBeString()
        ->and($result->getSRT())->toBeArray()
        ->and($result->getComplement())->toBeString()
        ->and($result->getSummary())->toBeString()
        ->and($result->transcriptIsWithinQuestionContext())->toBeTrue()
        ->and($result->getValidTranscript())->toBeTrue();

    if ($result->getTopics() !== null) {
        expect($result->getTopics())->toBeArray();
    }
});

it('can detect invalid transcript for white noise', function () {
    $handler = new AINinja;

    $result = $handler->transcribeURL()
        ->forURL('https://public-bucket-for-ai-ninja.s3.us-east-1.amazonaws.com/white-noise-358382.mp3')
        ->withSummary()
        ->withComplement()
        ->withTopics()
        ->withSpeakerContext('The person speaking is Reinhardt')
        ->wasAskedAQuestion('What are the dogs doing?')
        ->get();

    expect($result->getValidTranscript())->toBeFalse();
});
