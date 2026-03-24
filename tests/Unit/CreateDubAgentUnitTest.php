<?php

use IanRothmann\AINinja\AINinja;
use Illuminate\Support\Collection;

it('can run an agent to create a dub with minimal parameters', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->createDub()
        ->withAudioUrl('https://example.com/audio.mp3')
        ->withSourceLanguage('en')
        ->withTargetLanguage('es')
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getResult())->toBeInstanceOf(Collection::class);
        expect($result->getDubbedAudioUrl())->toBeString();
        expect($result->getDubbedTranscript())->toBeInstanceOf(Collection::class);
        expect($result->getSourceTranscript())->toBeInstanceOf(Collection::class);

        if ($result->getDubbedSubtitles()->count() > 0) {
            $firstSubtitle = $result->getDubbedSubtitles()->first();
            expect($firstSubtitle)->toHaveKeys(['text', 'start', 'end']);
            expect($firstSubtitle['text'])->toBeString();
            expect($firstSubtitle['start'])->toBeNumeric();
            expect($firstSubtitle['end'])->toBeNumeric();
        }
    }
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
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getResult())->toBeInstanceOf(Collection::class);
        expect($result->getDubbedAudioUrl())->toBeString();
        expect($result->getDubbedSubtitles())->toBeInstanceOf(Collection::class);
        expect($result->getSourceSubtitles())->toBeInstanceOf(Collection::class);

        if ($result->getDubbedSubtitles()->count() > 0) {
            $firstSubtitle = $result->getDubbedSubtitles()->first();
            expect($firstSubtitle)->toHaveKeys(['text', 'start', 'end']);
            expect($firstSubtitle['text'])->toBeString();
            expect($firstSubtitle['start'])->toBeNumeric();
            expect($firstSubtitle['end'])->toBeNumeric();
        }
    }
});
