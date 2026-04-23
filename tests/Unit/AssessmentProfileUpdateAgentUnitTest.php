<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\AssessmentProfileUpdateAgent;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentAssessmentProfileUpdateResult;
use Illuminate\Support\Collection;

$sampleSnapshot = [
    'assessments' => [['sources' => ['source_id' => 'fitt', 'external_id' => '22153']]],
    'contexts'    => [],
];

$sampleAssessment = [
    'assessments' => [['identifiers' => ['assessment_id' => '23019'], 'assessment_date' => '2024-11-01']],
];

it('can build assessment profile update agent with required inputs', function () use ($sampleSnapshot, $sampleAssessment) {
    $agent = (new AINinja)->agent()
        ->updateAssessmentProfile()
        ->profileSnapshot($sampleSnapshot)
        ->incomingAssessment($sampleAssessment);

    expect($agent)->toBeInstanceOf(AssessmentProfileUpdateAgent::class);

    $data = $agent->toArray();
    expect($data['endpoint'])->toBe('/agent_assessment_profile_update');
    expect($data['input']['profile_snapshot'])->toBeArray();
    expect($data['input']['incoming_assessment'])->toBeArray();
    expect(isset($data['input']['options']))->toBeFalse();
});

it('can build agent with optional options', function () use ($sampleSnapshot, $sampleAssessment) {
    $agent = (new AINinja)->agent()
        ->updateAssessmentProfile()
        ->profileSnapshot($sampleSnapshot)
        ->incomingAssessment($sampleAssessment)
        ->options(['source_id' => 'fitt', 'max_strengths' => 3]);

    $data = $agent->toArray();
    expect($data['input']['options'])->toBeArray();
    expect($data['input']['options']['source_id'])->toBe('fitt');
    expect($data['input']['options']['max_strengths'])->toBe(3);
});

it('returns mocked result with all output section keys', function () {
    $mocked = (new AINinja)->agent()->updateAssessmentProfile()->getMocked();

    expect($mocked)->toHaveKey('output');
    $output = $mocked['output'];
    expect($output)->toHaveKey('status');
    expect($output)->toHaveKey('assessment_resolution');
    expect($output)->toHaveKey('summary');
    expect($output)->toHaveKey('profile_factual_updates');
    expect($output)->toHaveKey('qualification_updates');
    expect($output)->toHaveKey('experience_updates');
    expect($output)->toHaveKey('replaceable_preference_context_updates');
    expect($output)->toHaveKey('strength_updates');
    expect($output)->toHaveKey('development_area_updates');
    expect($output)->toHaveKey('aspiration_updates');
    expect($output)->toHaveKey('development_action_proposal_candidates');
    expect($output)->toHaveKey('learning_context_candidates');
    expect($output)->toHaveKey('warnings');
    expect(count($output['replaceable_preference_context_updates']))->toBe(4);
});

it('result class can parse mocked data', function () {
    $agent = (new AINinja)->agent()->updateAssessmentProfile();

    $result = new AINinjaAgentAssessmentProfileUpdateResult([
        'status'   => 'success',
        'response' => $agent->getMocked(),
    ]);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->getStatus())->toBe('ok');
    expect($result->isOk())->toBeTrue();
    expect($result->hasNoNewAssessment())->toBeFalse();
    expect($result->getAssessmentResolution())->toBeInstanceOf(Collection::class);
    expect($result->getSummary())->toBeInstanceOf(Collection::class);
    expect($result->getSummaryHeadline())->toBeString();
    expect($result->getSummaryCounts())->toBeInstanceOf(Collection::class);
    expect($result->getProfileFactualUpdates())->toBeInstanceOf(Collection::class);
    expect($result->getProfileFactualUpdates()->count())->toBeGreaterThan(0);
    expect($result->getQualificationUpdates())->toBeInstanceOf(Collection::class);
    expect($result->getExperienceUpdates())->toBeInstanceOf(Collection::class);
    expect($result->getReplaceablePreferenceContextUpdates())->toBeInstanceOf(Collection::class);
    expect($result->getReplaceablePreferenceContextUpdates()->count())->toBe(4);
    expect($result->getStrengthUpdates())->toBeInstanceOf(Collection::class);
    expect($result->getStrengthUpdates()->count())->toBeGreaterThan(0);
    expect($result->getDevelopmentAreaUpdates())->toBeInstanceOf(Collection::class);
    expect($result->getAspirationUpdates())->toBeInstanceOf(Collection::class);
    expect($result->getDevelopmentActionProposalCandidates())->toBeInstanceOf(Collection::class);
    expect($result->getDevelopmentActionProposalCandidates()->count())->toBeGreaterThan(0);
    expect($result->getLearningContextCandidates())->toBeInstanceOf(Collection::class);
    expect($result->getWarnings())->toBeInstanceOf(Collection::class);
    expect($result->hasWarnings())->toBeFalse();
});
