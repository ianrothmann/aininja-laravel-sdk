<?php

use IanRothmann\AINinja\AINinja;

it('can navigate the question chat', function () {
    $handler = new AINinja();

    $result = $handler->navigateQuestionChat()
        ->withQuestion('1', 'What is your name')
        ->withQuestion('2', 'Where have you worked before')
        ->withQuestion('3', 'What is your favourite colour')
        ->withQuestion('4', 'What is your favourite animal')
        ->withResponse('Can I go back to the first question?')
        ->withContext('The user is Ian Rothmann and he is a software developer')
        ->get();

    expect($result->getType())->toBeString()
        ->and($result->getQuestion())->toBeString()
        ->and($result->getQuestionNumber())->toBeInt()
        ->and($result->getComplement())->toBeNull()
        ->and($result->getComment())->toBeNull()
        ->and($result->getClarification())->toBeNull();
});
