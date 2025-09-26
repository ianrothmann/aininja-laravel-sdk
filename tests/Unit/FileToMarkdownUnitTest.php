<?php

use IanRothmann\AINinja\AINinja;

it('can convert a file to markdown', function () {
    $handler = new AINinja;

    $result = $handler->convertFileToMarkdown()
        ->forURL('https://example.com/sample-document.pdf')
        ->get();

    expect($result->wasSuccessful())->toBeTrue()
        ->and($result->getMarkdown())->toBeString()
        ->and($result->getErrorMessage())->toBeNull();
});