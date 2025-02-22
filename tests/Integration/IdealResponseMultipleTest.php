<?php

use IanRothmann\AINinja\AINinja;

it('can generate multiple ideal responses', function () {
    $handler = new AINinja;

    $result = $handler->generateIdealResponses()
        ->forQuestion(
            1,
            'Please describe your experience with machine learning frameworks and libraries. Which ones have you worked with most extensively',
            'text',
        )
        ->forQuestion(
            2,
            'Discuss a project where you were responsible for developing and deploying a machine learning model. What was your role, and what were the outcomes?',
            'audio',
        )
        ->forQuestion(
            3,
            'Which of the following best describes your level of proficiency with data visualization tools?',
            'option',
            [78 => 'Beginner', 79 => 'Intermediate', 80 => 'Advanced']
        )
        ->givenRequirements('The candidate should have experience with deep learning frameworks and libraries.')
        ->addExistingIdealAnswer(
            'Please describe your experience with machine learning frameworks and libraries. Which ones have you worked with most extensively',
            'The candidate has extensive experience with TensorFlow and PyTorch, having developed multiple projects that leverage deep learning to solve complex problems.'
        )
        // ->dd()
        ->get();
    expect($result->getResult())->toBeArray();
});
