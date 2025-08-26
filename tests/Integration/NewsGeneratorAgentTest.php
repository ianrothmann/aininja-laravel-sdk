<?php

use IanRothmann\AINinja\AINinja;
use Illuminate\Support\Carbon;

it('can run an agent to generate news from context', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateNews()
        ->withContext('Latest developments in artificial intelligence and machine learning technology')
        ->setTraceId('NewsGeneratorAgentTest')
        ->runAndWait(5);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->isSuccessful())->toBeTrue();
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
        ->withRecencyFilter(Carbon::parse('2024-12-01'))
        ->setTraceId('NewsGeneratorAgentRecencyTest')
        ->runAndWait(5);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getTopics())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getTopicsCount())->toBeGreaterThan(0);
    }
});
