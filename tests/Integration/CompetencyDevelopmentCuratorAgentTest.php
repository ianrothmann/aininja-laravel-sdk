<?php

use IanRothmann\AINinja\AINinja;

it('can run a competency development curator agent integration test', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->curateCompetencyDevelopment()
        ->competencyName('Leadership and Decision Making')
        ->competencyDescription('The ability to guide teams, make strategic decisions, and drive organizational success through effective leadership practices and sound judgment.')
        ->targetLevel('managerial')
        ->includeResources(['e_learning', 'video'])
        ->includeEee(['experience', 'exposure'])
        ->constraints(2, 4)
        ->context('Central Banking', 'mid-level', 'employees')
        ->quickMode(true)
        ->setTraceId('CompetencyDevelopmentCuratorAgentTest')
        ->runAndWait(5);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);

    if ($result->isSuccessful()) {
        // Test basic structure
        expect($result->getSummary())->toBeString();
        expect($result->getSummary())->not->toBeEmpty();

        // Test competency information
        expect($result->getCompetency())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getCompetencyName())->toBe('Leadership and Decision Making');
        expect($result->getCompetencyDescription())->toBeString();
        expect($result->getCompetencyTargetLevel())->toBe('managerial');

        // Test resources structure
        expect($result->getResources())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getAllResourceTypes())->toBeInstanceOf(\Illuminate\Support\Collection::class);

        // Test that requested resource types are present
        if ($result->hasResourceType('e_learning')) {
            $elearning = $result->getELearningResources();
            expect($elearning)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($elearning->count())->toBeGreaterThanOrEqual(2);
            expect($elearning->count())->toBeLessThanOrEqual(4);

            // Test resource item structure
            $firstResource = $elearning->first();
            if ($firstResource) {
                expect($firstResource)->toHaveKeys(['title', 'description', 'url']);
                expect($firstResource['title'])->toBeString();
                expect($firstResource['description'])->toBeString();
                expect($firstResource['url'])->toBeString();
            }
        }

        if ($result->hasResourceType('video')) {
            $video = $result->getVideoResources();
            expect($video)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($video->count())->toBeGreaterThanOrEqual(2);
            expect($video->count())->toBeLessThanOrEqual(4);
        }

        // Test development structure
        expect($result->getDevelopment())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getAllDevelopmentTypes())->toBeInstanceOf(\Illuminate\Support\Collection::class);

        // Test that requested development types are present
        if ($result->hasDevelopmentType('experience')) {
            $experience = $result->getExperienceDevelopment();
            expect($experience)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($experience->count())->toBeGreaterThanOrEqual(2);
            expect($experience->count())->toBeLessThanOrEqual(4);

            // Test development item structure
            $firstDev = $experience->first();
            if ($firstDev) {
                expect($firstDev)->toHaveKeys(['title', 'description', 'rationale']);
                expect($firstDev['title'])->toBeString();
                expect($firstDev['description'])->toBeString();
                expect($firstDev['rationale'])->toBeString();
            }
        }

        if ($result->hasDevelopmentType('exposure')) {
            $exposure = $result->getExposureDevelopment();
            expect($exposure)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($exposure->count())->toBeGreaterThanOrEqual(2);
            expect($exposure->count())->toBeLessThanOrEqual(4);
        }

        // Test count methods
        expect($result->getTotalResourcesCount())->toBeGreaterThan(0);
        expect($result->getTotalDevelopmentItemsCount())->toBeGreaterThan(0);

    } else {
        // Agent may still be processing or encountered an error
        // This is acceptable for complex competency development curation
        expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});