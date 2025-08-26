<?php

use IanRothmann\AINinja\AINinja;

it('can run an agent to create a dub with minimal parameters', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->createDub()
        ->withAudioUrl('https://example.com/audio.mp3')
        ->withSourceLanguage('en')
        ->withTargetLanguage('es')
        ->runAndWait(3);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getDubbedAudioUrl())->toBeString();
    expect($result->getDubbedTranscript())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getSourceTranscript())->toBeInstanceOf(\Illuminate\Support\Collection::class);
});

it('can run an agent to create a dub with source subtitles', function () {
    $handler = new AINinja;

    $sourceSubtitles = [
        [
            'text' => 'Hello world',
            'start' => 0.0,
            'end' => 2.5,
        ],
        [
            'text' => 'This is a test',
            'start' => 2.5,
            'end' => 5.0,
        ],
    ];

    $result = $handler->agent()
        ->createDub()
        ->withAudioUrl('https://example.com/audio.mp3')
        ->withSourceLanguage('en')
        ->withTargetLanguage('fr')
        ->withSourceSubtitles($sourceSubtitles)
        ->runAndWait(3);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getDubbedAudioUrl())->toBeString();
    expect($result->getDubbedSubtitles())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getSourceSubtitles())->toBeInstanceOf(\Illuminate\Support\Collection::class);
});
