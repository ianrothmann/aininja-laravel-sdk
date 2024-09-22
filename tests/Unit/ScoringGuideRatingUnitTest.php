<?php

use IanRothmann\AINinja\AINinja;

it('can rate from a scoring guide designed by AI Ninja', function () {
    $handler = new AINinja;

    // Act: Start by adding an answer
    $result = $handler->scoringGuideRating()
        ->onAnswer("The candidate mentions QuickBooks for finances and Shopify for online sales.")

        // Add the first rating item
        ->rateItemId(1)

        // Add the first anchor for item 1
        ->withAnchor(1, "Novice Advisor", "The candidate did not mention specific products or services.")
        ->withPrerequisite("Does the candidate mention specific products?", "No products were mentioned.")

        // Add the second anchor for item 1
        ->withAnchor(2, "Basic Advisor", "Mentions one product, like QuickBooks.")
        ->withPrerequisite("Does the candidate mention at least one product?", "Mentions QuickBooks for finances.")

        // Add a second item with its anchors and prerequisites
        ->rateItemId(2)

        // Add the first anchor for item 2
        ->withAnchor(1, "No Solutions Provided", "The candidate did not provide any solutions.")
        ->withPrerequisite("Does the candidate provide any solutions?", "No solutions were provided.")

        // Add the second anchor for item 2
        ->withAnchor(2, "General Suggestions", "The candidate provides general suggestions.")
        ->withPrerequisite("Does the candidate provide general suggestions?", "The candidate suggests a basic website.")

        // Fetch the result
        ->get();


    expect($result->getResultsById()->toArray())->not()->toBeEmpty();
});
