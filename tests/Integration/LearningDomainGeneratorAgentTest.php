<?php

use IanRothmann\AINinja\AINinja;
use Illuminate\Support\Collection;

it('can run learning domain generator agent', function () {
    $result = (new AINinja)->agent()
        ->generateLearningDomains()
        ->personProfile([
            'id' => 'person_001',
            'name' => 'Alex',
            'surname' => 'Morgan',
            'country' => 'New Zealand',
            'current_position' => 'Senior Software Engineer',
            'current_organization' => 'Acme Technologies',
            'background' => [
                'summary' => 'Experienced software engineer with 10 years of experience, specialising in distributed systems and technical leadership.',
            ],
        ])
        ->developmentGoals([
            [
                'id' => 'goal_001',
                'name' => 'Senior Leadership Role',
                'description' => 'Move into a VP Engineering or CTO role within 3-5 years.',
                'status' => 'active',
            ],
        ])
        ->generationContext([
            'output_language_name' => 'British English',
            'output_language_code' => 'en',
            'generation_mode' => 'llm_only',
        ])
        ->runAndWait(10);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getLearningDomains())->toBeInstanceOf(Collection::class);
        expect($result->getGenerationSummary())->toBeInstanceOf(Collection::class);
        expect($result->getPersonId())->toBeString();
    }
});
