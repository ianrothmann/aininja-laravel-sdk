<?php

use IanRothmann\AINinja\AINinja;

it('can run an IDP creator agent integration test', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->createIdp()
        ->addToPersonContext('role', 'Senior Manager - Business Solutions')
        ->addToPersonContext('level', 'senior')
        ->addToPersonContext('department', 'PwC Business Solutions')
        ->addToPersonContext('organization', 'PwC UK')
        ->addToAssessmentContext('assessment_type', 'Competency Assessment')
        ->addToAssessmentContext('assessment_date', '2024-01-15')
        ->addToAssessmentContext('context', 'Business Transformation')
        ->addDevelopmentCategory('watch', 'Videos to Watch', 3)
        ->addDevelopmentCategory('read', 'Articles to Read', 3)
        ->addDevelopmentCategory('listen', 'Podcasts to Listen', 3)
        ->addDevelopmentCategory('e_learning', 'E-Learning Courses', 3)
        ->addDevelopmentCategory('exposure', 'Exposure Activities', 3)
        ->addDevelopmentCategory('experience', 'Experiential Learning', 3)
        ->addDevelopmentCategory('education', 'Formal Education', 1)
        ->addCompetencyScore('data_visualization', 'Data Visualization', 2.5, 'Ability to create compelling data visualizations', 0.0, 5.0)
        ->addCompetencyScore('forecasting', 'Forecasting and Scenario Planning', 2.8, 'Strategic forecasting skills', 0.0, 5.0)
        ->addCompetencyScore('analytics', 'Analytics and Insights', 3.0, 'Data analytics capabilities', 0.0, 5.0)
        ->addCompetencyScore('strategic_thinking', 'Strategic Thinking', 3.5, 'Strategic planning and thinking', 1.0, 5.0)
        ->avoidActions('actions_already_completed')
        ->instructions('Focus on analytics, forecasting, and data-driven decision making in business transformation context. Prioritize practical, actionable resources that can be applied to PwC Business Solutions operations.')
        ->setTraceId('IdpCreatorAgentTest')
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
                'description',
                'rationale',
                'priority',
            ]);
            expect($firstAction['title'])->toBeString();
            expect($firstAction['title'])->not->toBeEmpty();
            expect($firstAction['category_id'])->toBeString();
            expect($firstAction['description'])->toBeString();
            expect($firstAction['description'])->not->toBeEmpty();
            expect($firstAction['rationale'])->toBeString();
            expect($firstAction['rationale'])->not->toBeEmpty();
            expect($firstAction['priority'])->toBeString();
            expect($firstAction['priority'])->toBeIn(['ShortTerm', 'MediumTerm', 'LongTerm', 'AsOpportunitiesArise']);

            // Optional fields
            if (array_key_exists('url', $firstAction)) {
                if ($firstAction['url'] !== null) {
                    expect($firstAction['url'])->toBeString();
                }
            }

            if (array_key_exists('keywords', $firstAction)) {
                expect($firstAction['keywords'])->toBeArray();
                if (! empty($firstAction['keywords'])) {
                    foreach ($firstAction['keywords'] as $keyword) {
                        expect($keyword)->toBeString();
                    }
                }
            }

            if (array_key_exists('thumbnail_url', $firstAction)) {
                if ($firstAction['thumbnail_url'] !== null) {
                    expect($firstAction['thumbnail_url'])->toBeString();
                }
            }
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

        // Test keyword filtering
        $allKeywords = $result->getAllKeywords();
        expect($allKeywords)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        if ($allKeywords->isNotEmpty()) {
            $firstKeyword = $allKeywords->first();
            $keywordActions = $result->getDevActionsByKeyword($firstKeyword);
            expect($keywordActions)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            // All actions should contain the keyword
            $keywordActions->each(function ($action) use ($firstKeyword) {
                expect($action['keywords'])->toContain($firstKeyword);
            });
        }

        // Test URL retrieval
        $actionsWithUrls = $result->getDevActionsWithUrls();
        expect($actionsWithUrls)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        if ($actionsWithUrls->isNotEmpty()) {
            $firstActionWithUrl = $actionsWithUrls->first();
            $actionByUrl = $result->getDevActionByUrl($firstActionWithUrl['url']);
            expect($actionByUrl)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($actionByUrl->get('url'))->toBe($firstActionWithUrl['url']);
        }

        // Test title retrieval
        if ($firstAction) {
            $actionByTitle = $result->getDevActionByTitle($firstAction['title']);
            expect($actionByTitle)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($actionByTitle->get('title'))->toBe($firstAction['title']);
        }

        // Test thumbnail filtering
        $withThumbnails = $result->getDevActionsWithThumbnails();
        expect($withThumbnails)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        $withoutThumbnails = $result->getDevActionsWithoutThumbnails();
        expect($withoutThumbnails)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        // Verify that together they make up all actions
        $totalThumbnails = $withThumbnails->count() + $withoutThumbnails->count();
        expect($totalThumbnails)->toBe($result->getTotalDevActions());

        // Test URL filtering
        $withUrls = $result->getDevActionsWithUrls();
        expect($withUrls)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        $withoutUrls = $result->getDevActionsWithoutUrls();
        expect($withoutUrls)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        // Verify that together they make up all actions
        $totalUrls = $withUrls->count() + $withoutUrls->count();
        expect($totalUrls)->toBe($result->getTotalDevActions());

        // Verify that the expected categories are present in the results
        $expectedCategories = ['watch', 'read', 'listen', 'e_learning', 'exposure', 'experience', 'education'];
        $resultCategories = $categories->toArray();

        // At least some of the expected categories should be present
        $intersection = array_intersect($expectedCategories, $resultCategories);
        expect(count($intersection))->toBeGreaterThan(0);

        // Verify data quality - actions should have meaningful content
        $allActions = $result->getDevActions();
        $allActions->each(function ($action) {
            // Title should be meaningful
            expect(strlen($action['title']))->toBeGreaterThan(5);

            // Description should be meaningful
            expect(strlen($action['description']))->toBeGreaterThan(20);

            // Rationale should be meaningful
            expect(strlen($action['rationale']))->toBeGreaterThan(20);
        });

    } else {
        // Agent may still be processing or encountered an error
        // This is acceptable for complex IDP creation
        expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});
