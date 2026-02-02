<?php

use IanRothmann\AINinja\AINinja;

it('can run an IDP creator agent with basic setup', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->createIdp()
        ->addToPersonContext('role', 'Senior Data Analyst')
        ->addToPersonContext('level', 'mid-level')
        ->addToAssessmentContext('assessment_type', 'Competency Assessment')
        ->addToAssessmentContext('assessment_date', '2024-01-15')
        ->addDevelopmentCategory('watch', 'Videos to Watch', 3)
        ->addDevelopmentCategory('read', 'Articles to Read', 2)
        ->addCompetencyScore('data_visualization', 'Data Visualization', 2.5, 'Ability to visualize data')
        ->addCompetencyScore('analytics', 'Analytics', 3.0)
        ->instructions('Focus on data analytics and visualization')
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getDevActions())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getTotalDevActions())->toBeGreaterThan(0);
    }
});

it('can filter dev actions by category and priority', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->createIdp()
        ->addToPersonContext('role', 'Business Analyst')
        ->addToAssessmentContext('assessment_type', 'Skills Assessment')
        ->addDevelopmentCategory('e_learning', 'E-Learning Courses', 2)
        ->addDevelopmentCategory('listen', 'Podcasts to Listen', 2)
        ->addCompetencyScore('strategic_thinking', 'Strategic Thinking', 2.8)
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        // Test category filtering
        $watchActions = $result->getDevActionsByCategory('watch');
        expect($watchActions)->toBeInstanceOf(\Illuminate\Support\Collection::class);

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

it('can access dev actions by keyword and URL', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->createIdp()
        ->addToPersonContext('role', 'Operations Manager')
        ->addToAssessmentContext('assessment_type', 'Performance Review')
        ->addDevelopmentCategory('read', 'Reading Materials', 2)
        ->addDevelopmentCategory('experience', 'Experiential Learning', 1)
        ->addCompetencyScore('operational_efficiency', 'Operational Efficiency', 2.5)
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        // Test getting all keywords
        $allKeywords = $result->getAllKeywords();
        expect($allKeywords)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        // Test filtering by keyword
        if ($allKeywords->isNotEmpty()) {
            $firstKeyword = $allKeywords->first();
            $keywordActions = $result->getDevActionsByKeyword($firstKeyword);
            expect($keywordActions)->toBeInstanceOf(\Illuminate\Support\Collection::class);
        }

        // Test getting dev action by URL
        $firstAction = $result->getDevActions()->first();
        if ($firstAction && ! empty($firstAction['url'])) {
            $actionByUrl = $result->getDevActionByUrl($firstAction['url']);
            expect($actionByUrl)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($actionByUrl->get('url'))->toBe($firstAction['url']);
        }

        // Test getting dev action by title
        if ($firstAction) {
            $actionByTitle = $result->getDevActionByTitle($firstAction['title']);
            expect($actionByTitle)->toBeInstanceOf(\Illuminate\Support\Collection::class);
            expect($actionByTitle->get('title'))->toBe($firstAction['title']);
        }
    }
});

it('can filter dev actions with and without thumbnails', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->createIdp()
        ->addToPersonContext('role', 'Product Manager')
        ->addToAssessmentContext('assessment_type', 'Quarterly Review')
        ->addDevelopmentCategory('watch', 'Videos', 2)
        ->addDevelopmentCategory('exposure', 'Exposure Activities', 1)
        ->addCompetencyScore('product_strategy', 'Product Strategy', 3.0)
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        // Test filtering actions with thumbnails
        $withThumbnails = $result->getDevActionsWithThumbnails();
        expect($withThumbnails)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        // Test filtering actions without thumbnails
        $withoutThumbnails = $result->getDevActionsWithoutThumbnails();
        expect($withoutThumbnails)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        // Verify that together they make up all actions
        $total = $withThumbnails->count() + $withoutThumbnails->count();
        expect($total)->toBe($result->getTotalDevActions());
    }
});

it('can filter dev actions with and without URLs', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->createIdp()
        ->addToPersonContext('department', 'Engineering')
        ->addToAssessmentContext('assessment_type', 'Technical Assessment')
        ->addDevelopmentCategory('experience', 'Hands-on Experience', 2)
        ->addDevelopmentCategory('e_learning', 'Online Courses', 2)
        ->addCompetencyScore('technical_skills', 'Technical Skills', 2.7)
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        // Test filtering actions with URLs
        $withUrls = $result->getDevActionsWithUrls();
        expect($withUrls)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        // Test filtering actions without URLs
        $withoutUrls = $result->getDevActionsWithoutUrls();
        expect($withoutUrls)->toBeInstanceOf(\Illuminate\Support\Collection::class);

        // Verify that together they make up all actions
        $total = $withUrls->count() + $withoutUrls->count();
        expect($total)->toBe($result->getTotalDevActions());
    }
});

