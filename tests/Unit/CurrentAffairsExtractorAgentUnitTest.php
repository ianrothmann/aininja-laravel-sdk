<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\CurrentAffairsExtractorAgent;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentCurrentAffairsExtractorResult;
use Illuminate\Support\Collection;

$samplePersonContext = [
    'subtitle' => 'Chief Financial Officer',
    'current_position' => 'Chief Financial Officer',
    'current_organization' => 'Acme Mining Holdings',
    'country' => 'South Africa',
    'city' => 'Johannesburg',
    'years_of_experience' => 22,
];

it('can build current affairs extractor agent', function () use ($samplePersonContext) {
    $agent = (new AINinja)->agent()
        ->extractCurrentAffairs()
        ->personContext($samplePersonContext);

    expect($agent)->toBeInstanceOf(CurrentAffairsExtractorAgent::class);

    $data = $agent->toArray();
    expect($data['endpoint'])->toBe('/agent_current_affairs_extractor');
    expect($data['input']['person_context']['current_position'])->toBe('Chief Financial Officer');
    expect($data['input']['person_context']['country'])->toBe('South Africa');
});

it('can set optional prior state and run date', function () use ($samplePersonContext) {
    $agent = (new AINinja)->agent()
        ->extractCurrentAffairs()
        ->personContext($samplePersonContext)
        ->priorState(['issues' => []])
        ->runDate('2026-04-10');

    $data = $agent->toArray();
    expect($data['input']['prior_state'])->toBeArray();
    expect($data['input']['run_date'])->toBe('2026-04-10');
});

it('returns mocked result with issues and summary', function () {
    $mocked = (new AINinja)->agent()->extractCurrentAffairs()->getMocked();

    expect($mocked)->toHaveKey('output');
    expect($mocked['output'])->toHaveKey('issues');
    expect($mocked['output'])->toHaveKey('summary');
    expect($mocked['output'])->toHaveKey('changes');
    expect($mocked['output'])->toHaveKey('agent_context');
    expect($mocked['output'])->toHaveKey('generated_at');
    expect($mocked['output']['issues'])->toBeArray();
    expect(count($mocked['output']['issues']))->toBeGreaterThan(0);
});

it('can set output language', function () use ($samplePersonContext) {
    $agent = (new AINinja)->agent()
        ->extractCurrentAffairs()
        ->personContext($samplePersonContext)
        ->outputInLanguage('af', 'Afrikaans');

    $data = $agent->toArray();
    expect($data['input']['output_language_name'])->toBe('Afrikaans');
    expect($data['input']['output_language_code'])->toBe('af');
});

it('result class can parse mocked data', function () {
    $agent = (new AINinja)->agent()->extractCurrentAffairs();

    $result = new AINinjaAgentCurrentAffairsExtractorResult([
        'status' => 'success',
        'response' => $agent->getMocked(),
    ]);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->getGeneratedAt())->toBeString();
    expect($result->getSummary())->toBeInstanceOf(Collection::class);
    expect($result->getIssues())->toBeInstanceOf(Collection::class);
    expect($result->getChanges())->toBeInstanceOf(Collection::class);
    expect($result->getAgentContext())->toBeInstanceOf(Collection::class);
    expect($result->getIssueCount())->toBeGreaterThan(0);
});
