<?php

use IanRothmann\AINinja\AINinja;

it('can extract themes', function () {
    $handler = new AINinja;

    $input = [
        "I have digressed too long on this story of modular forms and Lie algebras, which I mentioned only because it is an example of a missed opportunity that happened to me personally. I now return to my main theme, the discussion of missed opportunities that were important in the historical development of mathematics.",
        "But the mathematicians of the nineteenth century failed miserably to grasp the equally great opportunity offered to them in 1865 by Maxwell. If they had taken Maxwell's equations to heart as Euler took Newton's, they would have discovered, among other things, Einstein's theory of special relativity",
        "The course of the present year a treatise on electricity has been published by Professor Maxwell, giving a complete account of the mathe- matical theory of that science, No mathematician can turn over the pages of these volumes without very speedily convincing himself that they contain the first outlines (and something more than the first outlines) of a theory which has already added largely to the methods and resources of pure mathematics, and which may one day render to that abstract science services no less than those which it owes to astronomy. For elec- tricity now, like astronomy of old, has placed before the mathematician an entirely new set of questions, requiring the creation of entirely new methods for their solution, It must be considered fortunate for the mathematicians that such a vast field of research in the application of mathematics to physical enquiries should be thrown open to them, at the very time when the scientific interest in the old mathematical astron- omy has for the moment flagged",
        "Hermann Minkowski had something to say thirty-five years later about the opportunity which the mathematicians had missed.",
    ];

    $result = $handler->extractThemes()
        ->fromDocuments($input)
        ->extractNumberOfClustersBetween(2,20)
        ->get();

    expect($result->getThemes())->not()->toBeEmpty();
    expect($result->getSummary())->toBeString();
});
