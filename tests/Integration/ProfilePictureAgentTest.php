<?php

use IanRothmann\AINinja\AINinja;

it('can run an agent to generate a profile picture', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateProfilePicture()
        ->imageUrl('https://images.unsplash.com/photo-1755378988619-216a5a111e0f?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')
        ->setTraceId('ProfilePictureAgentTest')
        ->runAndWait(60);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getImageUrl())->toBeString();
        expect($result->hasImage())->toBeTrue();

        $extension = $result->getImageExtension();
        if ($extension) {
            expect($extension)->toBeString();
        }
    }
});
