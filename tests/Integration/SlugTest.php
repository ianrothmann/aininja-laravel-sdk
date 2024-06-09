<?php

use IanRothmann\AINinja\AINinja;

it('can generate a slug', function () {
    $handler = new AINinja();

    $result = $handler->generateSlug()
        ->basedOn("Project: Barman for Joe's Cocktail Bar. Interview: Barman (Cocktail)")
        ->get();

    expect($result->getResult())->toBeString();
});
