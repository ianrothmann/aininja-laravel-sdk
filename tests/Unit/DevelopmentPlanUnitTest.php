<?php

use IanRothmann\AINinja\AINinja;

it('can create development plans', function () {
    $handler = new AINinja;

    $result = $handler->createDevelopmentPlan()
        ->addDevelopmentCategory('experience', 'Experience',1)
        ->addDevelopmentCategory('exposure', 'Exposure',1)
        ->addDevelopmentCategory('education', 'Education',1)
        ->addToPersonContext('profile', 'I am a senior manager in a large corporate.')
        ->addToAssessmentContext('profile', 'Executive presence is a key competency for my role and a development area. Digital leadership too.')
        ->addDevelopmentAction('experience',1, 'Improve stakeholder engagement during change.', 'Enhancing stakeholder engagement will strengthen leadership during transitions.', 'MediumTerm')
        ->addDevelopmentAction('exposure',2, 'Empower your team with digital tools.', 'Empowering the team with digital tools enhances efficiency and understanding.', 'MediumTerm')
        ->addDevelopmentAction('education',3, 'Enhance knowledge of specific technologies.', 'Expanding knowledge strengthens advisory capabilities in digital transformation.', 'LongTerm')
        ->addDevelopmentAction('experience',4, 'Assess and improve your leadership style.', 'Assessing and improving your leadership style will enhance your effectiveness.', 'ShortTerm')
        ->addDevelopmentAction('exposure',5, 'Develop a digital transformation strategy.', 'Developing a digital transformation strategy will enhance your strategic capabilities.', 'ShortTerm')
        ->addDevelopmentAction('education',6,'Complete a course in digital transformation.','Completing a course in digital transformation will enhance your knowledge.','ShortTerm')
        ->get();

    expect($result->getDevelopmentActions()->toArray())->toBeArray()->toHaveLength(3);
});
