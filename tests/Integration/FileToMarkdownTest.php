<?php

use IanRothmann\AINinja\AINinja;

it('can convert a file to markdown', function () {
    $handler = new AINinja;

    $result = $handler->convertFileToMarkdown()
        ->forURL('https://kaggle-audio-files-2.s3.us-east-1.amazonaws.com/summary.docx')
        ->get();

    expect($result->wasSuccessful())->toBeBool()
        ->and($result->getMarkdown())->toBeString()
        ->and($result->getErrorMessage())->toBeNull();

    if ($result->wasSuccessful()) {
        expect($result->getMarkdown())->toBeString();
        expect($result->getErrorMessage())->toBeNull();
    } else {
        expect($result->getErrorMessage())->toBeString();
    }
});