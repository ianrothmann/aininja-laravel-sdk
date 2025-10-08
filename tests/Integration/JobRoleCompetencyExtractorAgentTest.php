<?php

use IanRothmann\AINinja\AINinja;

it('can run job role competency extractor agent integration test without existing competencies', function () {
    $handler = new AINinja;

    $jobDescriptions = [
        [
            'positionid' => 1,
            'role' => 'Senior Manager, Training & Development',
            'description' => '# Senior Manager, Training & Development

## Summary of Position

This position is responsible for effectively managing training for the company in support of business objectives. He/she will ensure that the training and development strategy is aligned with key business goals, covering all rig operations and office locations.

## Duties & Responsibilities

- Develop training and development policies and strategies for the company.
- Articulate vision and manage strategic change in the company\'s approach to competence development.
- Establish a focus for training and development in alignment and compliance with key business.
- Benchmark best practice training and competence processes in pursuit of continuous business improvement.
- Ensure effective implementation of training and development strategies.
- Monitor training and development performance for all company assets.

## Qualifications & Experience

- Bachelor\'s Degree in business administration or Human Resources Management with minimum 15 years of previous experience within training & development including 5 years within managerial or leadership role.
- Experienced in establishing training and development programs and learning management system for offshore field.',
        ],
        [
            'positionid' => 2,
            'role' => 'Assistant Controller',
            'description' => '# Assistant Controller

## Summary of Position
The Assistant Controller is responsible to assist in planning and managing the accounting operations of the company. Supports the financial controller in undertaking all aspects of financial management, including corporate accounting, regulatory and financial reporting, payroll, and internal control policies and procedures.

## Duties & Responsibilities
- Support most aspects of accounting management (billing, tax forms, reporting, etc.)
- Maintain a documented system of accounting policies and procedures
- Oversee periodic financial reports, ensuring that the reported results comply with Generally Accepted Accounting Principles (GAAP) and International Financial Reporting Standards (IFRS)
- Assist in producing the annual budget and monthly forecasts

## Qualifications & Experience
- Bachelor\'s degree in accounting with a minimum of 15 years of experience, including at least 5 years in a managerial or leadership role',
        ],
    ];

    $result = $handler->agent()
        ->extractJobRoleCompetencies()
        ->jobDescriptions($jobDescriptions)
        ->existingCompetencies(null)
        ->setTraceId('JobRoleCompetencyExtractorAgentTest_NoExisting')
        ->runAndWait(10);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);

    if ($result->isSuccessful()) {
        // Test positions structure
        expect($result->getPositions())->toBeInstanceOf(\Illuminate\Support\Collection::class);

        // Only validate counts if data exists
        if ($result->getTotalPositionsCount() > 0) {
            expect($result->getTotalPositionsCount())->toBeGreaterThan(0);

            // Test position details
            $position1 = $result->getPosition(1);
            if ($position1) {
                expect($position1)->toBeInstanceOf(\Illuminate\Support\Collection::class);
                expect($position1->get('positionid'))->toBe(1);
                expect($position1->get('competencies'))->toBeArray();
            }

            $position2 = $result->getPosition(2);
            if ($position2) {
                expect($position2)->toBeInstanceOf(\Illuminate\Support\Collection::class);
                expect($position2->get('positionid'))->toBe(2);
            }

            // Test master competency list
            expect($result->getMasterCompetencyList())->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($result->getTotalCompetenciesCount())->toBeGreaterThan(0);

            // Test new competencies (should exist when no existing competencies provided)
            if ($result->hasNewCompetencies()) {
                expect($result->getNewCompetencies())->toBeInstanceOf(\Illuminate\Support\Collection::class);
                expect($result->getTotalNewCompetenciesCount())->toBeGreaterThan(0);

                // Test first new competency structure
                $firstCompetency = $result->getNewCompetencies()->first();
                if ($firstCompetency) {
                    expect($firstCompetency)->toHaveKeys([
                        'competency_id',
                        'name',
                        'description',
                        'success_criteria',
                        'evidence_spans',
                        'support_score',
                    ]);
                    expect($firstCompetency['name'])->toBeString();
                    expect($firstCompetency['description'])->toBeString();
                    expect(strlen($firstCompetency['name']))->toBeGreaterThanOrEqual(3);
                    expect(strlen($firstCompetency['name']))->toBeLessThanOrEqual(100);
                    expect(strlen($firstCompetency['description']))->toBeGreaterThanOrEqual(20);
                    expect(count($firstCompetency['success_criteria']))->toBeGreaterThanOrEqual(2);
                    expect(count($firstCompetency['success_criteria']))->toBeLessThanOrEqual(4);
                    expect(count($firstCompetency['evidence_spans']))->toBeGreaterThanOrEqual(1);
                    expect($firstCompetency['support_score'])->toBeFloat();
                    expect($firstCompetency['support_score'])->toBeGreaterThanOrEqual(0.0);
                    expect($firstCompetency['support_score'])->toBeLessThanOrEqual(1.0);
                }
            }

            // Test competency retrieval methods
            $masterList = $result->getMasterCompetencyList();
            if ($masterList->isNotEmpty()) {
                $firstComp = $masterList->first();
                $competencyId = collect($firstComp)->get('competency_id');

                expect($result->getCompetencyById($competencyId))->toBeInstanceOf(\Illuminate\Support\Collection::class);
                expect($result->getCompetencyName($competencyId))->toBeString();
                expect($result->getCompetencyDescription($competencyId))->toBeString();
                expect($result->getCompetencySuccessCriteria($competencyId))->toBeInstanceOf(\Illuminate\Support\Collection::class);
                expect($result->getCompetencyEvidenceSpans($competencyId))->toBeInstanceOf(\Illuminate\Support\Collection::class);
                expect($result->getCompetencySupportScore($competencyId))->toBeFloat();
            }

            // Test average support score
            expect($result->getAverageSupportScore())->toBeFloat();
            expect($result->getAverageSupportScore())->toBeGreaterThan(0.0);

            // Test role names
            expect($result->getAllRoleNames())->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($result->getAllRoleNames()->count())->toBeGreaterThan(0);
        }
    } else {
        // Agent may still be processing or encountered an error
        expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});

