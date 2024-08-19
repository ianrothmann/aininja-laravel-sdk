<?php

use IanRothmann\AINinja\AINinja;

it('can refine a conversation summary', function () {
    $handler = new AINinja;

    $result = $handler->refineConversationSummary()
        ->forSpeaker('Bot', 'What toppings?')
        ->forSpeaker('Ian', 'Pepperoni')
        ->forSpeaker('Bot', 'Anything else?')
        ->forSpeaker('Ian', 'No')
        ->forSpeaker('Bot', 'Your order will be ready in 30 minutes.')
//        ->withPreviousSummary()
        ->get();

    expect($result->getResult())->toBeString();
});
