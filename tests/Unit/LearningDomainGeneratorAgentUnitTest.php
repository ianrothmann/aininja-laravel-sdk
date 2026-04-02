<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\LearningDomainGeneratorAgent;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentLearningDomainGeneratorResult;
use Illuminate\Support\Collection;

$sampleProfile = [
    'id' => 'person_001',
    'name' => 'Alex',
    'surname' => 'Morgan',
    'country' => 'New Zealand',
    'current_position' => 'Senior Software Engineer',
    'current_organization' => 'Acme Technologies',
];

$sampleGoals = [
    ['id' => 'goal_001', 'name' => 'Senior Leadership Role', 'description' => 'Move into a VP Engineering role within 3-5 years.'],
];

it('can build learning domain generator agent', function () use ($sampleProfile, $sampleGoals) {
    $agent = (new AINinja)->agent()
        ->generateLearningDomains()
        ->personProfile($sampleProfile)
        ->developmentGoals($sampleGoals);

    expect($agent)->toBeInstanceOf(LearningDomainGeneratorAgent::class);

    $data = $agent->toArray();
    expect($data['endpoint'])->toBe('/agent_learning_domain_generator');
    expect($data['input']['person_profile']['id'])->toBe('person_001');
    expect($data['input']['person_profile']['name'])->toBe('Alex');
    expect($data['input']['development_goals'])->toBeArray();
    expect($data['input']['development_goals'][0]['id'])->toBe('goal_001');
});

it('can set optional existing domains and generation context', function () use ($sampleProfile, $sampleGoals) {
    $agent = (new AINinja)->agent()
        ->generateLearningDomains()
        ->personProfile($sampleProfile)
        ->developmentGoals($sampleGoals)
        ->existingLearningDomains([])
        ->generationContext(['output_language_name' => 'British English', 'output_language_code' => 'en']);

    $data = $agent->toArray();
    expect($data['input']['existing_learning_domains'])->toBeArray();
    expect($data['input']['generation_context']['output_language_name'])->toBe('British English');
    expect($data['input']['generation_context']['output_language_code'])->toBe('en');
});

it('returns mocked result with learning domains', function () {
    $mocked = (new AINinja)->agent()->generateLearningDomains()->getMocked();

    expect($mocked)->toHaveKey('output');
    expect($mocked['output'])->toHaveKey('learning_domains');
    expect($mocked['output']['learning_domains'])->toBeArray();
    expect(count($mocked['output']['learning_domains']))->toBeGreaterThan(0);
    expect($mocked['output'])->toHaveKey('generation_summary');
    expect($mocked['output'])->toHaveKey('person_id');
});

it('result class can parse mocked data', function () {
    $agent = (new AINinja)->agent()->generateLearningDomains();

    $result = new AINinjaAgentLearningDomainGeneratorResult([
        'status' => 'success',
        'response' => $agent->getMocked(),
    ]);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->getPersonId())->toBeString();
    expect($result->getGenerationSummary())->toBeInstanceOf(Collection::class);
    expect($result->getLearningDomains())->toBeInstanceOf(Collection::class);
    expect($result->getDomainCount())->toBeGreaterThan(0);
});
