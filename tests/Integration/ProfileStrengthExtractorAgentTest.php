<?php

use IanRothmann\AINinja\AINinja;
use Illuminate\Support\Collection;

it('can run profile strength extractor agent', function () {
    $result = (new AINinja)->agent()
        ->extractProfileStrengths()
        ->candidateContext([
            'bio' => ['name' => 'Jordan', 'surname' => 'Mercer', 'gender' => 'male', 'age' => 52, 'country' => 'New Zealand'],
            'experience' => "Director at Crestline Advisory from 2000 to present\nSenior Financial Manager at Bridgemont Holdings from 1998 to 2000\nAudit Trainee at Crestline Advisory from 1994 to 1998",
            'qualifications' => "Honours: Accounting at Northgate University in 1993\nChartered Accountant at ICANZ in 1996",
            'assessments' => [
                [
                    'assessment_date' => '2025-06-01',
                    'language' => 'English (UK)',
                    'assessment_context' => [
                        'project' => 'Leadership Development Centre 2025',
                        'client' => 'Crestline Advisory',
                        'assessment_name' => 'Executive Assessment (v2)',
                        'level' => 'Director',
                    ],
                    'self_described' => [
                        'introduction' => 'Jordan has spent 25 years in management consulting, helping organisations improve their operations through ERP implementations, restructuring, and risk frameworks. He has a particular passion for supporting CFOs through transformation, combining his accounting background with a client-first philosophy.',
                        'strengths' => 'Jordan identified his primary strength as his ability to build deep, trusted relationships with clients. He is known for delivering innovative, high-quality work and motivating teams to meet demanding deadlines. He consistently receives feedback that clients feel genuinely supported and valued.',
                        'development_areas' => 'Jordan wants to sharpen his client development skills and deepen his understanding of how AI is transforming business functions. He also acknowledges that impatience can occasionally affect team dynamics.',
                        'aspirations' => 'Jordan aspires to build a team recognised by CFOs as the go-to advisory group for navigating change. His goal is to be known in the market for a proven track record of helping clients adapt to regulatory and technological shifts.',
                        'cbi' => [
                            [
                                'transcript' => 'In a recent ERP go-live, we faced a hard year-end deadline with no flexibility. I broke the challenge down into clear daily milestones, assigned ownership across the team, and set up daily stand-ups. We communicated transparently with the client throughout. We hit the deadline and the client said it was the smoothest go-live they had experienced.',
                                'context' => 'The candidate was asked: Describe a situation where you worked under significant pressure.',
                            ],
                        ],
                    ],
                    'instruments' => [
                        'ptg_personality' => [
                            'result' => [
                                'openness' => 'low',
                                'conscientiousness' => 'high',
                                'extraversion' => 'medium',
                                'agreeableness' => 'medium',
                                'imaginative' => 'medium',
                                'achieving' => 'high',
                                'engaging' => 'medium',
                                'diligent' => 'high',
                                'empathic' => 'medium',
                                'gregarious' => 'medium',
                                'trusting' => 'medium',
                                'benevolent' => 'medium',
                                'assertive' => 'medium',
                                'analytical' => 'low',
                                'organised' => 'high',
                                'variety_seeking' => 'medium',
                            ],
                            'interpretation' => [
                                'conscientiousness' => [
                                    'type' => 'construct',
                                    'construct' => null,
                                    'title' => 'Conscientiousness',
                                    'dimension_definition' => 'Reflects how structured, rule-following, dependable, and goal-directed a person tends to be.',
                                    'candidate_score_level_interpretation' => 'Tends to work in an organized, disciplined, and goal-focused way with strong follow-through.',
                                ],
                                'achieving' => [
                                    'type' => 'facet',
                                    'construct' => 'conscientiousness',
                                    'title' => 'Achieving',
                                    'dimension_definition' => 'Reflects the extent to which a person is driven by goals and high standards.',
                                    'candidate_score_level_interpretation' => 'Sets high standards and is strongly motivated to deliver results.',
                                ],
                            ],
                        ],
                    ],
                    'competency_scores' => [
                        '1001' => ['name' => 'Building Relationships', 'refcode' => 'building_relationships', 'description' => 'Builds sustainable, positive relationships with stakeholders', 'minValue' => '1.00', 'maxValue' => '5.00', 'score' => '4.50'],
                        '1002' => ['name' => 'Delivering Results', 'refcode' => 'delivering_results', 'description' => 'Sets and reaches stretch objectives consistently', 'minValue' => '1.00', 'maxValue' => '5.00', 'score' => '4.60'],
                        '1003' => ['name' => 'Communicating with Impact', 'refcode' => 'communicating_with_impact', 'description' => 'Communicates with clarity and impact', 'minValue' => '1.00', 'maxValue' => '5.00', 'score' => '4.30'],
                        '1004' => ['name' => 'Planning and Organising', 'refcode' => 'planning_and_organising', 'description' => 'Organises resources effectively to meet goals', 'minValue' => '1.00', 'maxValue' => '5.00', 'score' => '4.40'],
                        '1005' => ['name' => 'Strategic Forecasting', 'refcode' => 'strategic_forecasting', 'description' => 'Plans for the long term considering the macro environment', 'minValue' => '1.00', 'maxValue' => '5.00', 'score' => '3.20'],
                    ],
                    'assessor_comments' => [
                        [
                            "Jordan approached every simulation with methodical precision and genuine engagement with other participants. His ability to build rapport quickly was immediately apparent — within minutes of any group exercise he had established clear communication channels and was actively integrating others' input. Assessors consistently noted his exceptional follow-through: when Jordan committed to an action or timeline, he delivered without exception. His client storytelling during the presentation exercise was particularly compelling, drawing on concrete outcomes rather than activity. The panel noted that Jordan's combination of organised execution, relationship orientation, and achievement drive sets him apart as a highly dependable senior leader. His major development opportunity lies in elevating his strategic boldness — moving from executing within a defined mandate to proactively shaping the direction of the mandate itself.",
                        ],
                    ],
                    'assessor_designed_development_plan' => [
                        'idp' => [
                            [
                                'devactionid' => 2001,
                                'title' => 'Executive Strategy Immersion Programme',
                                'description' => 'Participate in a senior strategy forum with cross-industry leaders',
                                'rationale' => 'Jordan will benefit from exposure to enterprise-level strategic decision-making beyond his current functional domain.',
                                'category' => 'education',
                                'duration' => 'medium_term',
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
        expect($result->getStrengths())->toBeInstanceOf(Collection::class);
        expect($result->getRejectedThemes())->toBeInstanceOf(Collection::class);
        expect($result->getStrengthCount())->toBeGreaterThan(0);
    }
});
