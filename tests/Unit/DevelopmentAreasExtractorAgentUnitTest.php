<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\DevelopmentAreasExtractorAgent;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentDevelopmentAreasExtractorResult;
use Illuminate\Support\Collection;

it('can build development areas extractor agent with candidate context', function () {
    $agent = (new AINinja)->agent()
        ->extractDevelopmentAreas()
        ->candidateContext([
            'bio' => ['name' => 'Sam', 'surname' => 'Taylor'],
            'experience' => 'Manager with 6 years experience.',
        ]);

    expect($agent)->toBeInstanceOf(DevelopmentAreasExtractorAgent::class);

    $data = $agent->toArray();
    expect($data['endpoint'])->toBe('/agent_development_areas_extractor');
    expect($data['input']['input'])->toBeArray();
});

it('returns mocked result with development areas', function () {
    $mocked = (new AINinja)->agent()->extractDevelopmentAreas()->getMocked();

    expect($mocked)->toHaveKey('output');
    expect($mocked['output'])->toHaveKey('development_areas');
    expect($mocked['output']['development_areas'])->toBeArray();
    expect(count($mocked['output']['development_areas']))->toBeGreaterThan(0);
    expect($mocked['output'])->toHaveKey('rejected_candidate_themes');
});

it('result class can parse mocked data', function () {
    $agent = (new AINinja)->agent()->extractDevelopmentAreas();

    $result = new AINinjaAgentDevelopmentAreasExtractorResult([
        'status' => 'success',
        'response' => $agent->getMocked(),
    ]);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->getDevelopmentAreas())->toBeInstanceOf(Collection::class);
    expect($result->getDevelopmentAreas()->count())->toBeGreaterThan(0);
    expect($result->getRejectedThemes())->toBeInstanceOf(Collection::class);
    expect($result->getVersion())->toBe('v1.1');
});
