<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\ExperienceDriversScriptGeneratorAgent;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentExperienceDriversScriptGeneratorResult;
use Illuminate\Support\Collection;

it('can build experience drivers script generator agent', function () {
    $agent = (new AINinja)->agent()
        ->generateExperienceDriversScript()
        ->firstName('Sam')
        ->candidateContext('Sam is a senior engineer who values independence and continuous learning.')
        ->experienceDriverDictionary([
            'AUT' => ['label' => 'Autonomy', 'definition' => 'Need for independence and self-direction.'],
            'GRW' => ['label' => 'Growth', 'definition' => 'Drive to learn and develop skills.'],
            'PRP' => ['label' => 'Purpose', 'definition' => 'Need for meaningful, impactful work.'],
        ])
        ->top3DriverCodes('AUT', 'GRW', 'PRP');

    expect($agent)->toBeInstanceOf(ExperienceDriversScriptGeneratorAgent::class);

    $data = $agent->toArray();
    expect($data['endpoint'])->toBe('/agent_experience_drivers_script_generator');
    expect($data['input']['input']['first_name'])->toBe('Sam');
    expect($data['input']['input']['top_3_driver_codes']['driver1'])->toBe('AUT');
    expect($data['input']['input']['top_3_driver_codes']['driver2'])->toBe('GRW');
    expect($data['input']['input']['top_3_driver_codes']['driver3'])->toBe('PRP');
});

it('returns mocked result with script and title', function () {
    $mocked = (new AINinja)->agent()->generateExperienceDriversScript()->getMocked();

    expect($mocked)->toHaveKey('output');
    expect($mocked['output'])->toHaveKey('title');
    expect($mocked['output'])->toHaveKey('script');
    expect($mocked['output'])->toHaveKey('word_count');
    expect($mocked['output'])->toHaveKey('hidden_interpretation');
});

it('result class can parse mocked data', function () {
    $agent = (new AINinja)->agent()->generateExperienceDriversScript();

    $result = new AINinjaAgentExperienceDriversScriptGeneratorResult([
        'status' => 'success',
        'response' => $agent->getMocked(),
    ]);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->getTitle())->toBeString();
    expect($result->getScript())->toBeString();
    expect($result->getWordCount())->toBeInt();
    expect($result->getHiddenInterpretation())->toBeInstanceOf(Collection::class);
});
