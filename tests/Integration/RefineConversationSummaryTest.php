<?php

use IanRothmann\AINinja\AINinja;

it('can refine a conversation summary', function () {
    $handler = new AINinja();

    $result = $handler->refineConversationSummary()
        ->basedOn(
            [
                ['speaker' => 'Bot', 'text' => 'What toppings?'],
                ['speaker' => 'Ian', 'text' => 'Pepperoni'],
                ['speaker' => 'Bot', 'text' => 'Anything else?'],
                ['speaker' => 'Ian', 'text' => 'No'],
                ['speaker' => 'Bot', 'text' => 'Your order will be ready in 30 minutes.']
            ]
        )
//        ->withPreviousSummary()
        ->get();

    expect($result->getResult())->toBeString();
});
