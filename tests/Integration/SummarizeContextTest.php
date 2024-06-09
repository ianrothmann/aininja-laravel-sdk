<?php

use IanRothmann\AINinja\AINinja;

it('can summarize context', function () {
    $handler = new AINinja();

    $result = $handler->summarizeContext()
        ->withContext(
            [
                'Name' => 'Ian Rothmann',
                'Nationality' => 'South African',
            ]
        )
        ->get();

    expect($result->getResult())->toBeString();
});
