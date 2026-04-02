<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\LearningActionsGeneratorAgent;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentLearningActionsGeneratorResult;
use Illuminate\Support\Collection;

$samplePerson = [
    'id' => 'person_001',
    'country' => 'New Zealand',
    'city' => 'Auckland',
    'timezone' => 'Pacific/Auckland',
    'language' => 'en',
];

$samplePreferences = [
    'read' => 'high',
    'listen' => 'medium',
    'watch' => 'medium',
    'e_learning' => 'low',
];

$sampleDomains = [
    [
        'id' => 'ld_001',
        'title' => 'Strategic Leadership',
        'summary' => 'Developing strategic thinking and executive influence.',
        'candidate_description' => 'Build the skills needed for senior leadership.',
        'goal_links' => [
            ['goal_id' => 'goal_001', 'goal_name' => 'Senior Leadership Role', 'link_strength' => 'primary'],
        ],
    ],
];

$sampleRunContext = [
    'run_date' => '2026-03-31',
    'target_total_items' => 5,
];

it('can build learning actions generator agent', function () use ($samplePerson, $samplePreferences, $sampleDomains, $sampleRunContext) {
    $agent = (new AINinja)->agent()
        ->generateLearningActions()
        ->person($samplePerson)
        ->resourcePreferences($samplePreferences)
        ->activeLearningDomains($sampleDomains)
        ->runContext($sampleRunContext);

    expect($agent)->toBeInstanceOf(LearningActionsGeneratorAgent::class);

    $data = $agent->toArray();
    expect($data['endpoint'])->toBe('/agent_learning_actions_generator');
    expect($data['input']['person']['id'])->toBe('person_001');
    expect($data['input']['person']['timezone'])->toBe('Pacific/Auckland');
    expect($data['input']['resource_preferences']['read'])->toBe('high');
    expect($data['input']['active_learning_domains'])->toBeArray();
    expect($data['input']['run_context']['run_date'])->toBe('2026-03-31');
});

it('can set optional existing items and recent coverage', function () use ($samplePerson, $samplePreferences, $sampleDomains, $sampleRunContext) {
    $agent = (new AINinja)->agent()
        ->generateLearningActions()
        ->person($samplePerson)
        ->resourcePreferences($samplePreferences)
        ->activeLearningDomains($sampleDomains)
        ->existingLearningItems([])
        ->recentCoverage(['last_4_weeks' => []])
        ->runContext($sampleRunContext);

    $data = $agent->toArray();
    expect($data['input']['existing_learning_items'])->toBeArray();
    expect($data['input']['recent_coverage'])->toBeArray();
});

it('returns mocked result with weekly learning actions', function () {
    $mocked = (new AINinja)->agent()->generateLearningActions()->getMocked();

    expect($mocked)->toHaveKey('output');
    expect($mocked['output'])->toHaveKey('weekly_learning_actions');
    expect($mocked['output']['weekly_learning_actions'])->toBeArray();
    expect(count($mocked['output']['weekly_learning_actions']))->toBeGreaterThan(0);
    expect($mocked['output'])->toHaveKey('weekly_plan_summary');
    expect($mocked['output'])->toHaveKey('person_id');
    expect($mocked['output'])->toHaveKey('run_date');
});

it('result class can parse mocked data', function () {
    $agent = (new AINinja)->agent()->generateLearningActions();

    $result = new AINinjaAgentLearningActionsGeneratorResult([
        'status' => 'success',
        'response' => $agent->getMocked(),
    ]);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->getPersonId())->toBeString();
    expect($result->getRunDate())->toBeString();
    expect($result->getWeeklyPlanSummary())->toBeInstanceOf(Collection::class);
    expect($result->getWeeklyLearningActions())->toBeInstanceOf(Collection::class);
    expect($result->getActionCount())->toBeGreaterThan(0);
});
