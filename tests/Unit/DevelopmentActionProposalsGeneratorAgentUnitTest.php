<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\DevelopmentActionProposalsGeneratorAgent;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentDevelopmentActionProposalsGeneratorResult;
use Illuminate\Support\Collection;

$sampleProfile = [
    'language_id' => 'en',
    'name' => 'Alex',
    'surname' => 'Smith',
    'current_position' => 'Senior Engineer',
    'current_organization' => 'Acme Technologies',
    'country' => 'South Africa',
];

$sampleGoals = [
    ['id' => 'goal_001', 'name' => 'Lead with clarity and decisiveness', 'description' => 'Build the ability to make firm decisions quickly.'],
];

$sampleGenerationRequest = [
    'mode' => 'mixed',
    'max_total' => 6,
    'novelty_threshold' => 'strict',
];

it('can build development action proposals generator agent', function () use ($sampleProfile, $sampleGoals, $sampleGenerationRequest) {
    $agent = (new AINinja)->agent()
        ->generateDevelopmentActionProposals()
        ->profile($sampleProfile)
        ->developmentGoals($sampleGoals)
        ->generationRequest($sampleGenerationRequest);

    expect($agent)->toBeInstanceOf(DevelopmentActionProposalsGeneratorAgent::class);

    $data = $agent->toArray();
    expect($data['endpoint'])->toBe('/agent_development_action_proposals_generator');
    expect($data['input']['profile']['name'])->toBe('Alex');
    expect($data['input']['development_goals'][0]['id'])->toBe('goal_001');
    expect($data['input']['generation_request']['mode'])->toBe('mixed');
});

it('can set optional contexts, existing proposals and actions', function () use ($sampleProfile, $sampleGoals, $sampleGenerationRequest) {
    $agent = (new AINinja)->agent()
        ->generateDevelopmentActionProposals()
        ->profile($sampleProfile)
        ->contexts(['growth_insights.strengths' => ['label' => 'Strengths', 'catalog' => 'Growth Insights', 'entries' => []]])
        ->developmentGoals($sampleGoals)
        ->existingProposals([])
        ->existingActions([])
        ->generationRequest($sampleGenerationRequest);

    $data = $agent->toArray();
    expect($data['input']['contexts'])->toBeArray();
    expect($data['input']['existing_proposals'])->toBeArray();
    expect($data['input']['existing_actions'])->toBeArray();
});

it('returns mocked result with proposals and summary', function () {
    $mocked = (new AINinja)->agent()->generateDevelopmentActionProposals()->getMocked();

    expect($mocked)->toHaveKey('output');
    expect($mocked['output'])->toHaveKey('proposals');
    expect($mocked['output'])->toHaveKey('summary');
    expect($mocked['output']['proposals'])->toBeArray();
    expect(count($mocked['output']['proposals']))->toBeGreaterThan(0);
    expect($mocked['output']['summary'])->toHaveKey('mode_used');
    expect($mocked['output']['summary'])->toHaveKey('generated_count');
});

it('result class can parse mocked data', function () {
    $agent = (new AINinja)->agent()->generateDevelopmentActionProposals();

    $result = new AINinjaAgentDevelopmentActionProposalsGeneratorResult([
        'status' => 'success',
        'response' => $agent->getMocked(),
    ]);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->getSummary())->toBeInstanceOf(Collection::class);
    expect($result->getProposals())->toBeInstanceOf(Collection::class);
    expect($result->getProposalCount())->toBeGreaterThan(0);
});
