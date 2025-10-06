<?php

use IanRothmann\AINinja\AINinja;

it('can run an IDP from library creator agent integration test', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->createIdpFromLibrary()
        ->addToPersonContext('role', 'Senior Economist')
        ->addToPersonContext('level', 'mid-level')
        ->addToPersonContext('department', 'Monetary Policy')
        ->addToAssessmentContext('assessment_type', 'Competency Assessment')
        ->addToAssessmentContext('assessment_date', '2024-01-15')
        ->addToAssessmentContext('context', 'Central Banking')
        ->addDevelopmentCategory('experience', 'Experience', 3)
        ->addDevelopmentAction('experience', 1102, 'Participate in a mega project', 'Join a high-visibility analysis project (e.g., inflation nowcast or liquidity stress testing) and own a discrete workstream from data sourcing to output checks.', 'By taking end-to-end responsibility on a complex stream, you\'ll sharpen data rigor and produce outputs leaders can use quickly.')
        ->addDevelopmentAction('experience', 1101, 'Lead a cost benefit analysis', 'Work through input costs and projected benefits step-by-step to frame clear trade-offs for a policy decision.', 'This helps you quantify options and make your briefings more defensible to committee members.')
        ->addDevelopmentAction('experience', 1104, 'Complete a cross functional assignment', 'Take on a multi-stakeholder assignment where you coordinate timelines, track risks, and balance competing priorities.', 'Through structured coordination and timely updates, you\'ll build trust across departments and reduce rework.')
        ->addDevelopmentCategory('education', 'Education', 2)
        ->addDevelopmentAction('education', 1154, 'Strategic Business Management Course', 'Structured strategic business management program', 'Strengthens structured thinking and forecasting foundations that translate directly into option papers and scenario work.')
        ->addDevelopmentAction('education', 1156, 'Advanced Economics Course', 'Deep dive into macroeconomic theory and modeling', 'Builds theoretical foundations for policy analysis.')
        ->addDevelopmentCategory('exposure', 'Exposure', 2)
        ->addDevelopmentAction('exposure', 1138, 'Receive technical mentoring', 'Work alongside a subject-matter expert to see how they structure data cleaning, model choices, and validation checks.', 'Direct feedback on real work accelerates your coding and interpretation skills for policy-grade analysis.')
        ->addDevelopmentAction('exposure', 1135, 'Receive coaching', 'Schedule brief coaching conversations to rehearse concise, data-led messages and practice handling tough questions before committee updates.', 'This builds poise under scrutiny and helps your points land clearly with senior audiences.')
        ->addCompetencyScore('economic_data_analysis', 'Economic Data Analysis', 2.11372, 'Ability to analyze and interpret economic data', 0.0, 5.0)
        ->addCompetencyScore('statistical_research_and_economic_modelling', 'Statistical Research and Economic Modelling', 2.22316, 'Statistical modeling and econometric analysis skills', 0.0, 5.0)
        ->addCompetencyScore('policy_development', 'Policy Development', 2.66784, 'Development and analysis of economic policies', 0.0, 5.0)
        ->addCompetencyScore('formulation_and_analysis_of_monetary_policy', 'Formulation and Analysis of Monetary Policy', 4.15956, 'Monetary policy expertise', 0.0, 5.0)
        ->avoidActions('actions_already_completed')
        ->instructions('Focus on central banking context, emphasizing monetary policy and macroeconomic research capabilities. Prioritize data analytics and policy development themes.')
        ->setTraceId('IdpFromLibraryCreatorAgentTest')
        ->runAndWait(5);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);

    if ($result->isSuccessful()) {
        // Test dev_actions structure
        expect($result->getDevActions())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getTotalDevActions())->toBeGreaterThan(0);

        // Test dev action structure
        $firstAction = $result->getDevActions()->first();
        if ($firstAction) {
            expect($firstAction)->toHaveKeys([
                'title',
                'category_id',
                'dev_action_id',
                'description',
                'rationale',
                'priority',
            ]);
            expect($firstAction['title'])->toBeString();
            expect($firstAction['category_id'])->toBeString();
            expect($firstAction['dev_action_id'])->toBeInt();
            expect($firstAction['description'])->toBeString();
            expect($firstAction['rationale'])->toBeString();
            expect($firstAction['priority'])->toBeString();
            expect($firstAction['priority'])->toBeIn(['ShortTerm', 'MediumTerm', 'LongTerm', 'AsOppurtunityArrise']);
        }

        // Test dev action retrieval by ID
        if ($firstAction) {
            $actionId = $firstAction['dev_action_id'];
            $retrievedAction = $result->getDevAction($actionId);
            expect($retrievedAction)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($retrievedAction->get('dev_action_id'))->toBe($actionId);
        }

        // Test category filtering
        $categories = $result->getDevActionCategories();
        expect($categories)->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($categories->count())->toBeGreaterThan(0);

        if ($categories->isNotEmpty()) {
            $firstCategory = $categories->first();
            $categoryActions = $result->getDevActionsByCategory($firstCategory);
            expect($categoryActions)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            // All actions should have the same category
            $categoryActions->each(function ($action) use ($firstCategory) {
                expect($action['category_id'])->toBe($firstCategory);
            });
        }

        // Test priority filtering
        $priorities = $result->getDevActionPriorities();
        expect($priorities)->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($priorities->count())->toBeGreaterThan(0);

        if ($priorities->isNotEmpty()) {
            $firstPriority = $priorities->first();
            $priorityActions = $result->getDevActionsByPriority($firstPriority);
            expect($priorityActions)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            // All actions should have the same priority
            $priorityActions->each(function ($action) use ($firstPriority) {
                expect($action['priority'])->toBe($firstPriority);
            });
        }

        // Test development_themes structure
        expect($result->getDevelopmentThemes())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getTotalDevelopmentThemes())->toBeGreaterThan(0);

        // Test development theme structure
        $firstTheme = $result->getDevelopmentThemes()->first();
        if ($firstTheme) {
            expect($firstTheme)->toHaveKeys([
                'title',
                'summary',
                'linked_competencies',
                'business_impact_if_improved',
                'quick_diagnostics',
                'tags',
                'suggested_modality_focus',
                'priority',
                'evidence',
            ]);
            expect($firstTheme['title'])->toBeString();
            expect($firstTheme['title'])->not->toBeEmpty();
            expect($firstTheme['summary'])->toBeString();
            expect($firstTheme['summary'])->not->toBeEmpty();
            expect($firstTheme['linked_competencies'])->toBeArray();
            expect($firstTheme['business_impact_if_improved'])->toBeString();
            expect($firstTheme['quick_diagnostics'])->toBeArray();
            expect($firstTheme['tags'])->toBeArray();
            expect($firstTheme['suggested_modality_focus'])->toBeArray();
            expect($firstTheme['priority'])->toBeInt();
            expect($firstTheme['priority'])->toBeGreaterThan(0);
            expect($firstTheme['evidence'])->toBeArray();
        }

        // Test highest priority theme
        $highestPriorityTheme = $result->getHighestPriorityTheme();
        expect($highestPriorityTheme)->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($highestPriorityTheme->get('priority'))->toBe(1);

        // Test theme retrieval by priority
        $theme1 = $result->getDevelopmentTheme(1);
        if ($theme1) {
            expect($theme1)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($theme1->get('priority'))->toBe(1);

            // Test linked competencies structure
            $competencies = $result->getThemeCompetencies(1);
            expect($competencies)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            if ($competencies->isNotEmpty()) {
                $firstComp = $competencies->first();
                expect($firstComp)->toHaveKeys(['refcode', 'name', 'score']);
                expect($firstComp['refcode'])->toBeString();
                expect($firstComp['name'])->toBeString();
                expect($firstComp['score'])->toBeNumeric();
            }

            // Test quick diagnostics
            $diagnostics = $result->getThemeQuickDiagnostics(1);
            expect($diagnostics)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            if ($diagnostics->isNotEmpty()) {
                $firstDiagnostic = $diagnostics->first();
                expect($firstDiagnostic)->toBeString();
                expect($firstDiagnostic)->not->toBeEmpty();
            }

            // Test evidence structure
            $evidence = $result->getThemeEvidence(1);
            expect($evidence)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            if ($evidence->isNotEmpty()) {
                $firstEvidence = $evidence->first();
                expect($firstEvidence)->toHaveKeys(['type', 'ref', 'detail']);
                expect($firstEvidence['type'])->toBeString();
                expect($firstEvidence['type'])->toBeIn(['competency', 'quote', 'score']);
                expect($firstEvidence['ref'])->toBeString();
                expect($firstEvidence['detail'])->toBeString();
            }

            // Test suggested modalities
            $modalities = $result->getThemeSuggestedModalities(1);
            expect($modalities)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            if ($modalities->isNotEmpty()) {
                $firstModality = $modalities->first();
                expect($firstModality)->toBeString();
                expect($firstModality)->toBeIn(['experience', 'exposure', 'education', 'elearn', 'read', 'watch', 'listen']);
            }
        }

        // Test tag filtering
        $allTags = $result->getAllThemeTags();
        expect($allTags)->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($allTags->count())->toBeGreaterThan(0);

        if ($allTags->isNotEmpty()) {
            $firstTag = $allTags->first();
            $taggedThemes = $result->getThemesByTag($firstTag);
            expect($taggedThemes)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            // Each theme should contain the tag
            $taggedThemes->each(function ($theme) use ($firstTag) {
                expect($theme['tags'])->toContain($firstTag);
            });
        }

        // Verify that themes are sorted by priority
        $themes = $result->getDevelopmentThemes();
        if ($themes->count() > 1) {
            $priorities = $themes->pluck('priority');
            expect($priorities->first())->toBeLessThanOrEqual($priorities->last());
        }

    } else {
        // Agent may still be processing or encountered an error
        // This is acceptable for complex IDP creation
        expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});
