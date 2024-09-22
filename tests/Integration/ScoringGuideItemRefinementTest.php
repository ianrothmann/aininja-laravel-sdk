<?php

use IanRothmann\AINinja\AINinja;

it('can refine items from in a scoring guide', function () {
    $handler = new AINinja;

    $result = $handler->scoringGuideRefineRatingItems()
        ->forDimension("Digital Acumen")
        ->candidateWasGivenQuestion("THE QUESTION: Advise Tom on how he can streamline his processes, improve customer engagement, and manage data more efficiently using modern technology. Provide examples of specific strategies or technologies he could adopt. Record a video response online (via webcam) of between 1 and 3 minutes.")
        ->addItem(1, "Identifies relevant digital tools to automate manual processes and reduce operational inefficiencies.")
        ->addItem(2, "Proposes methods to improve customer engagement using digital platforms such as CRM systems or online stores.")
        ->addItem(3, "Demonstrates understanding of cloud-based solutions for managing financial and employee data securely and efficiently.")
        ->addItem(4, "Highlights the role of AI or other advanced technologies to enhance decision-making and operational efficiency.")
        ->addItem(5, "Shows excitement for technology.")
        ->addExample("Suggests Tom use Google Drive for storing customer and employee data but fails to explain how this will help his business grow.")
        ->addExample("Proposes using a CRM system to automate customer interactions, offering personalized recommendations and improving engagement.")
        ->addExample("Mentions using cloud-based accounting software to improve financial management and AI-based tools to automate home measurement tasks.")
        ->get();

    expect($result->getUpdates()->toArray())->not()->toBeEmpty();
});
