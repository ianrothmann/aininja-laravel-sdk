<?php

use IanRothmann\AINinja\AINinja;

it('can generate text with advanced mode', function () {
    $handler = new AINinja;

    $result = $handler->generateText()
        ->addInstruction('Write five names for babies')
        ->addInstruction('The babies are African')
        ->setTraceId('Test')
        ->useAdvancedMode()
        ->get();

    expect($result->getResult())->toBeString();
});

it('can generate text with default mode', function () {
    $handler = new AINinja;

    $result = $handler->generateText()
        ->addInstruction('Write five names for babies')
        ->addInstruction('The babies are African')
        ->setTraceId('Test')
        ->get();

    expect($result->getResult())->toBeString();
});

it('can generate text with quick mode', function () {
    $handler = new AINinja;

    $result = $handler->generateText()
        ->addInstruction('Write five names for babies')
        ->addInstruction('The babies are African')
        ->setTraceId('Test')
        ->useQuickMode()
        ->get();

    expect($result->getResult())->toBeString();
});

it('can generate text without reasoning', function () {
    $handler = new AINinja;

    $result = $handler->generateText()
        ->addInstruction('Write five names for babies')
        ->addInstruction('The babies are African')
        ->setTraceId('Test')
        ->withoutReasoning()
        ->get();

    expect($result->getResult())->toBeString();
});
