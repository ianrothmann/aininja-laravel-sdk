<?php

use IanRothmann\AINinja\AINinja;

it('can run development areas extractor agent', function () {
    $result = (new AINinja)->agent()
        ->extractDevelopmentAreas()
        ->candidateContext([
            'bio' => ['name' => 'Sam', 'surname' => 'Taylor', 'gender' => 'male', 'age' => 38, 'country' => 'New Zealand'],
            'experience' => "Operations Manager at Riverstone Group from 2019 to present\nTeam Leader at Riverstone Group from 2015 to 2019\nOperations Coordinator at Bridgemont Holdings from 2012 to 2015",
            'qualifications' => 'BCom Management, Westfield University, 2011.',
            'assessments' => [
                [
                    'assessment_date' => '2025-04-01',
                    'language' => 'English (UK)',
                    'assessment_context' => [
                        'project' => 'High Potential Programme 2025',
                        'client' => 'Riverstone Group',
                        'assessment_name' => 'Mid-Senior Assessment',
                        'level' => 'Manager',
                    ],
                    'self_described' => [
                        'introduction' => 'Sam is an operations manager with 12 years of experience across logistics and supply chain environments. He has a strong operational track record but has recently taken on a broader people leadership mandate.',
                        'strengths' => 'Sam identified his strengths as operational efficiency, attention to detail, and loyalty to his team. He is known for executing plans reliably and maintaining high process standards.',
                        'development_areas' => 'Sam acknowledged that he finds it difficult to have direct performance conversations with underperforming team members. He also recognises that he tends to focus on operational detail at the expense of longer-term strategic thinking. His manager has flagged that he needs to develop greater executive presence when interacting with senior stakeholders.',
                        'aspirations' => 'Sam would like to progress to a General Manager role within the next 4 years but recognises he needs to strengthen his leadership confidence and strategic capability to be considered ready.',
                        'cbi' => [
                            [
                                'transcript' => 'I had a team member who was consistently missing targets. I kept hoping the situation would improve on its own. Eventually I raised it, but by then the team morale had already been affected. Looking back, I should have addressed it earlier and more directly.',
                                'context' => 'The candidate was asked: Tell us about a time you had to manage a difficult people situation.',
                            ],
                        ],
                    ],
                    'instruments' => [
                        'ptg_personality' => [
                            'result' => [
                                'openness' => 'low',
                                'conscientiousness' => 'high',
                                'extraversion' => 'low',
                                'agreeableness' => 'high',
                                'imaginative' => 'low',
                                'achieving' => 'medium',
                                'engaging' => 'low',
                                'diligent' => 'high',
                                'empathic' => 'high',
                                'gregarious' => 'low',
                                'trusting' => 'high',
                                'benevolent' => 'high',
                                'assertive' => 'low',
                                'analytical' => 'low',
                                'organised' => 'high',
                                'variety_seeking' => 'low',
                            ],
                            'interpretation' => [
                                'assertive' => [
                                    'type' => 'facet',
                                    'construct' => 'extraversion',
                                    'title' => 'Assertive',
                                    'dimension_definition' => 'Reflects comfort with taking charge, speaking up, and influencing others.',
                                    'candidate_score_level_interpretation' => 'May be less comfortable asserting views or challenging others in the workplace.',
                                ],
                            ],
                        ],
                    ],
                    'competency_scores' => [
                        '4001' => ['name' => 'Managing Performance', 'refcode' => 'managing_performance', 'description' => 'Sets performance standards and manages team to meet objectives', 'minValue' => '1.00', 'maxValue' => '5.00', 'score' => '2.80'],
                        '4002' => ['name' => 'Strategic Forecasting', 'refcode' => 'strategic_forecasting', 'description' => 'Plans for the long term considering the macro environment', 'minValue' => '1.00', 'maxValue' => '5.00', 'score' => '2.50'],
                        '4003' => ['name' => 'Managing Conflict', 'refcode' => 'managing_conflict', 'description' => 'Leads difficult conversations and resolves conflict productively', 'minValue' => '1.00', 'maxValue' => '5.00', 'score' => '2.60'],
                        '4004' => ['name' => 'Planning and Organising', 'refcode' => 'planning_and_organising', 'description' => 'Organises resources effectively to meet goals', 'minValue' => '1.00', 'maxValue' => '5.00', 'score' => '4.30'],
                        '4005' => ['name' => 'Delivering Results', 'refcode' => 'delivering_results', 'description' => 'Sets and reaches stretch objectives consistently', 'minValue' => '1.00', 'maxValue' => '5.00', 'score' => '3.90'],
                    ],
                    'assessor_comments' => [
                        [
                            "Sam is a conscientious and dependable manager with strong operational instincts. However, assessors noted a consistent pattern of avoidance when confronted with interpersonal tension or performance challenges. He tends to delay difficult conversations and defaults to hoping problems resolve themselves, which has negatively impacted team performance on at least two observed occasions. His strategic thinking remains underdeveloped — he engages confidently with operational detail but struggles to adopt a longer-term perspective when discussing organizational direction. Assessors also noted that Sam's communication in senior forums lacks the confidence and gravitas expected at a more senior level. He would benefit significantly from targeted development in assertive leadership, difficult conversation skills, and strategic orientation.",
                        ],
                    ],
                    'assessor_designed_development_plan' => [
                        'idp' => [
                            [
                                'devactionid' => 4001,
                                'title' => 'Courageous Conversations Workshop',
                                'description' => 'Attend a facilitated workshop on delivering direct and constructive feedback',
                                'rationale' => 'Sam will benefit from structured practice in direct performance conversations to overcome his avoidance pattern.',
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
        expect($result->getDevelopmentAreas())->toBeInstanceOf(\Illuminate\Support\Collection::class);
        expect($result->getRejectedThemes())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    }
});
