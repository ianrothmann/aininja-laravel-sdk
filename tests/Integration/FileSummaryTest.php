<?php

use IanRothmann\AINinja\AINinja;

it('can create a file summary', function () {
    $handler = new AINinja;

    $result = $handler->summarizeFile()
        ->forUrl('https://kaggle-audio-files-2.s3.amazonaws.com/1183533964.pdf')
        ->withContext('The document is a paper about Mathematics. Try to make the summary as understandable as possible to the average person.')
        ->get();

    expect($result->getSummary())->toBeString()
        ->and($result->getComplement())->toBeString();
});
