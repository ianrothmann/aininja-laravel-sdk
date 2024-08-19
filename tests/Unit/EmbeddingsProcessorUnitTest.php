<?php

use IanRothmann\AINinja\AINinja;

it('can generate embeddings for text', function () {
    $handler = new AINinja;

    $result = $handler->embeddings()
        ->addText('Zero')
        ->addText('One')
        ->get();

    expect($result->getResult())->toHaveLength(2);
});
