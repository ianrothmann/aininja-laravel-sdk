<?php

use IanRothmann\AINinja\AINinja;

it('can run a competency development curator agent with basic setup', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->curateCompetencyDevelopment()
        ->competencyName('Leadership and Decision Making')
        ->competencyDescription('The ability to guide teams, make strategic decisions, and drive organizational success through effective leadership practices and sound judgment.')
        ->targetLevel('managerial')
        ->includeResources(['e_learning', 'video'])
        ->includeEee(['experience', 'exposure'])
        ->constraints(2, 4)
        ->context('Central Banking', 'mid-level', 'employees', ['North America'])
        ->quickMode(true)
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getSummary())->toBeString();
        expect($result->getCompetency())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getCompetencyName())->toBeString();
        expect($result->getCompetencyDescription())->toBeString();
        expect($result->getCompetencyTargetLevel())->toBeString();
        expect($result->getResources())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getDevelopment())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});

it('can handle different resource and development types', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->curateCompetencyDevelopment()
        ->competencyName('Communication Skills')
        ->competencyDescription('Effective verbal and written communication abilities.')
        ->targetLevel('professional')
        ->includeResources(['e_learning', 'video', 'audio', 'reading'])
        ->includeEee(['experience', 'exposure', 'education'])
        ->constraints(3, 6)
        ->context('Technology', 'senior', 'managers')
        ->locale('en')
        ->quickMode(true)
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getELearningResources())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getVideoResources())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getAudioResources())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getReadingResources())->toBeInstanceOf(\Illuminate\Support\Collection::class);

        expect($result->getExperienceDevelopment())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getExposureDevelopment())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getEducationDevelopment())->toBeInstanceOf(\Illuminate\Support\Collection::class);

        expect($result->getAllResourceTypes())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getAllDevelopmentTypes())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getTotalResourcesCount())->toBeGreaterThan(0);
        expect($result->getTotalDevelopmentItemsCount())->toBeGreaterThan(0);
    }
});

it('can check for specific resource and development types', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->curateCompetencyDevelopment()
        ->competencyName('Strategic Thinking')
        ->competencyDescription('Ability to think strategically about business challenges.')
        ->targetLevel('executive')
        ->includeResources(['video'])
        ->includeEee(['experience'])
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->hasResourceType('video'))->toBeTrue();
        expect($result->hasResourceType('audio'))->toBeFalse();
        expect($result->hasDevelopmentType('experience'))->toBeTrue();
        expect($result->hasDevelopmentType('education'))->toBeFalse();
    }
});

it('can access individual resource and development items', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->curateCompetencyDevelopment()
        ->competencyName('Leadership and Decision Making')
        ->competencyDescription('The ability to guide teams, make strategic decisions, and drive organizational success.')
        ->targetLevel('managerial')
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        // Test resource item access
        $firstELearningResource = $result->getResourceItem('e_learning', 0);
        if ($firstELearningResource) {
            expect($firstELearningResource)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($firstELearningResource->get('title'))->toBeString();
            expect($firstELearningResource->get('description'))->toBeString();
            expect($firstELearningResource->get('url'))->toBeString();
        }

        // Test development item access
        $firstExperienceItem = $result->getDevelopmentItem('experience', 0);
        if ($firstExperienceItem) {
            expect($firstExperienceItem)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($firstExperienceItem->get('title'))->toBeString();
            expect($firstExperienceItem->get('description'))->toBeString();
            expect($firstExperienceItem->get('rationale'))->toBeString();
        }

        // Test URL extraction
        $videoUrls = $result->getResourceUrls('video');
        expect($videoUrls)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        $experienceUrls = $result->getDevelopmentUrls('experience');
        expect($experienceUrls)->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});

it('can build complex agent configuration', function () {
    $handler = new AINinja;

    $agent = $handler->agent()
        ->curateCompetencyDevelopment()
        ->competencyName('Test Competency')
        ->competencyDescription('Test description')
        ->targetLevel('managerial')
        ->includeResources(['e_learning', 'video'])
        ->includeEee(['experience'])
        ->constraints(2, 5)
        ->context('Technology', 'senior', 'managers', ['Global'])
        ->locale('en')
        ->quickMode(true);

    // Test that the agent can be configured without errors
    expect($agent)->toBeInstanceOf(\IanRothmann\AINinja\Processors\Agents\CompetencyDevelopmentCuratorAgent::class);

    // Test that toArray doesn't throw exceptions
    $data = $agent->toArray();
    expect($data)->toBeArray();
    expect($data)->toHaveKey('endpoint');
    expect($data)->toHaveKey('input');
    expect($data['endpoint'])->toBe('/agent_competency_development_curator');
});