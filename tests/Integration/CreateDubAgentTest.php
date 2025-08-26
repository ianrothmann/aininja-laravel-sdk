<?php

use IanRothmann\AINinja\AINinja;

it('can run an agent to create a dub from audio', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->createDub()
        ->withAudioUrl('https://public-bucket-for-ai-ninja.s3.us-east-1.amazonaws.com/ev_voice_test_en.mp3')
        ->withSourceLanguage('en')
        ->withTargetLanguage('es')
        ->setTraceId('CreateDubAgentTest')
        ->runAndWait(5);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getDubbedAudioUrl())->toBeString();
        expect($result->getDubbedTranscript())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getDubbedSubtitles())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getSourceTranscript())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getSourceSubtitles())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getDubbedSubtitles()->count())->toBeGreaterThan(0);
        if ($result->getDubbedSubtitles()->count() > 0) {
            $firstSubtitle = $result->getDubbedSubtitles()->first();
            expect($firstSubtitle)->toHaveKeys(['text', 'start', 'end']);
            expect($firstSubtitle['text'])->toBeString();
            expect($firstSubtitle['start'])->toBeNumeric();
            expect($firstSubtitle['end'])->toBeNumeric();
        }
    }
});
