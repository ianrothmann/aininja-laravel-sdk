<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\DevelopmentProposalMatcherAgent;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentDevelopmentProposalMatcherResult;
use Illuminate\Support\Collection;

$sampleGoals = [
    ['id' => 'goal_001', 'name' => 'Lead with clarity and decisiveness', 'description' => 'Build the ability to make firm decisions quickly.'],
    ['id' => 'goal_002', 'name' => 'Shape a compelling vision for finance transformation', 'description' => 'Develop a clear forward-looking point of view.'],
];

$sampleProposals = [
    ['id' => 'proposal_001', 'name' => 'Complete an Internal Collaboration Project', 'description' => 'Lead a cross-functional piece of work.', 'rationale' => 'Builds decision-making under real conditions.', 'category' => 'experience'],
    ['id' => 'proposal_002', 'name' => 'Improve patience while bringing the team along', 'description' => 'Practise landing decisions clearly.', 'rationale' => 'Maintains momentum without losing people.', 'category' => 'experience'],
    ['id' => 'proposal_003', 'name' => 'Publish a CFO POV on AI Operating Models', 'description' => 'Author a concise viewpoint with a client or ex-CFO.', 'rationale' => 'Builds visible thought leadership.', 'category' => 'exposure'],
];

it('can build development proposal matcher agent', function () use ($sampleGoals, $sampleProposals) {
    $agent = (new AINinja)->agent()
        ->matchDevelopmentProposals()
        ->developmentGoals($sampleGoals)
        ->developmentProposals($sampleProposals);

    expect($agent)->toBeInstanceOf(DevelopmentProposalMatcherAgent::class);

    $data = $agent->toArray();
    expect($data['endpoint'])->toBe('/agent_development_proposal_matcher');
    expect($data['input']['development_goals'])->toBeArray();
    expect($data['input']['development_goals'][0]['id'])->toBe('goal_001');
    expect($data['input']['development_proposals'])->toBeArray();
    expect(count($data['input']['development_proposals']))->toBe(3);
});

it('can build agent with only goals or only proposals', function () use ($sampleGoals) {
    $agent = (new AINinja)->agent()
        ->matchDevelopmentProposals()
        ->developmentGoals($sampleGoals);

    $data = $agent->toArray();
    expect($data['input']['development_goals'])->toBeArray();
    expect(isset($data['input']['development_proposals']))->toBeFalse();
});

it('returns mocked result with goal matches', function () {
    $mocked = (new AINinja)->agent()->matchDevelopmentProposals()->getMocked();

    expect($mocked)->toHaveKey('output');
    expect($mocked['output'])->toHaveKey('goal_matches');
    expect($mocked['output'])->toHaveKey('unmatched_goal_ids');
    expect($mocked['output'])->toHaveKey('unmatched_action_ids');
    expect($mocked['output']['goal_matches'])->toBeArray();
    expect(count($mocked['output']['goal_matches']))->toBeGreaterThan(0);
});

it('result class can parse mocked data', function () {
    $agent = (new AINinja)->agent()->matchDevelopmentProposals();

    $result = new AINinjaAgentDevelopmentProposalMatcherResult([
        'status' => 'success',
        'response' => $agent->getMocked(),
    ]);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->getGoalMatches())->toBeInstanceOf(Collection::class);
    expect($result->getUnmatchedGoalIds())->toBeInstanceOf(Collection::class);
    expect($result->getUnmatchedProposalIds())->toBeInstanceOf(Collection::class);
    expect($result->getMatchCount())->toBeGreaterThan(0);
});
