<?php

use IanRothmann\AINinja\AINinja;

it('can run an agent to generate news with context only', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateNews()
        ->withContext('Technology trends and artificial intelligence developments')
        ->runAndWait(3);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getTopics())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getTopicsCount())->toBeGreaterThan(0);
    expect($result->getTopicTitles())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getTopicSummaries())->toBeInstanceOf(\Illuminate\Support\Collection::class);
});

it('can run an agent to generate news with context and recency filter', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateNews()
        ->withContext('Financial markets and economic indicators')
        ->withRecencyFilter('1/1/2025')
        ->runAndWait(3);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getTopics())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getTopicsCount())->toBeGreaterThan(0);

    if ($result->getFirstTopic()) {
        expect($result->getFirstTopic())->toBeArray();
        expect($result->getFirstTopic())->toHaveKeys(['title', 'summary']);
    }
});

it('can handle empty recency filter', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateNews()
        ->withContext('Climate change and environmental policies')
        ->withRecencyFilter(null)
        ->runAndWait(3);

    expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getTopics())->toBeInstanceOf(\Illuminate\Support\Collection::class);
});
