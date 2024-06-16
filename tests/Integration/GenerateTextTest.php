<?php

use IanRothmann\AINinja\AINinja;

it('can generate text', function () {
    $handler = new AINinja();

    $result = $handler->generateText()
        ->addInstruction('Write five names for babies')
        ->addInstruction('The babies are African')
        ->setTraceId('Test')
        ->get();

    expect($result->getResult())->toBeString();
});
