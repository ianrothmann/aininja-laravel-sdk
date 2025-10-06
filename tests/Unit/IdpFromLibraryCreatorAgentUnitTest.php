<?php

use IanRothmann\AINinja\AINinja;

it('can run an IDP from library creator agent with basic setup', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->createIdpFromLibrary()
        ->addToPersonContext('role', 'Senior Economist')
        ->addToPersonContext('level', 'mid-level')
        ->addToAssessmentContext('assessment_type', 'Competency Assessment')
        ->addToAssessmentContext('assessment_date', '2024-01-15')
        ->addDevelopmentCategory('experience', 'Experience', 3)
        ->addDevelopmentAction('experience', 1102, 'Participate in a mega project', 'Join a high-visibility analysis project', 'Sharpens data rigor')
        ->addDevelopmentAction('experience', 1101, 'Lead a cost benefit analysis', 'Work through input costs and projected benefits', 'Helps quantify options')
        ->addDevelopmentCategory('education', 'Education', 2)
        ->addDevelopmentAction('education', 1156, 'Strategic Business Management Course', 'Structured strategic business management program', 'Strengthens strategic thinking')
        ->addCompetencyScore('economic_data_analysis', 'Economic Data Analysis', 2.11372, 'Ability to analyze economic data')
        ->addCompetencyScore('policy_development', 'Policy Development', 2.66784)
        ->instructions('Focus on central banking context')
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getDevActions())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getDevelopmentThemes())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getTotalDevActions())->toBeGreaterThan(0);
        expect($result->getTotalDevelopmentThemes())->toBeGreaterThan(0);
    }
});

it('can filter dev actions by category and priority', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->createIdpFromLibrary()
        ->addToPersonContext('role', 'Economist')
        ->addToAssessmentContext('assessment_type', 'Skills Assessment')
        ->addDevelopmentCategory('experience', 'Experience', 2)
        ->addDevelopmentAction('experience', 1001, 'Action 1', 'Description 1')
        ->addDevelopmentAction('experience', 1002, 'Action 2', 'Description 2')
        ->addCompetencyScore('leadership', 'Leadership', 3.5)
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        // Test category filtering
        $experienceActions = $result->getDevActionsByCategory('experience');
        expect($experienceActions)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        // Test priority filtering
        $shortTermActions = $result->getDevActionsByPriority('ShortTerm');
        expect($shortTermActions)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        // Test getting unique categories and priorities
        $categories = $result->getDevActionCategories();
        expect($categories)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        $priorities = $result->getDevActionPriorities();
        expect($priorities)->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});

it('can access development themes and their details', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->createIdpFromLibrary()
        ->addToPersonContext('role', 'Data Analyst')
        ->addToAssessmentContext('assessment_type', 'Performance Review')
        ->addDevelopmentCategory('education', 'Education', 1)
        ->addDevelopmentAction('education', 2001, 'Data Analysis Course', 'Learn advanced data analysis')
        ->addCompetencyScore('data_analytics', 'Data Analytics', 2.5)
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        // Test getting highest priority theme
        $highestPriorityTheme = $result->getHighestPriorityTheme();
        if ($highestPriorityTheme) {
            expect($highestPriorityTheme)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($highestPriorityTheme->get('title'))->toBeString();
            expect($highestPriorityTheme->get('summary'))->toBeString();
            expect($highestPriorityTheme->get('priority'))->toBeInt();
        }

        // Test getting theme by priority
        $theme1 = $result->getDevelopmentTheme(1);
        if ($theme1) {
            expect($theme1)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($theme1->get('linked_competencies'))->toBeArray();
            expect($theme1->get('tags'))->toBeArray();
        }

        // Test getting all tags
        $allTags = $result->getAllThemeTags();
        expect($allTags)->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});

it('can access theme competencies, diagnostics, and evidence', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->createIdpFromLibrary()
        ->addToPersonContext('department', 'Strategy')
        ->addToAssessmentContext('assessment_type', 'Quarterly Review')
        ->addDevelopmentCategory('exposure', 'Exposure', 1)
        ->addDevelopmentAction('exposure', 3001, 'Shadowing Program', 'Shadow senior executives')
        ->addCompetencyScore('strategic_thinking', 'Strategic Thinking', 3.0)
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        // Test theme competencies
        $competencies = $result->getThemeCompetencies(1);
        expect($competencies)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        // Test quick diagnostics
        $diagnostics = $result->getThemeQuickDiagnostics(1);
        expect($diagnostics)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        // Test evidence
        $evidence = $result->getThemeEvidence(1);
        expect($evidence)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        // Test suggested modalities
        $modalities = $result->getThemeSuggestedModalities(1);
        expect($modalities)->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});

