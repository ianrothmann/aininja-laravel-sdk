<?php

use IanRothmann\AINinja\AINinja;

it('can generate multiple ideal responses', function () {
    $handler = new AINinja();

    $result = $handler->generateIdealResponses()
        ->basedOn([
            [
                "question" => "Please describe your experience with machine learning frameworks and libraries. Which ones have you worked with most extensively",
                "answer_format" => "text",
                "options" => null
            ],
            [
                "question" => "Discuss a project where you were responsible for developing and deploying a machine learning model. What was your role, and what were the outcomes?",
                "answer_format" => "audio",
                "options" => null
            ],
            [
                "question" => "Which of the following best describes your level of proficiency with data visualization tools?",
                "answer_format" => "options",
                "options" => "Beginner, Intermediate, Advanced, Expert"
            ]
        ])
        ->get();

    expect($result->getResult())->toBeArray();
});
