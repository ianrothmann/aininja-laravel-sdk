<?php

use IanRothmann\AINinja\AINinja;

it('query RAG', function () {
    $handler = new AINinja;
    /*
     * "question": "Tell me about the rules regarding white belts.",
                "additional_info": "Be specific about the illegal techniques.",
                "collection_names": [
                    "ajp-rule-book-dd59bcac-371e-4b26-8402-f09a5573a8f7",
     */
    $result = $handler->queryCollection()
        ->onCollections(['ajp-rule-book-dd59bcac-371e-4b26-8402-f09a5573a8f7'])
        ->question('Tell me about the rules regarding white belts.')
        ->withAnswerGuidelines('Be specific about the illegal techniques.')
        ->get();

    expect($result->getAnswer())->toBeString();
    expect($result->getQuestion())->toBeString();

    $result->getContext()->each(function (\IanRothmann\AINinja\Results\Containers\QueryAnswerSourceDocument $context) {
        expect($context->getPageNumber())->not()->toBeEmpty();
        expect($context->getContent())->toBeString();
        expect($context->getCollectionName())->toBeString();
    });

});
