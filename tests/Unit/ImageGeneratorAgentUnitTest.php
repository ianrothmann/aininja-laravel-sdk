<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\ImageGeneratorAgent;

it('can run an agent to generate image with basic parameters', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateImage()
        ->withInstruction('Create a beautiful landscape with mountains and a lake')
        ->withStyle(ImageGeneratorAgent::STYLE_PHOTOREALISTIC)
        ->runAndWait(3);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getImageUrl())->toBeString();
    expect($result->hasImage())->toBeTrue();
});

it('can run an agent to generate image with input images', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateImage()
        ->withInstruction('Transform this image into a cinematic scene')
        ->withStyle(ImageGeneratorAgent::STYLE_CINEMATIC)
        ->addInputImage('https://example.com/input1.jpg', 'A person standing in a field')
        ->addInputImage('https://example.com/input2.jpg', 'A sunset background')
        ->runAndWait(3);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getImageUrl())->toBeString();
    expect($result->hasImage())->toBeTrue();
});

it('can run an agent to generate surreal style image', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateImage()
        ->withInstruction('Create a dreamlike scene with floating objects')
        ->withStyle(ImageGeneratorAgent::STYLE_SURREAL)
        ->runAndWait(3);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getImageUrl())->toBeString();
    expect($result->hasImage())->toBeTrue();
});

it('can handle image extension detection', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateImage()
        ->withInstruction('Create a test image')
        ->withStyle(ImageGeneratorAgent::STYLE_HYPERREALISTIC)
        ->runAndWait(3);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getImageUrl())->toBeString();

    // Test extension detection methods
    $extension = $result->getImageExtension();
    if ($extension) {
        expect($extension)->toBeString();
    }
});

it('can handle input images array format', function () {
    $handler = new AINinja;

    $inputImages = [
        ['url' => 'https://example.com/test1.jpg', 'context' => 'First test image'],
        ['url' => 'https://example.com/test2.jpg', 'context' => 'Second test image'],
    ];

    $result = $handler->agent()
        ->generateImage()
        ->withInstruction('Combine these images creatively')
        ->withStyle(ImageGeneratorAgent::STYLE_DAYLIGHT_REALISM)
        ->withInputImages($inputImages)
        ->runAndWait(3);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getImageUrl())->toBeString();
    expect($result->hasImage())->toBeTrue();
});