it('can access individual dev actions by ID', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->createIdpFromLibrary()
        ->addToPersonContext('role', 'Manager')
        ->addToAssessmentContext('assessment_type', 'Leadership Assessment')
        ->addDevelopmentCategory('experience', 'Experience', 1)
        ->addDevelopmentAction('experience', 4001, 'Project Leadership', 'Lead a cross-functional project')
        ->addCompetencyScore('communication', 'Communication', 2.8)
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        // Get first action and test retrieval by ID
        $firstAction = $result->getDevActions()->first();
        if ($firstAction) {
            $actionId = $firstAction['dev_action_id'];
            $retrievedAction = $result->getDevAction($actionId);

            expect($retrievedAction)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($retrievedAction->get('dev_action_id'))->toBe($actionId);
            expect($retrievedAction->get('title'))->toBeString();
            expect($retrievedAction->get('description'))->toBeString();
            expect($retrievedAction->get('rationale'))->toBeString();
        }
    }
});

it('can filter themes by tag', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->createIdpFromLibrary()
        ->addToPersonContext('role', 'Policy Advisor')
        ->addToAssessmentContext('assessment_type', 'Skills Gap Analysis')
        ->addDevelopmentCategory('education', 'Education', 1)
        ->addDevelopmentAction('education', 5001, 'Policy Course', 'Advanced policy development course')
        ->addCompetencyScore('policy_development', 'Policy Development', 2.7)
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        // Get first tag from themes and test filtering
        $allTags = $result->getAllThemeTags();
        if ($allTags->isNotEmpty()) {
            $firstTag = $allTags->first();
            $taggedThemes = $result->getThemesByTag($firstTag);

            expect($taggedThemes)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            // Each theme should contain the tag
            $taggedThemes->each(function ($theme) use ($firstTag) {
                expect($theme['tags'])->toContain($firstTag);
            });
        }
    }
});

it('can handle avoid actions parameter', function () {
    $handler = new AINinja;

    $agent = $handler->agent()
        ->createIdpFromLibrary()
        ->addToPersonContext('role', 'Analyst')
        ->addToAssessmentContext('assessment_type', 'Annual Review')
        ->addDevelopmentCategory('experience', 'Experience', 1)
        ->addDevelopmentAction('experience', 6001, 'Action 1', 'Description 1')
        ->addCompetencyScore('analysis', 'Analysis', 3.2)
        ->avoidActions(['action_123', 'action_456']);

    // Test that the agent can be configured without errors
    expect($agent)->toBeInstanceOf(\IanRothmann\AINinja\Processors\Agents\IdpFromLibraryCreatorAgent::class);

    // Test that toArray doesn't throw exceptions
    $data = $agent->toArray();
    expect($data)->toBeArray();
    expect($data)->toHaveKey('endpoint');
    expect($data)->toHaveKey('input');
    expect($data['endpoint'])->toBe('/idp_from_library_creator');
});

it('can build complex agent configuration with all features', function () {
    $handler = new AINinja;

    $agent = $handler->agent()
        ->createIdpFromLibrary()
        ->addToPersonContext('role', 'Senior Economist')
        ->addToPersonContext('department', 'Monetary Policy')
        ->addToPersonContext('tenure', '5 years')
        ->addToAssessmentContext('assessment_type', 'Comprehensive Review')
        ->addToAssessmentContext('assessment_date', '2024-01-15')
        ->addToAssessmentContext('context', 'Central Banking')
        ->addDevelopmentCategory('experience', 'Experience', 3)
        ->addDevelopmentAction('experience', 1102, 'Mega Project', 'Description', 'Rationale', 'Analytics')
        ->addDevelopmentAction('experience', 1101, 'Cost Benefit', 'Description', 'Rationale')
        ->addDevelopmentCategory('education', 'Education', 2)
        ->addDevelopmentAction('education', 1156, 'Course', 'Description')
        ->addDevelopmentCategory('exposure', 'Exposure', 1)
        ->addDevelopmentAction('exposure', 1138, 'Mentoring', 'Description', 'Rationale', 'Leadership')
        ->addCompetencyScore('economic_data_analysis', 'Economic Data Analysis', 2.11372, 'Ability to analyze data', 0.0, 5.0)
        ->addCompetencyScore('policy_development', 'Policy Development', 2.66784)
        ->addCompetencyScore('strategic_thinking', 'Strategic Thinking', 3.5, 'Strategic planning ability', 1.0, 5.0)
        ->avoidActions('action_999')
        ->instructions('Focus on central banking context and monetary policy expertise');

    // Test that the agent can be configured without errors
    expect($agent)->toBeInstanceOf(\IanRothmann\AINinja\Processors\Agents\IdpFromLibraryCreatorAgent::class);

    // Test that toArray doesn't throw exceptions
    $data = $agent->toArray();
    expect($data)->toBeArray();
    expect($data)->toHaveKey('endpoint');
    expect($data)->toHaveKey('input');
    expect($data['endpoint'])->toBe('/idp_from_library_creator');

    // Verify input structure
    $input = $data['input'];
    expect($input)->toHaveKey('person_context');
    expect($input)->toHaveKey('assessment_context');
    expect($input)->toHaveKey('development_categories');
    expect($input)->toHaveKey('competency_scores');
    expect($input)->toHaveKey('avoid_actions');
    expect($input)->toHaveKey('instructions');

    expect($input['person_context'])->toHaveKey('role');
    expect($input['person_context'])->toHaveKey('department');
    expect($input['person_context'])->toHaveKey('tenure');

    expect($input['development_categories'])->toHaveCount(3);
    expect($input['competency_scores'])->toHaveCount(3);
});
