<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\SuccessProfileMatcherAgent;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentSuccessProfileMatcherResult;

it('can build a success profile matcher agent with required inputs', function () {
    $agent = (new AINinja)->agent()
        ->matchSuccessProfiles()
        ->successProfiles([
            [
                'successprofileid' => 1,
                'name' => 'Senior Developer',
                'requirements' => [
                    'education' => ["Bachelor's degree"],
                    'experience' => ['5+ years development'],
                ],
            ],
        ])
        ->eligiblePersons([
            'person_001' => 'Senior engineer with 10 years experience.',
        ]);

    expect($agent)->toBeInstanceOf(SuccessProfileMatcherAgent::class);

    $data = $agent->toArray();
    expect($data)->toHaveKey('endpoint');
    expect($data['endpoint'])->toBe('/agent_success_profile_matcher');
    expect($data['input']['success_profiles'])->toBeArray();
    expect($data['input']['eligible_persons'])->toBeArray();
});

it('can set cosine similarity threshold', function () {
    $agent = (new AINinja)->agent()
        ->matchSuccessProfiles()
        ->successProfiles([['successprofileid' => 1, 'name' => 'Test', 'requirements' => []]])
        ->eligiblePersons(['p1' => 'Person info'])
        ->cosineSimilarityThreshold(0.7);

    $data = $agent->toArray();
    expect($data['input']['cosine_similarity_threshold'])->toBe(0.7);
});

it('returns mocked result with final matches', function () {
    $agent = (new AINinja)->agent()
        ->matchSuccessProfiles()
        ->successProfiles([])
        ->eligiblePersons([]);

    $mocked = $agent->getMocked();
    expect($mocked)->toHaveKey('final_matches');
    expect($mocked['final_matches'])->toBeArray();
    expect(count($mocked['final_matches']))->toBeGreaterThan(0);
});

it('result class can parse mocked data', function () {
    $agent = (new AINinja)->agent()->matchSuccessProfiles();

    $result = new AINinjaAgentSuccessProfileMatcherResult([
        'status' => 'success',
        'response' => $agent->getMocked(),
    ]);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->getFinalMatches())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getMatchCount())->toBeGreaterThan(0);
});

it('can get matches for a specific person', function () {
    $agent = (new AINinja)->agent()->matchSuccessProfiles();

    $result = new AINinjaAgentSuccessProfileMatcherResult([
        'status' => 'success',
        'response' => $agent->getMocked(),
    ]);

    $matches = $result->getMatchesForPerson('person_001');
    expect($matches)->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($matches->count())->toBe(1);

    $noMatches = $result->getMatchesForPerson('nonexistent');
    expect($noMatches->count())->toBe(0);
});
