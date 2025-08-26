<?php

use IanRothmann\AINinja\AINinja;

it('query RAG', function () {
    $handler = new AINinja;

    $result = $handler->queryCollections()
        ->onCollections(['ajp-rule-book-1906131a-acd0-4ac6-b7d3-339b704be0aa'])
        ->question('Tell me about the rules regarding white belts.')
        ->withAnswerGuidelines('Be specific about the illegal techniques.')
        ->get();

    expect($result->getAnswer())->toBeString();
    expect($result->getQuestion())->toBeString();

    $result->getContext()->each(function (\IanRothmann\AINinja\Results\Containers\QueryAnswerSourceDocument $context) {
        //expect($context->getPageNumber())->not()->toBeEmpty();
        expect($context->getContent())->toBeString();
        expect($context->getCollectionName())->toBeString();
    });

});
