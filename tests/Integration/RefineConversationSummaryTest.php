<?php

use IanRothmann\AINinja\AINinja;

it('can refine a conversation summary', function () {
    $handler = new AINinja;

    $previous = 'The person is Ian and he lives in Dubai';

    $result = $handler->refineConversationSummary()
        ->forSpeaker('Bot', 'What toppings?')
        ->forSpeaker('Ian', 'Pepperoni')
        ->forSpeaker('Bot', 'Anything else?')
        ->forSpeaker('Ian', 'No')
        ->forSpeaker('Bot', 'Your order will be ready in 30 minutes.')
        ->get();

    expect($result->getResult())->toBeString();

    $result = $handler->refineConversationSummary()
        ->forSpeaker('Bot', 'What toppings?')
        ->forSpeaker('Ian', 'Pepperoni')
        ->forSpeaker('Bot', 'Anything else?')
        ->forSpeaker('Ian', 'No')
        ->forSpeaker('Bot', 'Your order will be ready in 30 minutes.')
        ->withPreviousSummary($previous)
        ->get();

    expect($result->getResult())->toBeString();
});
