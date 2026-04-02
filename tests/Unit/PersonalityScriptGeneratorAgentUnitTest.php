<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\PersonalityScriptGeneratorAgent;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentPersonalityScriptGeneratorResult;
use Illuminate\Support\Collection;

$sampleLevels = [
    'extraversion_level' => 'high',
    'openness_level' => 'moderate',
    'agreeableness_level' => 'high',
    'conscientiousness_level' => 'moderate',
    'assertive_level' => 'high',
    'gregarious_level' => 'high',
    'engaging_level' => 'moderate',
    'imaginative_level' => 'moderate',
    'variety_seeking_level' => 'low',
    'analytical_level' => 'moderate',
    'trusting_level' => 'high',
    'benevolent_level' => 'high',
    'empathic_level' => 'high',
    'organised_level' => 'moderate',
    'diligent_level' => 'high',
    'achieving_level' => 'moderate',
];

it('can build personality script generator agent', function () use ($sampleLevels) {
    $agent = (new AINinja)->agent()
        ->generatePersonalityScript()
        ->firstName('Casey')
        ->candidateContext('Casey is an extraverted leader who thrives in social environments.')
        ->fullProfile('High extraversion, warm and collaborative, conscientious and detail-oriented.')
        ->personalityLevels($sampleLevels)
        ->outputLanguageName('British English')
        ->outputLanguageCode('en');

    expect($agent)->toBeInstanceOf(PersonalityScriptGeneratorAgent::class);

    $data = $agent->toArray();
    expect($data['endpoint'])->toBe('/agent_personality_script_generator');
    expect($data['input']['first_name'])->toBe('Casey');
    expect($data['input']['personality_levels'])->toBeArray();
    expect($data['input']['output_language_name'])->toBe('British English');
    expect($data['input']['output_language_code'])->toBe('en');
});

it('returns mocked result with four scripts', function () {
    $mocked = (new AINinja)->agent()->generatePersonalityScript()->getMocked();

    expect($mocked)->toHaveKey('extraversion_script');
    expect($mocked)->toHaveKey('openness_script');
    expect($mocked)->toHaveKey('agreeableness_script');
    expect($mocked)->toHaveKey('conscientiousness_script');
});

it('result class can parse mocked data and return all four scripts', function () {
    $agent = (new AINinja)->agent()->generatePersonalityScript();

    $result = new AINinjaAgentPersonalityScriptGeneratorResult([
        'status' => 'success',
        'response' => $agent->getMocked(),
    ]);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->getExtraversionScript())->toBeInstanceOf(Collection::class);
    expect($result->getOpennessScript())->toBeInstanceOf(Collection::class);
    expect($result->getAgreeablenessScript())->toBeInstanceOf(Collection::class);
    expect($result->getConscientiousnessScript())->toBeInstanceOf(Collection::class);
    expect($result->getScriptTitle('extraversion'))->toBeString();
    expect($result->getScriptText('extraversion'))->toBeString();
    expect($result->getScriptTitle('conscientiousness'))->toBeString();
});
