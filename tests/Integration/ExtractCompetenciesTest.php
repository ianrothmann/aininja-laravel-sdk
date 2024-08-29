<?php

use IanRothmann\AINinja\AINinja;

it('extract competencies from text', function () {
    $handler = new AINinja;

    $text = <<<TOC
Motivate

Inspiring
Purpose Creation

Enable

Promoting Flexibility
Cultivating Diverse Talent
Connect

Persuasion
Teamwork

Develop

Achieving Outcomes
Business Growth
TOC;

    $result = $handler->extractCompetencies()
        ->fromText($text)
        ->get();

    expect($result->getCompetenciesByCategory()->toArray())->not()->toBeEmpty();
    expect($result->getCategories()->toArray())->not()->toBeEmpty();
});
