<?php

use IanRothmann\AINinja\AINinja;
use Illuminate\Support\Collection;

it('can run instrument interpretation processor agent', function () {
    $result = (new AINinja)->agent()
        ->interpretInstruments()
        ->instruments([
            'ptg_personality' => [
                'result' => [
                    'extraversion' => 4.2,
                    'openness' => 3.5,
                    'agreeableness' => 4.0,
                    'conscientiousness' => 3.8,
                ],
                'interpretation' => [
                    'summary' => 'High extraversion, warm and collaborative personality.',
                    'strengths' => 'Builds rapport easily, energises teams, socially adept.',
                    'risks' => 'May talk too much, can overlook quieter voices.',
                ],
            ],
        ])
        ->runAndWait(10);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getInterpretations())->toBeInstanceOf(Collection::class);
        expect($result->getInterpretationCount())->toBeGreaterThanOrEqual(1);
    }
});
