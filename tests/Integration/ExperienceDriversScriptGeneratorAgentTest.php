<?php

use IanRothmann\AINinja\AINinja;

it('can run experience drivers script generator agent', function () {
    $result = (new AINinja)->agent()
        ->generateExperienceDriversScript()
        ->firstName('Sam')
        ->candidateContext('Sam is a senior software engineer with 8 years experience. He values independence and has expressed a strong desire for continuous learning and growth. His top experience drivers reflect autonomy, growth orientation, and a need for purposeful work.')
        ->experienceDriverDictionary([
            'AUT' => ['label' => 'Autonomy', 'definition' => 'The need for independence, self-direction, and freedom from external control in work.'],
            'GRW' => ['label' => 'Growth', 'definition' => 'The drive to continuously learn, develop skills, and advance professionally.'],
            'PRP' => ['label' => 'Purpose', 'definition' => 'The need for work to feel meaningful and connected to larger goals or outcomes.'],
        ])
        ->top3DriverCodes('AUT', 'GRW', 'PRP')
        ->runAndWait(10);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getTitle())->toBeString();
        expect($result->getScript())->toBeString();
        expect($result->getWordCount())->toBeInt();
        expect($result->getHiddenInterpretation())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});
