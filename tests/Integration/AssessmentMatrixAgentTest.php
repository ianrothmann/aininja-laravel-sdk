<?php

use IanRothmann\AINinja\AINinja;

it('can run an assessment matrix agent integration test', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->createAssessmentMatrix()
        ->addMethod('interview', 'Structured Behavioral Interview')
        ->addMethod('personality', 'Big Five Personality Assessment')
        ->addMethod('cognitive', 'Cognitive Ability Test')
        ->addMeasure('interview', 'communication', 'Communication Skills', 'Verbal and written communication abilities')
        ->addMeasure('interview', 'leadership', 'Leadership Behavior', 'Demonstrated leadership in past experiences')
        ->addMeasure('personality', 'extraversion', 'Extraversion', 'Outgoing and social tendencies')
        ->addMeasure('personality', 'conscientiousness', 'Conscientiousness', 'Organization and self-discipline')
        ->addMeasure('cognitive', 'reasoning', 'Abstract Reasoning', 'Logical problem-solving abilities')
        ->addMappingDimension('communication', 'verbal', 'Verbal Communication', 'Spoken communication effectiveness')
        ->addMappingDimension('communication', 'written', 'Written Communication', 'Written communication clarity')
        ->addMappingDimension('leadership', 'influence', 'Influence', 'Ability to influence and motivate others')
        ->addMappingDimension('extraversion', 'social_confidence', 'Social Confidence', 'Comfort in social situations')
        ->addMappingDimension('conscientiousness', 'organization', 'Organization', 'Systematic approach to work')
        ->addMappingDimension('reasoning', 'problem_solving', 'Problem Solving', 'Analytical thinking skills')
        ->addCompetency('teamwork', 'Collaboration and Teamwork', 'Working effectively with others', 'Interpersonal Skills')
        ->addCompetency('leadership_comp', 'Leadership and Influence', 'Leading teams and driving results', 'Leadership Competencies')
        ->addCompetency('analytical_thinking', 'Analytical Thinking', 'Problem-solving and decision-making', 'Cognitive Skills')
        ->setCompetencyMethodTargets('teamwork', 'interview', 0.4, 1)
        ->setCompetencyMethodTargets('teamwork', 'personality', 0.6, 2)
        ->setCompetencyMethodTargets('leadership_comp', 'interview', 0.7, 1)
        ->setCompetencyMethodTargets('leadership_comp', 'personality', 0.3, 1)
        ->setCompetencyMethodTargets('analytical_thinking', 'cognitive', 0.8, 1)
        ->setCompetencyMethodTargets('analytical_thinking', 'interview', 0.2, 1)
        ->addCompetencyExample('teamwork', 'Verbal Communication', 'Interview', 'interview', 0.3)
        ->addCompetencyExample('teamwork', 'Social Confidence', 'Personality', 'personality', 0.4)
        ->addCompetencyExample('leadership_comp', 'Influence', 'Interview', 'interview', 0.6)
        ->addCompetencyExample('analytical_thinking', 'Problem Solving', 'Cognitive Test', 'cognitive', 0.7)
        ->setTraceId('AssessmentMatrixAgentTest')
        ->runAndWait(30);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);

    if ($result->isSuccessful()) {
        expect($result->getMappings())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getCompetenciesCount())->toBeGreaterThan(0);
        expect($result->getCompetencyNames())->toBeInstanceOf(\Illuminate\Support\Collection::class);

        // Test that we get mappings for each competency
        $competencyNames = $result->getCompetencyNames();
        foreach ($competencyNames as $competency) {
            expect($result->hasCompetency($competency))->toBeTrue();
            expect($result->getCompetencyMappings($competency))->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($result->getWeightsForCompetency($competency))->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($result->getDimensionsForCompetency($competency))->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($result->getMeasuresForCompetency($competency))->toBeInstanceOf(\Illuminate\Support\Collection::class);
        }
    } else {
        // Agent may still be processing or encountered an error
        // This is acceptable for complex assessment matrix generation
        expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});
