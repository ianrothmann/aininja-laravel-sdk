<?php

use IanRothmann\AINinja\AINinja;

it('can process and extract infomation from a resume', function () {
    $handler = new AINinja;

    $result = $handler->analyzeResume()
        ->forUrl('https://writing.colostate.edu/guides/documents/resume/functionalsample.pdf')
        ->rateOnJobDescription('Early childhood development teacher')
        ->get();

    expect($result->getError())->toBeNull()
        ->and($result->getName())->toBeString()
        ->and($result->getEmail())->toBeString()
        ->and($result->getExperienceRating())->toBeInt()
        ->and($result->getEducationRating())->toBeInt()
        ->and($result->getSkillsRating())->toBeInt()
        ->and($result->getExperienceRatingReason())->toBeString()
        ->and($result->getEducationRatingReason())->toBeString()
        ->and($result->getSkillsRatingReason())->toBeString()
        ->and($result->getRating())->toBeFloat()
        ->and($result->getRatingReason())->toBeString()
        ->and($result->getGender())->toBeString()
        ->and($result->getAge())->toBeInt()
        ->and($result->getNationalityCode())->toBeString();
});
