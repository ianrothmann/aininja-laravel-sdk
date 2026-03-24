<?php

use IanRothmann\AINinja\AINinja;

it('can run success profile matcher agent', function () {
    $result = (new AINinja)->agent()
        ->matchSuccessProfiles()
        ->successProfiles([
            [
                'successprofileid' => 1,
                'name' => 'Senior Software Engineer',
                'requirements' => [
                    'education' => ["Bachelor's degree in Computer Science"],
                    'experience' => ['5+ years software development', '2+ years team leadership'],
                ],
            ],
        ])
        ->eligiblePersons([
            'person_001' => 'Alex has 8 years of software development experience, led a team of 5 engineers, holds a BSc Computer Science.',
            'person_002' => 'Sam has 1 year of experience as a junior developer, recently graduated.',
        ])
        ->cosineSimilarityThreshold(0.5)
        ->runAndWait(10);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getFinalMatches())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getMatchCount())->toBeGreaterThanOrEqual(0);
    }
});
