<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\ProfileStrengthExtractorAgent;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentProfileStrengthExtractorResult;
use Illuminate\Support\Collection;

it('can build profile strength extractor agent with candidate context', function () {
    $agent = (new AINinja)->agent()
        ->extractProfileStrengths()
        ->candidateContext([
            'bio' => ['name' => 'Alex', 'surname' => 'Morgan'],
            'experience' => 'Senior engineer with strong leadership track record.',
        ]);

    expect($agent)->toBeInstanceOf(ProfileStrengthExtractorAgent::class);

    $data = $agent->toArray();
    expect($data['endpoint'])->toBe('/agent_profile_strength_extractor');
    expect($data['input']['input'])->toBeArray();
});

it('returns mocked result with strengths', function () {
    $mocked = (new AINinja)->agent()->extractProfileStrengths()->getMocked();

    expect($mocked)->toHaveKey('output');
    expect($mocked['output'])->toHaveKey('strengths');
    expect($mocked['output']['strengths'])->toBeArray();
    expect(count($mocked['output']['strengths']))->toBeGreaterThan(0);
    expect($mocked['output'])->toHaveKey('rejected_candidate_themes');
});

it('result class can parse mocked data', function () {
    $agent = (new AINinja)->agent()->extractProfileStrengths();

    $result = new AINinjaAgentProfileStrengthExtractorResult([
        'status' => 'success',
        'response' => $agent->getMocked(),
    ]);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->getStrengths())->toBeInstanceOf(Collection::class);
    expect($result->getStrengthCount())->toBeGreaterThan(0);
    expect($result->getRejectedThemes())->toBeInstanceOf(Collection::class);
    expect($result->getAssessmentDateUsed())->toBeString();
});
