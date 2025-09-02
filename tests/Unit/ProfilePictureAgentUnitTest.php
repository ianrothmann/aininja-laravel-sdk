<?php

use IanRothmann\AINinja\AINinja;

it('can run an agent to generate a profile picture', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateProfilePicture()
        ->imageUrl('https://example.com/input-image.jpg')
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getImageUrl())->toBeString();
    expect($result->hasImage())->toBeTrue();
});

it('can handle image extension detection for profile picture', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateProfilePicture()
        ->imageUrl('https://example.com/test-profile.jpg')
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getImageUrl())->toBeString();

    // Test extension detection methods
    $extension = $result->getImageExtension();
    if ($extension) {
        expect($extension)->toBeString();
    }
});

it('can validate image types for profile picture results', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateProfilePicture()
        ->imageUrl('https://example.com/profile-photo.png')
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->hasImage())->toBeTrue();

    // Test image type validation methods exist
    expect(method_exists($result, 'isImageType'))->toBeTrue();
});