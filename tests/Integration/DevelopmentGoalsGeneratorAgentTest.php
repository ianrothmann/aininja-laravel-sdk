<?php

use IanRothmann\AINinja\AINinja;
use Illuminate\Support\Collection;

it('can run development goals generator agent', function () {
    $result = (new AINinja)->agent()
        ->generateDevelopmentGoals()
        ->personContext([
            'name' => 'Alex',
            'current_role' => 'Senior Software Engineer',
            'current_organization' => 'Acme Technologies',
            'professional_summary' => 'Experienced software engineer with 10 years specialising in distributed systems and technical leadership.',
        ])
        ->currentState([
            'strengths' => [
                ['title' => 'Applies structure and prioritises to deliver results', 'summary' => 'Consistently brings order and focus to complex, multi-workstream engagements.'],
                ['title' => 'Builds trust through relationships', 'summary' => 'Creates an environment of psychological safety and strong team cohesion.'],
            ],
            'development_areas' => [
                ['title' => 'Letting collaboration slow bold decisions', 'summary' => 'Tendency to seek consensus can delay decisive action in high-stakes situations.'],
                ['title' => 'Asserting views in high-stakes forums', 'summary' => 'Holds back own perspective when presenting to senior stakeholders.'],
            ],
            'instrument_interpretations' => [],
        ])
        ->futureState([
            'aspirations' => [
                ['title' => 'Move into a VP Engineering or CTO role', 'summary' => 'Lead a large engineering organisation and contribute to executive strategy within 3-5 years.'],
            ],
        ])
        ->runAndWait(10);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getDevelopmentGoals())->toBeInstanceOf(Collection::class);
        expect($result->getRejectedCandidateGoals())->toBeInstanceOf(Collection::class);
        expect($result->getGoalCount())->toBeGreaterThan(0);
    }
});
