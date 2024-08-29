<?php

use IanRothmann\AINinja\AINinja;

it('can create an assessment matrix', function () {
    $handler = new AINinja;

    $result = $handler->createAssessmentMatrix()
        // Adding Methods
        ->addMethod('assessment_centre', 'Assessment Centre')
        ->addMethod('personality', 'Personality')

        // Adding Measures for Assessment Centre
        ->addMeasure('assessment_centre', 'interview', 'Interview', 'Interview measure')
        ->addMeasure('assessment_centre', 'role_play', 'Role Play', 'Role play measure')

        // Adding Measures for Personality
        ->addMeasure('personality', 'personality_test', 'Personality Test', 'Personality test measure')
        ->addMeasure('personality', 'psychometric_test', 'Psychometric Test', 'Psychometric test measure')

        // Mapping Dimensions to Measures for Assessment Centre
        ->addMappingDimension('interview', 'skills', 'Skills', 'Skills dimension')
        ->addMappingDimension('role_play', 'decision_making', 'Decision Making', 'Decision making dimension')

        // Mapping Dimensions to Measures for Personality
        ->addMappingDimension('personality_test', 'emotional_intelligence', 'Emotional Intelligence', 'Emotional intelligence dimension')
        ->addMappingDimension('psychometric_test', 'abstract_reasoning', 'Abstract Reasoning', 'Abstract reasoning dimension')

        // Adding Competency: Collaboration and Teamwork
        ->addCompetency('collaboration_and_teamwork', 'Collaboration and Teamwork', 'Works collaboratively with team members', 'Core Competencies')
        ->setCompetencyMethodTargets('collaboration_and_teamwork', 'assessment_centre', 0.4, 2)
        ->setCompetencyMethodTargets('collaboration_and_teamwork', 'personality', 0.3, 1)
        ->addCompetencyExample('collaboration_and_teamwork', 'Collaborative Working', 'PTG Ipsative Personality', 'personality', 0.2)
        ->addCompetencyExample('collaboration_and_teamwork', 'Team Player', 'Role Play', 'assessment_centre', '0.3 to 0.4')

        // Adding Competency: Communicating with Impact
        ->addCompetency('communicating_with_impact', 'Communicating with Impact', 'Communicates with clarity and impact', 'Core Competencies')
        ->setCompetencyMethodTargets('communicating_with_impact', 'assessment_centre', 0.5, 2)
        ->setCompetencyMethodTargets('communicating_with_impact', 'personality', 0.2, 1)
        ->addCompetencyExample('communicating_with_impact', 'Managing Critical Conversations', 'Critical Conversation (Executive)', 'online_completed_and_rated', '0.3 to 0.4')
        ->addCompetencyExample('communicating_with_impact', 'Effective Networking', 'Personality Test', 'personality', 0.2)
        ->get();

    expect($result->getMappings())->not()->toBeEmpty();
});
