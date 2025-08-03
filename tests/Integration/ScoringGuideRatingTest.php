<?php

use IanRothmann\AINinja\AINinja;

it('can rate from a scoring guide designed by AI Ninja', function () {
    $handler = new AINinja;

    // Act: Start by adding an answer
    $result = $handler->scoringGuideRating()
        ->givenQuestion('Advise a small business on accounting software')
        ->onAnswer('The candidate mentions QuickBooks for finances and Shopify for online sales.')

        // Add the first rating item
        ->rateItem(1, 'Advises specitiv services')

        // Add the first anchor for item 1
        ->withAnchor(1, 'Novice Advisor', 'The candidate did not mention specific products or services.', 'Does the candidate mention specific products?', 'No products were mentioned.')

        // Add the second anchor for item 1
        ->withAnchor(2, 'Basic Advisor', 'Mentions one product, like QuickBooks.', 'Does the candidate mention at least one product?', 'Mentions QuickBooks for finances.')

        // Add a second item with its anchors and prerequisites
        ->rateItem(2, 'Provides solutions')

        // Add the first anchor for item 2
        ->withAnchor(1, 'No Solutions Provided', 'The candidate did not provide any solutions.', 'Does the candidate provide any solutions?', 'No solutions were provided.')

        // Add the second anchor for item 2
        ->withAnchor(2, 'General Suggestions', 'The candidate provides general suggestions.', 'Does the candidate provide general suggestions?', 'The candidate suggests a basic website.')

        // Fetch the result
        ->get();

    expect($result->getResultsById()->toArray())->not()->toBeEmpty();

});
