<?php

use IanRothmann\AINinja\AINinja;

it('can run personality script generator agent', function () {
    $result = (new AINinja)->agent()
        ->generatePersonalityScript()
        ->firstName('Casey')
        ->candidateContext('Casey is a senior manager known for her high energy, warmth, and ability to bring teams together. She scores high on extraversion and agreeableness.')
        ->fullProfile('Casey presents as a Confident Connector. High extraversion (assertive, gregarious, engaging). High agreeableness (trusting, benevolent, empathic). Moderate conscientiousness.')
        ->personalityLevels([
            'extraversion_level' => 'high',
            'openness_level' => 'moderate',
            'agreeableness_level' => 'high',
            'conscientiousness_level' => 'moderate',
            'assertive_level' => 'high',
            'gregarious_level' => 'high',
            'engaging_level' => 'high',
            'imaginative_level' => 'moderate',
            'variety_seeking_level' => 'moderate',
            'analytical_level' => 'low',
            'trusting_level' => 'high',
            'benevolent_level' => 'high',
            'empathic_level' => 'high',
            'organised_level' => 'moderate',
            'diligent_level' => 'moderate',
            'achieving_level' => 'high',
        ])
        ->runAndWait(10);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getExtraversionScript())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getOpennessScript())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getAgreeablenessScript())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getConscientiousnessScript())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});