it('can handle avoid actions parameter', function () {
    $handler = new AINinja;

    $agent = $handler->agent()
        ->createIdp()
        ->addToPersonContext('role', 'Analyst')
        ->addToAssessmentContext('assessment_type', 'Annual Review')
        ->addDevelopmentCategory('read', 'Reading List', 2)
        ->addCompetencyScore('analysis', 'Analysis', 3.2)
        ->avoidActions(['webinar', 'certification']);

    // Test that the agent can be configured without errors
    expect($agent)->toBeInstanceOf(\IanRothmann\AINinja\Processors\Agents\IdpCreatorAgent::class);

    // Test that toArray doesn't throw exceptions
    $data = $agent->toArray();
    expect($data)->toBeArray();
    expect($data)->toHaveKey('endpoint');
    expect($data)->toHaveKey('input');
    expect($data['endpoint'])->toBe('/idp_creator');
});

it('can build complex agent configuration with all features', function () {
    $handler = new AINinja;

    $agent = $handler->agent()
        ->createIdp()
        ->addToPersonContext('role', 'Senior Operations Manager')
        ->addToPersonContext('department', 'Business Solutions')
        ->addToPersonContext('tenure', '8 years')
        ->addToAssessmentContext('assessment_type', 'Comprehensive Review')
        ->addToAssessmentContext('assessment_date', '2024-01-15')
        ->addToAssessmentContext('context', 'Transformation Programme')
        ->addDevelopmentCategory('watch', 'Videos to Watch', 3)
        ->addDevelopmentCategory('read', 'Articles to Read', 3)
        ->addDevelopmentCategory('listen', 'Podcasts to Listen', 3)
        ->addDevelopmentCategory('e_learning', 'E-Learning Courses', 3)
        ->addDevelopmentCategory('exposure', 'Exposure Activities', 3)
        ->addDevelopmentCategory('experience', 'Experiential Learning', 3)
        ->addDevelopmentCategory('education', 'Formal Education', 2)
        ->addCompetencyScore('data_visualization', 'Data Visualization', 2.5, 'Ability to visualize data', 0.0, 5.0)
        ->addCompetencyScore('forecasting', 'Forecasting', 2.8)
        ->addCompetencyScore('strategic_thinking', 'Strategic Thinking', 3.5, 'Strategic planning ability', 1.0, 5.0)
        ->avoidActions('actions_already_completed')
        ->instructions('Focus on analytics, forecasting, and data-driven decision making in transformation context');

    // Test that the agent can be configured without errors
    expect($agent)->toBeInstanceOf(\IanRothmann\AINinja\Processors\Agents\IdpCreatorAgent::class);

    // Test that toArray doesn't throw exceptions
    $data = $agent->toArray();
    expect($data)->toBeArray();
    expect($data)->toHaveKey('endpoint');
    expect($data)->toHaveKey('input');
    expect($data['endpoint'])->toBe('/idp_creator');

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

    expect($input['development_categories'])->toHaveCount(7);
    expect($input['competency_scores'])->toHaveCount(3);

    // Verify that development categories don't have development_actions
    foreach ($input['development_categories'] as $category) {
        expect($category)->toHaveKey('id');
        expect($category)->toHaveKey('name');
        expect($category)->toHaveKey('num_items_required');
        expect($category)->not->toHaveKey('development_actions');
    }
});

it('validates that development categories are arrays without development_actions', function () {
    $handler = new AINinja;

    $agent = $handler->agent()
        ->createIdp()
        ->addToPersonContext('role', 'Tester')
        ->addToAssessmentContext('assessment_type', 'Test Assessment')
        ->addDevelopmentCategory('test_category', 'Test Category', 5)
        ->addCompetencyScore('test_skill', 'Test Skill', 1.5);

    $data = $agent->toArray();
    $categories = $data['input']['development_categories'];

    expect($categories)->toBeArray();
    expect($categories)->toHaveCount(1);

    $firstCategory = $categories[0];
    expect($firstCategory)->toHaveKey('id');
    expect($firstCategory)->toHaveKey('name');
    expect($firstCategory)->toHaveKey('num_items_required');
    expect($firstCategory['id'])->toBe('test_category');
    expect($firstCategory['name'])->toBe('Test Category');
    expect($firstCategory['num_items_required'])->toBe(5);

    // Verify no development_actions key exists
    expect($firstCategory)->not->toHaveKey('development_actions');
});
