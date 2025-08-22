<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\VoiceOverProcessor;

it('can generate voice over with text only', function () {
    $handler = new AINinja;

    $result = $handler->generateVoiceOver()
        ->withText('Hello world, this is a test voice over.')
        ->get();

    expect($result->getResult())->toBeArray();
    expect($result->getSubtitles())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getAudioBase64())->toBeString();
});

it('can generate voice over with text and voice', function () {
    $handler = new AINinja;

    $result = $handler->generateVoiceOver()
        ->withText('Hello world, this is a test voice over.')
        ->withVoice(VoiceOverProcessor::VOICE_UK_FEMALE)
        ->get();

    expect($result->getResult())->toBeArray();
    expect($result->getSubtitles())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getAudioBase64())->toBeString();
});

it('can get audio binary data', function () {
    $handler = new AINinja;

    $result = $handler->generateVoiceOver()
        ->withText('Hello world, this is a test voice over.')
        ->get();

    expect($result->getAudioBinary())->toBeString();
});
