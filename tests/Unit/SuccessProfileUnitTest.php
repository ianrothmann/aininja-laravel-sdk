<?php

use IanRothmann\AINinja\AINinja;

it('can create a success profile', function () {
    $handler = new AINinja;

    $result = $handler->createSuccessProfile()
        ->basedOn('A Laravel Developer in PHP')
        ->addCompetency('collaboration_and_teamwork', 'Collaboration and Teamwork', 'Works collaboratively with team members')
        ->addCompetency('communicating_with_impact', 'Communicating with Impact', 'Communicates with clarity and impact')
        ->get();

    expect($result->getCompetencies())->not()->toBeEmpty();
});