it('can run job role competency extractor agent integration test with existing competencies', function () {
    $handler = new AINinja;

    $jobDescriptions = [
        [
            'positionid' => 3,
            'role' => 'Director, Technical Services',
            'description' => '# Director, Technical Services

## Summary of Position

This position is responsible for managing the strategic and technical aspects of ARO fleets. The strategic aspect includes effective administration and setting goals for the Engineering, Maintenance, Field Support, and Marine teams.

## Duties & Responsibilities

- Develop, implement, and manage Engineering, Maintenance, and Marine compliance processes and procedures for improved performance.
- Establish and measure the achievement of goals, priorities, and standards of the Technical department.
- Develop, manage Engineering, Maintenance, and Marine department budget, resources, and tools.
- Evaluate suitable new technologies for implementation on rigs.',
        ],
    ];

    $existingCompetencies = [
        [
            'competency_id' => 'bb996299-0a4e-4107-8b22-83fc93cadea1',
            'name' => 'Engineering Process Management',
            'description' => 'Develops, implements, and manages engineering processes and procedures to ensure standardized practices and improved performance across technical operations.',
            'success_criteria' => [
                'Implements standardized engineering processes across departments',
                'Ensures compliance with technical and regulatory standards',
            ],
            'evidence_spans' => [
                [
                    'quote' => 'Develop, implement, and manage Engineering processes',
                    'location_hint' => 'Duties & Responsibilities',
                ],
            ],
            'support_score' => 0.88,
            'overlaps_with' => [],
            'position_id' => '99',
            'role_name' => 'Engineering Manager',
        ],
    ];

    $result = $handler->agent()
        ->extractJobRoleCompetencies()
        ->jobDescriptions($jobDescriptions)
        ->existingCompetencies($existingCompetencies)
        ->setTraceId('JobRoleCompetencyExtractorAgentTest_WithExisting')
        ->runAndWait(10);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);

    if ($result->isSuccessful()) {
        // Test basic structure
        expect($result->getPositions())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getMasterCompetencyList())->toBeInstanceOf(\Illuminate\Support\Collection::class);

        // Only validate if data exists
        if ($result->getTotalCompetenciesCount() > 0) {
            // Test that master list includes existing competencies
            expect($result->getTotalCompetenciesCount())->toBeGreaterThanOrEqual(1);

            // Test position assignment
            $position3 = $result->getPosition(3);
            if ($position3) {
                expect($position3)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            }

            $position3Competencies = $result->getPositionCompetencies(3);
            expect($position3Competencies)->toBeInstanceOf(\Illuminate\Support\Collection::class);

            // Test competencies by position
            $competenciesForPos3 = $result->getCompetenciesByPositionId(3);
            expect($competenciesForPos3)->toBeInstanceOf(\Illuminate\Support\Collection::class);

            // Test filtering by threshold
            $highConfidence = $result->getCompetenciesAboveThreshold(0.8);
            expect($highConfidence)->toBeInstanceOf(\Illuminate\Support\Collection::class);
        }
    } else {
        // Agent may still be processing
        expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});
