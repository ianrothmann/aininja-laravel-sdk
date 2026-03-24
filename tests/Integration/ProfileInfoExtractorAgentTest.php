<?php

use IanRothmann\AINinja\AINinja;

it('can run profile info extractor agent', function () {
    $result = (new AINinja)->agent()
        ->extractProfileInfo()
        ->candidateContext([
            'bio' => ['name' => 'Alex', 'surname' => 'Morgan', 'gender' => 'female', 'age' => 34, 'country' => 'New Zealand'],
            'experience' => "Senior Software Engineer at Acme Technologies from 2019 to present\nSoftware Developer at Vertex Solutions from 2014 to 2019",
            'qualifications' => 'BSc Computer Science, Westfield University, 2015.',
            'assessments' => [
                [
                    'assessment_date' => '2025-03-01',
                    'language' => 'English (UK)',
                    'assessment_context' => [
                        'project' => 'Talent Review 2025',
                        'client' => 'Acme Technologies',
                        'assessment_name' => 'Senior Individual Contributor Assessment',
                        'level' => 'Senior',
                    ],
                    'self_described' => [
                        'introduction' => 'Alex is a senior software engineer with 10 years of experience. She leads a team of 5 developers at Acme Technologies and is known for technical depth and strong mentoring ability.',
                        'strengths' => 'Technical problem solving, mentoring junior engineers, cross-functional collaboration.',
                        'development_areas' => 'Business acumen, stakeholder communication, strategic thinking.',
                        'aspirations' => 'Alex aspires to move into a CTO or VP Engineering role within 3-5 years.',
                        'cbi' => [
                            [
                                'transcript' => 'We migrated a legacy monolith to microservices with zero downtime. I led the architecture planning, coordinated with product, and ran weekly reviews.',
                                'context' => 'The candidate was asked: Describe a complex technical project you led.',
                            ],
                        ],
                    ],
                    'instruments' => [
                        'ptg_personality' => [
                            'result' => [
                                'openness' => 'high',
                                'conscientiousness' => 'high',
                                'extraversion' => 'medium',
                                'agreeableness' => 'high',
                                'imaginative' => 'high',
                                'achieving' => 'high',
                                'engaging' => 'medium',
                                'diligent' => 'high',
                                'empathic' => 'high',
                                'gregarious' => 'medium',
                                'trusting' => 'high',
                                'benevolent' => 'high',
                                'assertive' => 'medium',
                                'analytical' => 'high',
                                'organised' => 'high',
                                'variety_seeking' => 'high',
                            ],
                            'interpretation' => [
                                'openness' => [
                                    'type' => 'construct',
                                    'construct' => null,
                                    'title' => 'Openness',
                                    'dimension_definition' => 'Reflects a preference for creative ideas, variety, and complex analysis.',
                                    'candidate_score_level_interpretation' => 'Enjoys exploring new ideas, complex problems, and creative approaches.',
                                ],
                            ],
                        ],
                    ],
                    'competency_scores' => [
                        '2001' => ['name' => 'Technical Excellence', 'refcode' => 'technical_excellence', 'description' => 'Applies deep technical knowledge', 'minValue' => '1.00', 'maxValue' => '5.00', 'score' => '4.70'],
                        '2002' => ['name' => 'Developing People', 'refcode' => 'developing_people', 'description' => 'Coaches and mentors team members', 'minValue' => '1.00', 'maxValue' => '5.00', 'score' => '4.10'],
                        '2003' => ['name' => 'Strategic Thinking', 'refcode' => 'strategic_thinking', 'description' => 'Thinks beyond immediate tasks', 'minValue' => '1.00', 'maxValue' => '5.00', 'score' => '3.50'],
                    ],
                    'assessor_comments' => [
                        [
                            'Alex demonstrated strong technical depth and clear systems thinking throughout the assessment. Her communication with non-technical stakeholders is developing well. She owns outcomes and advocates effectively for her team. Her stated ambition for a CTO role is credible given her trajectory.',
                        ],
                    ],
                    'assessor_designed_development_plan' => [
                        'idp' => [
                            [
                                'devactionid' => 3001,
                                'title' => 'Business Strategy Essentials',
                                'description' => 'Complete a short course in business strategy and commercial planning',
                                'rationale' => 'Alex will benefit from structured exposure to commercial decision-making to complement her technical leadership strengths.',
                                'category' => 'education',
                                'duration' => 'short_term',
                                'state' => 'proposed',
                            ],
                        ],
                    ],
                ],
            ],
        ])
        ->runAndWait(10);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getPersonProfileExtract())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getExtractionMeta())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getIdentity())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});
