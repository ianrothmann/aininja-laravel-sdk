<?php

use IanRothmann\AINinja\AINinja;
use Illuminate\Support\Carbon;

it('can run an agent to generate news with context only', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateNews()
        ->withContext('Technology trends and artificial intelligence developments')
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getTopics())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getTopicsCount())->toBeGreaterThan(0);
        expect($result->getTopicTitles())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getTopicSummaries())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});

it('can run an agent to generate news with context and recency filter', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateNews()
        ->withContext('Financial markets and economic indicators')
        ->withRecencyFilter(Carbon::parse('2025-01-01'))
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getTopics())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getTopicsCount())->toBeGreaterThan(0);

        if ($result->getFirstTopic()) {
            expect($result->getFirstTopic())->toBeArray();
            expect($result->getFirstTopic())->toHaveKeys(['title', 'summary']);
        }
    }
});

it('can handle empty recency filter', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateNews()
        ->withContext('Climate change and environmental policies')
        ->withRecencyFilter(Carbon::parse('2024-01-01'))
        ->runAndWait(5);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getResult())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getTopics())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});
