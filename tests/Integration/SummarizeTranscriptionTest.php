<?php

use IanRothmann\AINinja\AINinja;

it('can summarize a transcription', function () {
    $handler = new AINinja;

    $result = $handler->summarizeTranscription()
        ->basedOn('A Laravel Developer in PHP')
        ->forName('John Doe')
        ->withGender('Male')
        ->get();

    expect($result->getResult())->toBeString();
});
