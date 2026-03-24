<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\CareerAspirationExtractorAgent;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentCareerAspirationExtractorResult;

it('can build career aspiration extractor agent with candidate context', function () {
    $agent = (new AINinja)->agent()
        ->extractCareerAspirations()
        ->candidateContext([
            'bio' => ['name' => 'Alex', 'surname' => 'Morgan'],
            'experience' => 'Senior software engineer with 8 years experience.',
            'qualifications' => 'BSc Computer Science.',
        ]);

    expect($agent)->toBeInstanceOf(CareerAspirationExtractorAgent::class);

    $data = $agent->toArray();
    expect($data['endpoint'])->toBe('/agent_career_aspiration_extractor');
    expect($data['input']['input'])->toBeArray();
    expect($data['input']['input']['bio']['name'])->toBe('Alex');
});

it('returns mocked result with aspirations', function () {
    $agent = (new AINinja)->agent()->extractCareerAspirations();
    $mocked = $agent->getMocked();

    expect($mocked)->toHaveKey('output');
    expect($mocked['output'])->toHaveKey('aspirations');
    expect($mocked['output']['aspirations'])->toBeArray();
    expect(count($mocked['output']['aspirations']))->toBeGreaterThan(0);
});

it('result class can parse mocked data', function () {
    $agent = (new AINinja)->agent()->extractCareerAspirations();

    $result = new AINinjaAgentCareerAspirationExtractorResult([
        'status' => 'success',
        'response' => $agent->getMocked(),
    ]);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->getAspirations())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getAspirations()->count())->toBeGreaterThan(0);
    expect($result->getVersion())->toBe('v1');
    expect($result->getAssessmentDateUsed())->toBeString();
});
