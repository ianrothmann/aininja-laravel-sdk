<?php

use IanRothmann\AINinja\AINinja;
use Illuminate\Support\Collection;

it('can run learning actions generator agent', function () {
    $result = (new AINinja)->agent()
        ->generateLearningActions()
        ->person([
            'id' => 'person_001',
            'country' => 'New Zealand',
            'city' => 'Auckland',
            'timezone' => 'Pacific/Auckland',
            'language' => 'en',
        ])
        ->resourcePreferences([
            'read' => 'high',
            'listen' => 'medium',
            'watch' => 'medium',
            'e_learning' => 'low',
        ])
        ->activeLearningDomains([
            [
                'id' => 'ld_001',
                'title' => 'Strategic Leadership',
                'summary' => 'Developing strategic thinking and executive influence at a senior level.',
                'candidate_description' => 'Build the skills needed to move into a VP Engineering or CTO role.',
                'goal_links' => [
                    ['goal_id' => 'goal_001', 'goal_name' => 'Senior Leadership Role', 'link_strength' => 'primary'],
                ],
            ],
        ])
        ->runContext([
            'run_date' => '2026-03-31',
            'target_total_items' => 5,
        ])
        ->runAndWait(10);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getWeeklyLearningActions())->toBeInstanceOf(Collection::class);
        expect($result->getWeeklyPlanSummary())->toBeInstanceOf(Collection::class);
        expect($result->getPersonId())->toBeString();
        expect($result->getRunDate())->toBeString();
    }
});
