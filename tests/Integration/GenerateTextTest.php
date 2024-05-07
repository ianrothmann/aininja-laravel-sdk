<?php

use IanRothmann\AINinja\AINinja;

it('can generate text', function () {
    $handler = new AINinja();

    $result = $handler->generateText()
        ->withInstruction('Write five names for babies')
        ->withInstruction('The babies are African')
        ->get();

    expect($result->getResult())->toBeString();

    $result = $handler->generateText()
        ->withInstructions([
            'Write five names for babies',
            'The babies are African'
        ])
        ->get();

    expect($result->getResult())->toBeString();
});