<?php

use IanRothmann\AINinja\AINinja;
use Illuminate\Support\Collection;

it('can run current affairs extractor agent', function () {
    $result = (new AINinja)->agent()
        ->extractCurrentAffairs()
        ->personContext([
            'subtitle' => 'Chief Financial Officer',
            'background' => 'Senior finance executive with a track record across listed and private companies in Sub-Saharan Africa.',
            'current_position' => 'Chief Financial Officer',
            'current_organization' => 'Acme Mining Holdings',
            'years_of_experience' => 22,
            'country' => 'South Africa',
            'city' => 'Johannesburg',
            'highest_qualification' => 'CA(SA)',
            'aspirations' => [
                ['title' => 'Board-level role', 'summary' => 'Aspires to serve as a non-executive director on a JSE-listed board within five years.'],
            ],
            'development_goals' => [
                ['title' => 'Strengthen stakeholder communication', 'summary' => 'Develop sharper narrative skills for investor and board-level communication.'],
            ],
        ])
        ->runAndWait(10);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getGeneratedAt())->toBeString();
        expect($result->getSummary())->toBeInstanceOf(Collection::class);
        expect($result->getIssues())->toBeInstanceOf(Collection::class);
        expect($result->getChanges())->toBeInstanceOf(Collection::class);
        expect($result->getAgentContext())->toBeInstanceOf(Collection::class);
        expect($result->getIssueCount())->toBeGreaterThan(0);
    }
});
