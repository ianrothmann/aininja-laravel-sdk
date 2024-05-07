<?php

use IanRothmann\AINinja\AINinja;

it('can navigate the question chat', function () {
    $handler = new AINinja();

    $result = $handler->navigateQuestionChat()
        ->withQuestions(
            [
                ["question_number" => "1", "question" => "What is your name"],
                ["question_number" => "2", "question" => "Where have you worked before"],
                ["question_number" => "3", "question" => "What is your favourite colour"],
                ["question_number" => "4", "question" => "What is your favourite animal"]
            ])
        ->withResponse('Can I go back to the first question?')
        ->withContext('The user is Ian Rothmann and he is a software developer')
        ->get();

    expect($result->getResult())->toBeString();
});
