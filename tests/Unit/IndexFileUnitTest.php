<?php

use IanRothmann\AINinja\AINinja;

it('can index a file for RAG', function () {
    $handler = new AINinja;

    $result = $handler->indexForQuery()
        ->forUrl('https://kaggle-audio-files-2.s3.amazonaws.com/rule-book.pdf')
        ->nameIs('AJP Rule Book')
        ->shouldSummarize(true)
        ->get();

    expect($result->getTitle())->toBeString();
    expect($result->getSummary())->toBeString();
    expect($result->getCollectionReference())->not()->toBeEmpty();

});
