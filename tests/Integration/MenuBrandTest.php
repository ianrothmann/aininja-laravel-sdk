<?php

use IanRothmann\AINinja\AINinja;

it('can process a menu to find brands', function () {
    $handler = new AINinja;

    $result = $handler->processMenusForBrands()
        ->addUrl( "https://ain-public.s3.eu-west-1.amazonaws.com/menu/image_1.jpg")
        ->addUrl("https://ain-public.s3.eu-west-1.amazonaws.com/menu/image_16.jpg")
        ->addUrl("https://ain-public.s3.eu-west-1.amazonaws.com/menu/image_17.jpg")
        ->trackBrand("Klipdrift")
        ->trackBrand("Johnny Walker")
        ->get();

    expect($result->hasErrors())->toBeFalse()
        ->and($result->getTotalBrandCount())->toBeGreaterThan(0);
});
