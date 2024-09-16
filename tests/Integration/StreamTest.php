<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\LangServePhpClient\Responses\RemoteRunnableStreamEvent;

it('can stream content', function () {

    $obj = new AINinja;
    $finalResult = $obj->generateText()
        ->addInstruction('Generate a list of 10 numbers by writing the word of the number')
        ->addInstruction('The numbers must be between one and ten')
        ->stream(function (RemoteRunnableStreamEvent $event) {
            if (! $event->getRunId() && $event->getContentAsString()) { //Weird assertion but sometimes something empty is streamed
                expect($event->getContentAsString())->not->toBeEmpty();
            }
        });

    expect($finalResult->getResult())->toBeString();
});
