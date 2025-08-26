<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\ImageGeneratorAgent;

//it('can run an agent to generate a photorealistic image', function () {
//    $handler = new AINinja;
//
//    $result = $handler->agent()
//        ->generateImage()
//        ->withInstruction('Generate a beautiful mountain landscape with a crystal clear lake reflecting the peaks')
//        ->withStyle(ImageGeneratorAgent::STYLE_PHOTOREALISTIC)
//        ->setTraceId('ImageGeneratorAgentTest')
//        ->runAndWait(60);
//
//    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
//    expect($result->isSuccessful())->toBeTrue();
//    if ($result->isSuccessful()) {
//        expect($result->getImageUrl())->toBeString();
//        expect($result->hasImage())->toBeTrue();
//
//        $extension = $result->getImageExtension();
//        if ($extension) {
//            expect($extension)->toBeString();
//        }
//    }
//});

//it('can run an agent to generate a cinematic style image', function () {
//    $handler = new AINinja;
//
//    $result = $handler->agent()
//        ->generateImage()
//        ->withInstruction('Create a dramatic scene of a lone figure walking through a futuristic cityscape at night')
//        ->withStyle(ImageGeneratorAgent::STYLE_CINEMATIC)
//        ->setTraceId('ImageGeneratorAgentCinematicTest')
//        ->runAndWait(60);
//
//    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
//
//    expect($result->isSuccessful())->toBeTrue();
//    if ($result->isSuccessful()) {
//        expect($result->getImageUrl())->toBeString();
//        expect($result->hasImage())->toBeTrue();
//    }
//});

it('can run an agent to generate image with input images', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateImage()
        ->withInstruction('Transform this scene into a surreal artistic interpretation')
        ->withStyle(ImageGeneratorAgent::STYLE_SURREAL)
        ->addInputImage('https://images.unsplash.com/photo-1755378988619-216a5a111e0f?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'A random landscape photo for transformation')
        ->setTraceId('ImageGeneratorAgentWithInputTest')
        ->runAndWait(5);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getImageUrl())->toBeString();
        expect($result->hasImage())->toBeTrue();
    }
});
