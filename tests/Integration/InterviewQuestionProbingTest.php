<?php

use IanRothmann\AINinja\AINinja;

it('can probe a question', function () {
    $handler = new AINinja;

    $result = $handler->probeInterviewQuestion()
        ->givenQuestion('Please share with us your experience in bartending.')
        ->withAnswer('I have been working as a bartender for over 3 years, specializing in mixology and craft cocktails, but I have been working as a waiter for more than 10 years.')
        ->wasResponseType('audio')
        ->whereIdealAnswer('The candidate should talk about their experience in bartending, focusing on high-end or luxury establishments if possible. They should discuss their knowledge of a wide range of cocktails, as well as their ability to create new and innovative drinks that appeal to discerning customers. They might mention any relevant certifications or training they have received.')
        ->withCandidateContext('The candidate is Ian Rothmann.')
        ->addOtherQuestion('What is your favorite cocktail to make?')
        ->addOtherQuestion('What is your favorite cocktail to drink?')
        ->get();

    expect($result->getAnswerSufficient())->toBeBool()
        ->and($result->getProbingQuestion())->toBeString();
});
