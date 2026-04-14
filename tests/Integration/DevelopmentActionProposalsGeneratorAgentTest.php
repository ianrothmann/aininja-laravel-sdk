<?php

use IanRothmann\AINinja\AINinja;
use Illuminate\Support\Collection;

it('can run development action proposals generator agent', function () {
    $result = (new AINinja)->agent()
        ->generateDevelopmentActionProposals()
        ->profile([
            'language_id' => 'en',
            'name' => 'Alex',
            'surname' => 'Smith',
            'subtitle' => 'Management Consultant focused on CFO transformation.',
            'current_position' => 'Director',
            'current_organization' => 'KPMG',
            'country' => 'South Africa',
            'city' => 'Johannesburg',
        ])
        ->contexts([
            'growth_insights.strengths' => [
                'label' => 'Strengths',
                'catalog' => 'Growth Insights',
                'entries' => [
                    ['title' => 'Disciplined, structured approach to achieving results', 'summary' => 'Approaches tasks methodically with clear steps.'],
                ],
            ],
            'growth_insights.development_areas' => [
                'label' => 'Development Areas',
                'catalog' => 'Growth Insights',
                'entries' => [
                    ['title' => 'Executive communication lacks clarity and presence', 'summary' => 'Messages to senior audiences sometimes lack the punch needed to drive action.'],
                ],
            ],
        ])
        ->developmentGoals([
            ['id' => 'goal_001', 'name' => 'Lead with clarity and decisiveness in complex CFO transformations', 'description' => 'Making timely, firm decisions and guiding teams through uncertainty.'],
            ['id' => 'goal_002', 'name' => 'Shape a clear, outcome-driven executive presence for CFO and Board audiences', 'description' => 'Building a strong, confident presence and delivering clear, action-focused messages.'],
        ])
        ->generationRequest([
            'mode' => 'mixed',
            'max_total' => 4,
            'novelty_threshold' => 'strict',
            'proposal_specificity' => 'mid',
            'rationale_style' => 'coach_like',
            'language' => 'en',
        ])
        ->runAndWait(10);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getSummary())->toBeInstanceOf(Collection::class);
        expect($result->getProposals())->toBeInstanceOf(Collection::class);
        expect($result->getProposalCount())->toBeGreaterThan(0);
    }
});
