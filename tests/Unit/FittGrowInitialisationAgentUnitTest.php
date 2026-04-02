<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\FittGrowInitialisationAgent;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentFittGrowInitialisationResult;
use Illuminate\Support\Collection;

it('can build fitt grow initialisation agent with candidate context', function () {
    $agent = (new AINinja)->agent()
        ->initialiseFittGrow()
        ->candidateContext([
            'bio' => ['name' => 'Alex', 'surname' => 'Morgan', 'country' => 'New Zealand'],
            'experience' => 'Senior manager with 10 years experience.',
            'qualifications' => 'MBA (2018).',
            'output_language_name' => 'British English',
            'output_language_code' => 'en',
        ]);

    expect($agent)->toBeInstanceOf(FittGrowInitialisationAgent::class);

    $data = $agent->toArray();
    expect($data['endpoint'])->toBe('/agent_fitt_grow_initialisation');
    expect($data['input'])->toBeArray();
    expect($data['input']['bio']['name'])->toBe('Alex');
    expect($data['input']['output_language_name'])->toBe('British English');
    expect($data['input']['output_language_code'])->toBe('en');
});

it('returns mocked result with all output sections', function () {
    $mocked = (new AINinja)->agent()->initialiseFittGrow()->getMocked();

    expect($mocked)->toHaveKey('output');
    expect($mocked['output'])->toHaveKey('profile_info');
    expect($mocked['output'])->toHaveKey('profile_strengths');
    expect($mocked['output'])->toHaveKey('career_aspirations');
    expect($mocked['output'])->toHaveKey('development_areas');
    expect($mocked['output'])->toHaveKey('scripts');
});

it('result class can parse mocked data', function () {
    $agent = (new AINinja)->agent()->initialiseFittGrow();

    $result = new AINinjaAgentFittGrowInitialisationResult([
        'status' => 'success',
        'response' => $agent->getMocked(),
    ]);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->getProfileInfo())->toBeInstanceOf(Collection::class);
    expect($result->getProfileStrengths())->toBeInstanceOf(Collection::class);
    expect($result->getCareerAspirations())->toBeInstanceOf(Collection::class);
    expect($result->getDevelopmentAreas())->toBeInstanceOf(Collection::class);
    expect($result->getScripts())->toBeInstanceOf(Collection::class);
    expect($result->getScriptCount())->toBeGreaterThan(0);
});
