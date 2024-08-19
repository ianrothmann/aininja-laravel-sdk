<?php

use IanRothmann\AINinja\AINinja;

it('can summarize text', function () {
    $handler = new AINinja;

    $result = $handler->summarizeText()
        ->basedOn('I wanted to walk ten more steps to finish, but my legs were too tired and wouldn\'t move, even though I really tried. It looks like I can\'t do it.')
        ->forTargetGradeLevel(1)
        ->inFirstPerson(true)
        ->withWordLimit(10)
        ->get();

    expect($result->getResult())->toBeString();
});
