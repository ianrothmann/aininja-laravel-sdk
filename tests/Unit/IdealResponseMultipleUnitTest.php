<?php

use IanRothmann\AINinja\AINinja;

it('can generate multiple ideal responses', function () {
    $handler = new AINinja();

    $result = $handler->generateIdealResponses()
        ->forQuestion(
            'Please describe your experience with machine learning frameworks and libraries. Which ones have you worked with most extensively',
            'text',
        )
        ->forQuestion(
            'Discuss a project where you were responsible for developing and deploying a machine learning model. What was your role, and what were the outcomes?',
            'audio',
        )
        ->forQuestion(
            'Which of the following best describes your level of proficiency with data visualization tools?',
            'options',
            'Beginner, Intermediate, Advanced, Expert',
        )
//        ->withRequirement()
        ->addExistingIdealAnswer(
            'Please describe your experience with machine learning frameworks and libraries. Which ones have you worked with most extensively',
            'The candidate has extensive experience with TensorFlow and PyTorch, having developed multiple projects that leverage deep learning to solve complex problems.'
        )
        ->get();

    expect($result->getResult())->toBeArray();
});
