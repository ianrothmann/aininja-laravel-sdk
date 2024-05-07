<?php

use IanRothmann\AINinja\AINinja;

it('can probe a question', function () {
    $handler = new AINinja();

    $result = $handler->probeInterviewQuestion()
        ->withQuestion('Please share with us your experience in bartending.')
        ->forAnswer('I have been working as a bartender for over 3 years, specializing in mixology and craft cocktails, but I have been working as a waiter for more than 10 years.')
        ->withResponseType('audio')
        ->whereIdealAnswer('The candidate should talk about their experience in bartending, focusing on high-end or luxury establishments if possible. They should discuss their knowledge of a wide range of cocktails, as well as their ability to create new and innovative drinks that appeal to discerning customers. They might mention any relevant certifications or training they have received.')
        ->withContext('The candidate is Ian Rothmann.')
        ->withOtherQuestions(
            [
                'What is your favorite cocktail to make?',
                'What is your favorite cocktail to drink?',
            ]
        )
        ->get();

    expect($result->getAnswerSufficient())->toBeInt()
        ->and($result->getProbingQuestion())->toBeString();
});
