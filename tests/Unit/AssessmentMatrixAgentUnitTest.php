<?php

use IanRothmann\AINinja\AINinja;

it('can run an assessment matrix agent with basic setup', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->createAssessmentMatrix()
        ->addMethod('interview', 'Structured Interview')
        ->addMethod('personality', 'Personality Assessment')
        ->addMeasure('interview', 'communication', 'Communication Skills', 'Ability to communicate effectively')
        ->addMeasure('personality', 'extraversion', 'Extraversion', 'Tendency to be outgoing and social')
        ->addMappingDimension('communication', 'verbal', 'Verbal Communication', 'Spoken communication skills')
        ->addMappingDimension('extraversion', 'social', 'Social Confidence', 'Confidence in social situations')
        ->addCompetency('teamwork', 'Teamwork', 'Ability to work effectively in teams', 'Core Skills')
        ->setCompetencyMethodTargets('teamwork', 'interview', 0.6, 2)
        ->setCompetencyMethodTargets('teamwork', 'personality', 0.4, 1)
        ->addCompetencyExample('teamwork', 'Communication Skills', 'Interview', 'interview', 0.7)
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getMappings())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getCompetenciesCount())->toBeGreaterThan(0);
        expect($result->getCompetencyNames())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});

it('can handle multiple competencies and provide detailed mappings', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->createAssessmentMatrix()
        ->addMethod('interview', 'Structured Interview')
        ->addMethod('personality', 'Personality Test')
        ->addMeasure('interview', 'leadership', 'Leadership Skills', 'Ability to lead and influence')
        ->addMeasure('personality', 'conscientiousness', 'Conscientiousness', 'Tendency to be organized and disciplined')
        ->addMappingDimension('leadership', 'influence', 'Influence', 'Ability to influence others')
        ->addMappingDimension('conscientiousness', 'organization', 'Organization', 'Organizational skills')
        ->addCompetency('leadership', 'Leadership', 'Leading teams and projects', 'Leadership Skills')
        ->addCompetency('reliability', 'Reliability', 'Consistent and dependable performance', 'Core Skills')
        ->setCompetencyMethodTargets('leadership', 'interview', 0.8, 1)
        ->setCompetencyMethodTargets('reliability', 'personality', 0.9, 1)
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getMappings())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getCompetenciesCount())->toBeGreaterThanOrEqual(2);

        // Test specific competency methods
        if ($result->hasCompetency('leadership')) {
            expect($result->getCompetencyMappings('leadership'))->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($result->getWeightsForCompetency('leadership'))->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($result->getDimensionsForCompetency('leadership'))->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($result->getMeasuresForCompetency('leadership'))->toBeInstanceOf(\Illuminate\Support\Collection::class);
        }
    }
});

it('validates required data structure', function () {
    $handler = new AINinja;

    // This should throw an exception when trying to add measure without method
    expect(function () use ($handler) {
        $handler->agent()
            ->createAssessmentMatrix()
            ->addMeasure('nonexistent', 'test', 'Test Measure');
    })->toThrow(\Exception::class, 'You must add a method before adding a measure');
});
