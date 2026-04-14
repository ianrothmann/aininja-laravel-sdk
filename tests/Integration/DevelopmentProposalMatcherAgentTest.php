<?php

use IanRothmann\AINinja\AINinja;
use Illuminate\Support\Collection;

it('can run development proposal matcher agent', function () {
    $result = (new AINinja)->agent()
        ->matchDevelopmentProposals()
        ->developmentGoals([
            [
                'id' => 'goal_001',
                'name' => 'Lead with clarity and decisiveness in complex CFO transformations',
                'description' => 'This goal is about making timely, firm decisions and guiding teams through uncertainty, especially when change is complex or ambiguous.',
            ],
            [
                'id' => 'goal_002',
                'name' => 'Shape a compelling vision for finance transformation',
                'description' => 'This goal is about developing a clear, forward-looking point of view on key finance trends and making it central to your team\'s work.',
            ],
        ])
        ->developmentProposals([
            [
                'id' => 'proposal_001',
                'name' => 'Complete an Internal Collaboration Project',
                'description' => 'Lead a cross-functional piece of work that requires structured decision-making and stakeholder alignment.',
                'rationale' => 'Strengthens the ability to move complex work forward while balancing input, pace, and alignment.',
                'category' => 'experience',
            ],
            [
                'id' => 'proposal_002',
                'name' => 'Publish a CFO POV on AI Operating Models',
                'description' => 'Co-author a concise viewpoint grounded in real cases and clear guardrails.',
                'rationale' => 'Advances the goal of shaping a compelling vision through visible thought leadership.',
                'category' => 'exposure',
            ],
        ])
        ->runAndWait(10);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getGoalMatches())->toBeInstanceOf(Collection::class);
        expect($result->getUnmatchedGoalIds())->toBeInstanceOf(Collection::class);
        expect($result->getUnmatchedProposalIds())->toBeInstanceOf(Collection::class);
    }
});
