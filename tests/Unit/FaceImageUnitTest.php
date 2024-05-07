<?php

use IanRothmann\AINinja\AINinja;

it('can process a face image', function () {
    $handler = new AINinja();

    $result = $handler->processFaceImage()
        ->whereUrl('https://kaggle-audio-files-2.s3.amazonaws.com/th-2370801218.jpeg')
        ->withDescription()
        ->withComplement()
        ->get();

    expect($result->getError())->toBeNull()
        ->and($result->getDescription())->toBeString()
        ->and($result->getComplement())->toBeString();
});
