<?php

use IanRothmann\AINinja\AINinja;

it('can review the quality of the interview', function () {
    $handler = new AINinja();

    $result = $handler->reviewInterviewQuality()
        ->forQuestions(
            [
                [
                    'question' => 'Please share with us your experience in bartending.',
                    'expected_answer' => 'I have been working as a bartender for over 3 years, specializing in mixology and craft cocktails, but I have been working as a waiter for more than 10 years.',
                    'response_type' => 'audio',
                ],
                [
                    'question' => 'What are your specialities?',
                    'expected_answer' => 'Mixology, craft cocktails',
                    'response_type' => 'text',
                ],
            ]
        )
        ->withRequirements(
            [
                'A head barman at an upmarket cocktail restaurant in Dubai',
            ]
        )
        ->get();

    expect($result->getOverallRating())->toBeInt()
        ->and($result->getOverallComments())->toBeString()
        ->and($result->getGeneralSuggestions())->toBeString()
        ->and($result->getAdditionalQuestions())->toBeString()
        ->and($result->getExpectedResponseComment())->toBeString()
        ->and($result->getResponseTypeReview())->toBeString();
});
