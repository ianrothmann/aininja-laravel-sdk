<?php

use IanRothmann\AINinja\AINinja;

it('can generate criteria for an item in a scoring guide', function () {
    $handler = new AINinja;

    $result = $handler->scoringGuideGenerateCriteria()
        ->addItem(10, 'Proposes forward-thinking tech solutions')
        ->addItem(11, 'Focuses on recommending digital tools for specific tasks')
        ->withRatingsBetween(1, 5)
//        ->addAspectToAvoid('Focuses on recommending digital tools for specific tasks')
//        ->addAspectToAvoid('Discusses tools to support the digital shift across business areas')
//        ->addAspectToAvoid('Demonstrates a high level of enthusiasm for technology')
//        ->addAspectToAvoid('Indicates openness to learning new digital tools')
        ->candidateWasGivenQuestion('THE QUESTION: Advise Tom on how he can streamline his processes, improve customer engagement, and manage data more efficiently using modern technology. Provide examples of specific strategies or technologies he could adopt. Record a video response online (via webcam) of between 1 and 3 minutes.')
        ->addExampleOfGoodResponse('Suggests Tom use Google Drive for storing customer and employee data but fails to explain how this will help his business grow.')
        ->addExampleOfModerateResponse('Proposes using a CRM system to automate customer interactions, offering personalized recommendations and improving engagement.')
        ->addExampleOfPoorResponse('Mentions using cloud-based accounting software to improve financial management and AI-based tools to automate home measurement tasks.')
        ->get();

    expect($result->getItems()->toArray())->not()->toBeEmpty();

});
