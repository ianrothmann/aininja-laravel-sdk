<?php

use IanRothmann\AINinja\AINinja;

it('can run job role competency extractor agent without existing competencies', function () {
    $handler = new AINinja;

    $jobDescriptions = [
        [
            'positionid' => 1,
            'role' => 'Senior Manager, Training & Development',
            'description' => '# Senior Manager, Training & Development

## Summary of Position
This position is responsible for effectively managing training for the company in support of business objectives.

## Duties & Responsibilities
- Develop training and development policies and strategies for the company.
- Articulate vision and manage strategic change in the company\'s approach to competence development.
- Benchmark best practice training and competence processes.',
        ],
    ];

    $result = $handler->agent()
        ->extractJobRoleCompetencies()
        ->jobDescriptions($jobDescriptions)
        ->existingCompetencies(null)
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getPositions())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getMasterCompetencyList())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getTotalPositionsCount())->toBeGreaterThan(0);
        expect($result->getTotalCompetenciesCount())->toBeGreaterThan(0);
    }
});

it('can run job role competency extractor agent with existing competencies', function () {
    $handler = new AINinja;

    $jobDescriptions = [
        [
            'positionid' => 1,
            'role' => 'Assistant Controller',
            'description' => '# Assistant Controller

## Summary of Position
The Assistant Controller is responsible to assist in planning and managing the accounting operations.

## Duties & Responsibilities
- Support most aspects of accounting management (billing, tax forms, reporting, etc.)
- Oversee periodic financial reports, ensuring compliance with GAAP and IFRS.',
        ],
    ];

    $existingCompetencies = [
        [
            'competency_id' => 'test-comp-123',
            'name' => 'Financial Reporting',
            'description' => 'Ability to prepare and review financial reports.',
            'success_criteria' => [
                'Prepares accurate financial statements',
                'Ensures compliance with accounting standards',
            ],
            'evidence_spans' => [
                [
                    'quote' => 'financial reporting',
                    'location_hint' => 'Duties section',
                ],
            ],
            'support_score' => 0.85,
            'overlaps_with' => [],
            'position_id' => '1',
            'role_name' => 'Accountant',
        ],
    ];

    $result = $handler->agent()
        ->extractJobRoleCompetencies()
        ->jobDescriptions($jobDescriptions)
        ->existingCompetencies($existingCompetencies)
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getPositions())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getMasterCompetencyList())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getTotalCompetenciesCount())->toBeGreaterThan(0);
    }
});

it('can retrieve position-specific data', function () {
    $handler = new AINinja;

    $jobDescriptions = [
        [
            'positionid' => 1,
            'role' => 'Manager',
            'description' => '# Manager role with leadership responsibilities.',
        ],
        [
            'positionid' => 2,
            'role' => 'Developer',
            'description' => '# Developer role with technical responsibilities.',
        ],
    ];

    $result = $handler->agent()
        ->extractJobRoleCompetencies()
        ->jobDescriptions($jobDescriptions)
        ->existingCompetencies(null)
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        $position1 = $result->getPosition(1);
        expect($position1)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        $position1Competencies = $result->getPositionCompetencies(1);
        expect($position1Competencies)->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});

it('can access competency details', function () {
    $handler = new AINinja;

    $jobDescriptions = [
        [
            'positionid' => 1,
            'role' => 'Senior Engineer',
            'description' => '# Senior Engineer with system design and architecture skills.',
        ],
    ];

    $result = $handler->agent()
        ->extractJobRoleCompetencies()
        ->jobDescriptions($jobDescriptions)
        ->existingCompetencies(null)
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        $competencies = $result->getMasterCompetencyList();
        if ($competencies->isNotEmpty()) {
            $firstCompetency = $competencies->first();
            $competencyId = collect($firstCompetency)->get('competency_id');

            expect($result->getCompetencyById($competencyId))->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($result->getCompetencyName($competencyId))->toBeString();
            expect($result->getCompetencyDescription($competencyId))->toBeString();
            expect($result->getCompetencySuccessCriteria($competencyId))->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($result->getCompetencyEvidenceSpans($competencyId))->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($result->getCompetencySupportScore($competencyId))->toBeFloat();
        }
    }
});

it('can check for new competencies', function () {
    $handler = new AINinja;

    $jobDescriptions = [
        [
            'positionid' => 1,
            'role' => 'Test Role',
            'description' => '# Test role description with various skills.',
        ],
    ];

    $result = $handler->agent()
        ->extractJobRoleCompetencies()
        ->jobDescriptions($jobDescriptions)
        ->existingCompetencies(null)
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        $hasNew = $result->hasNewCompetencies();
        expect($hasNew)->toBeIn([true, false]);

        if ($hasNew) {
            expect($result->getNewCompetencies())->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($result->getTotalNewCompetenciesCount())->toBeGreaterThan(0);
        }
    }
});

it('can filter competencies by role and threshold', function () {
    $handler = new AINinja;

    $jobDescriptions = [
        [
            'positionid' => 1,
            'role' => 'Data Scientist',
            'description' => '# Data Scientist with expertise in machine learning and statistics.',
        ],
    ];

    $result = $handler->agent()
        ->extractJobRoleCompetencies()
        ->jobDescriptions($jobDescriptions)
        ->existingCompetencies(null)
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        $allRoles = $result->getAllRoleNames();
        expect($allRoles)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        $avgScore = $result->getAverageSupportScore();
        expect($avgScore)->toBeFloat();

        $highConfidence = $result->getCompetenciesAboveThreshold(0.8);
        expect($highConfidence)->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});

it('can build complex agent configuration', function () {
    $handler = new AINinja;

    $jobDescriptions = [
        [
            'positionid' => 1,
            'role' => 'Test Role',
            'description' => 'Test description',
        ],
    ];

    $agent = $handler->agent()
        ->extractJobRoleCompetencies()
        ->jobDescriptions($jobDescriptions)
        ->existingCompetencies(null);

    expect($agent)->toBeInstanceOf(\IanRothmann\AINinja\Processors\Agents\JobRoleCompetencyExtractorAgent::class);

    $data = $agent->toArray();
    expect($data)->toBeArray();
    expect($data)->toHaveKey('endpoint');
    expect($data)->toHaveKey('input');
    expect($data['endpoint'])->toBe('/agent_job_role_competency_extractor');
});
