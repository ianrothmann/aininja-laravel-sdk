<?php

use IanRothmann\AINinja\AINinja;

it('can run an agent to generate news from context', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateNews()
        ->withContext('Latest developments in artificial intelligence and machine learning technology')
        ->setTraceId('NewsGeneratorAgentTest')
        ->runAndWait(30);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);

    if ($result->isSuccessful()) {
        expect($result->getTopics())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getTopicsCount())->toBeGreaterThan(0);
        expect($result->getTopicTitles())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getTopicSummaries())->toBeInstanceOf(\Illuminate\Support\Collection::class);

        if ($result->getFirstTopic()) {
            expect($result->getFirstTopic())->toBeArray();
            expect($result->getFirstTopic())->toHaveKeys(['title', 'summary']);
        }
    }
});

it('can run an agent to generate news with recency filter', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateNews()
        ->withContext('Global economic trends and market analysis')
        ->withRecencyFilter('12/1/2024')
        ->setTraceId('NewsGeneratorAgentRecencyTest')
        ->runAndWait(3);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);

    if ($result->isSuccessful()) {
        expect($result->getTopics())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getTopicsCount())->toBeGreaterThan(0);
    }
});
