<?php

use IanRothmann\AINinja\AINinja;

it('can generate technical competency questions', function () {
    $handler = new AINinja;

    $result = $handler->generateTechnicalCompetencyQuestions()
        ->forAudience('Graduates in Computer Science applying for a software engineering position')
        ->inContextOf('Microsoft')
        ->forCompetency('PHP Coding Skills', 'Ability to understand and write PHP code')
        ->numberOfQuestions(1, 1, 1)
        ->get();

    expect($result->getQuestions()->toArray())->toBeArray()->toHaveLength(3);
});
