<?php

use IanRothmann\AINinja\AINinja;

it('can create observations from multiple transcripts', function () {
    $handler = new AINinja;

    $result = $handler->observationsFromTranscripts()
        ->addTranscript("Hello! My name is Reinhardt. I am a Data Scientist specialising in the Fitt Research and Innovation department")
        ->addTranscript("I am 25 years old and I am from South Africa")
        ->withContext("Name: Reinhardt
                        Age: 25
                        Gender: Male
                        Country: South Africa")
        ->get();

    expect($result->getObservations()->toArray())->not()->toHaveLength(0);
});
