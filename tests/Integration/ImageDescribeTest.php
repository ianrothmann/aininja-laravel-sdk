<?php

use IanRothmann\AINinja\AINinja;

it('can describe an image', function () {
    $handler = new AINinja;

    $result = $handler->describeImage()
        ->forUrl('https://kaggle-audio-files-2.s3.amazonaws.com/th-2244693358.jpeg')
        ->whereContext('The man in the image is Siya Kolisi')
        ->get();

    expect($result->getDescription())->toBeString()
        ->and($result->getComplement())->toBeString();
});
