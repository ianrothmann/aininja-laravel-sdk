<?php

use IanRothmann\AINinja\AINinja;

it('can translate', function () {
    $handler = new AINinja();

    $result = $handler->translate()
        ->text('What is your favorite movie of :era?')
        ->to([
            'language_name' => 'Afrikaans',
            'language_code' => 'af',
        ])
        ->to([
            'language_name' => 'Spanish',
            'language_code' => 'es',
        ])
        ->withParameters([
            ':era',
        ])
        ->get();

    expect($result->getTranslation())->toBeArray();

    $result = $handler->translate()
        ->text('What is your favorite movie of :era?')
        ->toLanguages([
            [
                'language_name' => 'Afrikaans',
                'language_code' => 'af',
            ],
            [
                'language_name' => 'Spanish',
                'language_code' => 'es',
            ],
        ])
        ->withParameters([
            ':era',
        ])
        ->get();

    expect($result->getTranslation())->toBeArray();
});
