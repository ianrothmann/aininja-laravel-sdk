<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\VoiceOverProcessor;

it('can generate voice over from text', function () {
    $handler = new AINinja;

    $result = $handler->generateVoiceOver()
        ->withText('Hello world, this is a test voice over for integration testing.')
        ->setTraceId('VoiceOverTest')
        ->get();

    expect($result->getResult())->toBeArray();
    expect($result->getSubtitles())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getAudioBase64())->toBeString();
    expect($result->getAudioBinary())->toBeString();
});

it('can generate voice over with specific voice', function () {
    $handler = new AINinja;

    $result = $handler->generateVoiceOver()
        ->withText('This is a test with a specific voice.')
        ->withVoice(VoiceOverProcessor::VOICE_US_MALE)
        ->setTraceId('VoiceOverVoiceTest')
        ->get();

    expect($result->getResult())->toBeArray();
    expect($result->getSubtitles())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getAudioBase64())->toBeString();
});
