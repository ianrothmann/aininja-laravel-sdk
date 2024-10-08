<?php

use IanRothmann\AINinja\AINinja;

it('can review the quality of the interview', function () {
    $handler = new AINinja;

    $result = $handler->reviewInterviewQuality()
        ->addQuestion(
            'Please share with us your experience in bartending.',
            'I have been working as a bartender for over 3 years, specializing in mixology and craft cocktails, but I have been working as a waiter for more than 10 years.',
            'audio',
        )
        ->addQuestion(
            'What are your specialities?',
            'Mixology, craft cocktails',
            'option',
            ['Whiskey', 'Vodka', 'Gin', 'Rum', 'Tequila', 'Brandy', 'Cognac', 'Liqueurs', 'Cocktails', 'Mocktails']
        )
        ->withRequirement('A head barman at an upmarket cocktail restaurant in Dubai')
        ->get();

    expect($result->getOverallRating())->toBeInt()
        ->and($result->getOverallComments())->toBeString()
        ->and($result->getGeneralSuggestions())->toBeString()
        ->and($result->getAdditionalQuestions())->toBeArray()
        ->and($result->getExpectedResponseComment())->toBeString()
        ->and($result->getResponseTypeReview())->toBeString();
});
