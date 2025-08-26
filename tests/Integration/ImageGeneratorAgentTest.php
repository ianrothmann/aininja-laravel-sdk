<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\ImageGeneratorAgent;

it('can run an agent to generate a photorealistic image', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateImage()
        ->withInstruction('Generate a beautiful mountain landscape with a crystal clear lake reflecting the peaks')
        ->withStyle(ImageGeneratorAgent::STYLE_PHOTOREALISTIC)
        ->setTraceId('ImageGeneratorAgentTest')
        ->runAndWait(60);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);

    if ($result->isSuccessful()) {
        expect($result->getImageUrl())->toBeString();
        expect($result->hasImage())->toBeTrue();

        $extension = $result->getImageExtension();
        if ($extension) {
            expect($extension)->toBeString();
        }
    }
});

it('can run an agent to generate a cinematic style image', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateImage()
        ->withInstruction('Create a dramatic scene of a lone figure walking through a futuristic cityscape at night')
        ->withStyle(ImageGeneratorAgent::STYLE_CINEMATIC)
        ->setTraceId('ImageGeneratorAgentCinematicTest')
        ->runAndWait(60);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);

    if ($result->isSuccessful()) {
        expect($result->getImageUrl())->toBeString();
        expect($result->hasImage())->toBeTrue();
    }
});

it('can run an agent to generate image with input images', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateImage()
        ->withInstruction('Transform this scene into a surreal artistic interpretation')
        ->withStyle(ImageGeneratorAgent::STYLE_SURREAL)
        ->addInputImage('https://picsum.photos/800/600', 'A random landscape photo for transformation')
        ->setTraceId('ImageGeneratorAgentWithInputTest')
        ->runAndWait(60);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);

    if ($result->isSuccessful()) {
        expect($result->getImageUrl())->toBeString();
        expect($result->hasImage())->toBeTrue();
    }
});
