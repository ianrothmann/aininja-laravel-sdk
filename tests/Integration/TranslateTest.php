<?php

use IanRothmann\AINinja\AINinja;

it('can translate', function () {
    $handler = new AINinja();

    $result = $handler->translate()
        ->text('What is your favorite movie of :era?')
        ->to('Afrikaans', 'af')
        ->to('Spanish', 'es')
        ->withParameter(':era')
        ->get();

    expect($result->getTranslation())->toBeArray();
});
