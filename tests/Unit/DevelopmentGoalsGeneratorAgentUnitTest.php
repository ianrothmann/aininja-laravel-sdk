<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\DevelopmentGoalsGeneratorAgent;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentDevelopmentGoalsGeneratorResult;
use Illuminate\Support\Collection;

$sampleCurrentState = [
    'strengths' => [
        ['title' => 'Applies structure and prioritises to deliver results', 'summary' => 'Consistently brings order and focus to complex, multi-workstream engagements.'],
    ],
    'development_areas' => [
        ['title' => 'Letting collaboration slow bold decisions', 'summary' => 'Tendency to seek consensus can delay decisive action in high-stakes situations.'],
    ],
    'instrument_interpretations' => [],
];

$sampleFutureState = [
    'aspirations' => [
        ['title' => 'Move into a CFO transformation leadership role', 'summary' => 'Lead large-scale finance transformation programmes at executive level.'],
    ],
];

it('can build development goals generator agent', function () use ($sampleCurrentState, $sampleFutureState) {
    $agent = (new AINinja)->agent()
        ->generateDevelopmentGoals()
        ->currentState($sampleCurrentState)
        ->futureState($sampleFutureState);

    expect($agent)->toBeInstanceOf(DevelopmentGoalsGeneratorAgent::class);

    $data = $agent->toArray();
    expect($data['endpoint'])->toBe('/agent_development_goals_generator');
    expect($data['input']['current_state']['strengths'])->toBeArray();
    expect($data['input']['current_state']['development_areas'])->toBeArray();
    expect($data['input']['future_state']['aspirations'])->toBeArray();
    expect($data['input']['future_state']['aspirations'][0]['title'])->toBe('Move into a CFO transformation leadership role');
});

it('can set optional person context and optional context', function () use ($sampleCurrentState, $sampleFutureState) {
    $agent = (new AINinja)->agent()
        ->generateDevelopmentGoals()
        ->personContext(['name' => 'Alex', 'current_role' => 'Senior Engineer'])
        ->currentState($sampleCurrentState)
        ->futureState($sampleFutureState)
        ->optionalContext(['target_roles' => [['title' => 'VP Engineering', 'summary' => 'Lead engineering org.']]]);

    $data = $agent->toArray();
    expect($data['input']['person_context']['name'])->toBe('Alex');
    expect($data['input']['optional_context']['target_roles'])->toBeArray();
});

it('returns mocked result with development goals', function () {
    $mocked = (new AINinja)->agent()->generateDevelopmentGoals()->getMocked();

    expect($mocked)->toHaveKey('output');
    expect($mocked['output'])->toHaveKey('development_goals');
    expect($mocked['output']['development_goals'])->toBeArray();
    expect(count($mocked['output']['development_goals']))->toBeGreaterThan(0);
    expect($mocked['output'])->toHaveKey('rejected_candidate_goals');
    expect($mocked['output'])->toHaveKey('development_goal_generation_version');
});

it('result class can parse mocked data', function () {
    $agent = (new AINinja)->agent()->generateDevelopmentGoals();

    $result = new AINinjaAgentDevelopmentGoalsGeneratorResult([
        'status' => 'success',
        'response' => $agent->getMocked(),
    ]);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->getGenerationVersion())->toBeString();
    expect($result->getDevelopmentGoals())->toBeInstanceOf(Collection::class);
    expect($result->getRejectedCandidateGoals())->toBeInstanceOf(Collection::class);
    expect($result->getGoalCount())->toBeGreaterThan(0);
});
