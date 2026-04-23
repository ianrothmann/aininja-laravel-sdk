<?php

use IanRothmann\AINinja\AINinja;
use Illuminate\Support\Collection;

it('can run assessment profile update agent', function () {
    $result = (new AINinja)->agent()
        ->updateAssessmentProfile()
        ->profileSnapshot([
            'profile' => [
                'language_id'              => 'en',
                'name'                     => 'Alex',
                'surname'                  => 'Morgan',
                'gender'                   => 'female',
                'birth_year'               => 1990,
                'subtitle'                 => "Manager in Meridian Advisory's RGC division with nearly a decade at the firm.",
                'background'               => 'Alex describes herself as a manager in the RGC division at Meridian Advisory, with nearly a decade at the firm. She mentions enjoying coaching and learning and development aspects of her work. Her aim is to help individuals grow within the team.',
                'highest_qualification'    => 'BCom (Accounting Sciences)',
                'country'                  => 'South Africa',
                'city'                     => 'Johannesburg',
                'work_start_year'          => 2012,
            ],
            'assessments' => [
                [
                    'id'           => '01aaabbbccc111',
                    'name'         => 'Meridian+ Managerial: Development (2.0)',
                    'language'     => 'English',
                    'completed_at' => '2024-02-29T00:00:00+00:00',
                    'sources'      => [
                        ['source_id' => 'fitt', 'external_id' => '22153'],
                    ],
                ],
            ],
            'contexts' => [
                'background.experience' => [
                    'label'   => 'Experience',
                    'catalog' => 'Background',
                    'entries' => [
                        [
                            'job_title'    => 'Debt collection agent',
                            'organization' => 'Van Rensburg Law Partners',
                            'start_year'   => 2014,
                            'end_year'     => 2014,
                            'is_current'   => false,
                        ],
                        [
                            'job_title'    => 'Junior bookkeeper',
                            'organization' => 'De Wet Accounting Services',
                            'start_year'   => 2012,
                            'end_year'     => 2014,
                            'is_current'   => false,
                        ],
                    ],
                ],
                'background.qualifications' => [
                    'label'   => 'Qualifications',
                    'catalog' => 'Background',
                    'entries' => [
                        [
                            'qualification_name' => 'Bachelor of Commerce in Accounting Sciences',
                            'qualification_type' => 'academic',
                            'field_of_study'     => 'Accounting, auditing, taxation and financial management',
                            'institution'        => 'University of Johannesburg',
                            'year_completed'     => 2013,
                        ],
                    ],
                ],
                'preferences.personality' => [
                    'label'   => 'Personality',
                    'catalog' => 'Preferences',
                    'entries' => [
                        [
                            'instrument_key'                 => 'ptg_personality',
                            'instrument_interpretation'      => 'Appears organized, empathetic, and open to new ideas, with a sociable disposition and emphasis on strong workplace relationships.',
                            'instrument_interpretation_short' => 'Appears organized, empathetic, and open to new ideas.',
                            'key_themes'                     => [
                                'structured and conscientious work style',
                                'empathy and positive interpersonal orientation',
                                'social engagement and openness',
                                'creative and innovative thinking',
                            ],
                        ],
                    ],
                ],
                'preferences.experience_drivers' => [
                    'label'   => 'Experience Drivers',
                    'catalog' => 'Preferences',
                    'entries' => [
                        [
                            'instrument_key'                 => 'ptg_experience_drivers',
                            'instrument_interpretation'      => 'Values organisational belonging, collaborative teamwork, and sustainable work-life integration.',
                            'instrument_interpretation_short' => 'Values organisational belonging, collaborative teamwork, and sustainable work-life integration.',
                            'key_themes'                     => [
                                'Organisational belonging',
                                'Collaborative work environment',
                                'Work-life integration and wellness',
                            ],
                        ],
                    ],
                ],
                'preferences.career_path' => [
                    'label'   => 'Career Path Preferences',
                    'catalog' => 'Preferences',
                    'entries' => [
                        [
                            'instrument_key'                 => 'ptg_career_path_preferences',
                            'instrument_interpretation'      => 'No career path preference data is available for this candidate, so no interpretation can be provided.',
                            'instrument_interpretation_short' => 'No career path preference data available.',
                            'key_themes'                     => ['insufficient data', 'no career preference pattern identified'],
                        ],
                    ],
                ],
                'preferences.team_role' => [
                    'label'   => 'Team Role',
                    'catalog' => 'Preferences',
                    'entries' => [
                        [
                            'instrument_key'                 => 'ptg_team_role',
                            'instrument_interpretation'      => 'Tends to bring creative ideas, energy for change, and a positive outlook to teams, but may lose interest in routine or overlook practical constraints.',
                            'instrument_interpretation_short' => 'Creative, change-oriented team contributor who may overlook practical constraints.',
                            'key_themes'                     => [
                                'creative idea generation',
                                'energy for change and experimentation',
                                'positive outlook and encouragement',
                                'lower preference for structure and routine',
                            ],
                        ],
                    ],
                ],
                'growth_insights.strengths' => [
                    'label'   => 'Strengths',
                    'catalog' => 'Growth Insights',
                    'entries' => [
                        [
                            'title'   => 'Keeps teams focused and aligned under pressure',
                            'summary' => 'You tend to keep your team focused on clear goals, even when deadlines are tight. You are likely to plan ahead, share information openly, and make sure everyone knows what to do, helping the group stay on track when things get busy.',
                        ],
                        [
                            'title'   => 'Champions new ideas and leads positive change',
                            'summary' => 'You consistently bring fresh ideas and are likely to encourage your team to try new ways of working. You tend to be comfortable with change and enjoy finding better ways to do things, helping others adapt and improve.',
                        ],
                        [
                            'title'   => 'Supports growth by coaching and developing others',
                            'summary' => 'You are likely to enjoy helping others learn and grow, offering guidance and support to team members. You tend to focus on building people\'s skills and confidence, encouraging them to progress in their roles.',
                        ],
                    ],
                ],
                'growth_insights.development_areas' => [
                    'label'   => 'Development Areas',
                    'catalog' => 'Growth Insights',
                    'entries' => [
                        [
                            'title'   => 'Losing momentum on follow-through and structure',
                            'summary' => 'You tend to get excited by new ideas and change, but may not always put enough focus on planning, organizing resources, or sticking with routines. This can lead to projects starting strong but losing consistency or quality over time.',
                        ],
                        [
                            'title'   => 'Holding back from assertive conversations',
                            'summary' => 'You are likely to support and coach others, but may avoid being direct or assertive when managing performance or influencing outcomes.',
                        ],
                        [
                            'title'   => 'Discomfort with ambiguity and complex problems',
                            'summary' => 'You tend to prefer clear goals and plans, and may feel less comfortable when things are uncertain or problems are messy.',
                        ],
                    ],
                ],
                'growth_insights.aspirations' => [
                    'label'   => 'Aspirations',
                    'catalog' => 'Growth Insights',
                    'entries' => [
                        [
                            'title'   => 'Move into a people-leadership role focused on team development',
                            'summary' => 'You are moving toward a future where you lead people and help them grow. You want to become a leader who coaches and develops team members, making a positive impact on their learning and progress.',
                        ],
                    ],
                ],
            ],
            'development_goals' => [
                [
                    'name'        => 'Build a disciplined system for team growth and improvement',
                    'description' => 'This goal is about creating reliable ways to help your team learn, grow, and keep getting better over time.',
                ],
                [
                    'name'        => 'Give clear, honest feedback that helps people improve',
                    'description' => 'This goal is about being more direct when expectations aren\'t being met, while still being supportive and fair.',
                ],
                [
                    'name'        => 'Guide teams through ambiguity and complex challenges',
                    'description' => 'This goal is about becoming more comfortable and effective when things are unclear or problems are tough.',
                ],
            ],
            'development_actions' => [
                [
                    'goal_name' => 'Build a disciplined system for team growth and improvement',
                    'actions'   => [
                        [
                            'id'          => '01aaabbbccc222',
                            'title'       => 'Stand Up a 12-Week Development Operating Rhythm',
                            'description' => 'Run a 12-week team development rhythm with your full team, where each team member has one clear development priority for the quarter.',
                            'rationale'   => 'Converts great coaching intent into reliable habits.',
                            'category'    => 'experience',
                            'status'      => 'in_progress',
                        ],
                    ],
                ],
            ],
            'learning_resources' => [
                [
                    'title'    => 'How to Embrace Ambiguity When Making Decisions',
                    'type'     => 'listen',
                    'topic'    => 'Sensemaking and decision-making under ambiguity for new managers',
                    'provider' => 'Harvard Business Review',
                ],
            ],
        ])
        ->incomingAssessment([
            'bio' => [
                'name'       => 'Alex',
                'surname'    => 'Morgan',
                'gender'     => 'female',
                'age'        => 36,
                'birth_year' => 1990,
                'country'    => 'South Africa',
            ],
            'identifiers' => [
                'person_id'      => 6726,
                'org_unique_id'  => 'person2@test.com',
            ],
            'experience'     => "Manager at Meridian Advisory from 2015 to current.\nDebt collection agent at Van Rensburg Law Partners from 2014 to 2014\nJunior bookkeeper at De Wet Accounting Services from 2012 to 2014",
            'qualifications' => 'Bachelor of Commerce in Accounting Sciences: Accounting, auditing, taxation and financial management at University of Johannesburg in 2013',
            'language'       => ['language_id' => 'en', 'language_name' => 'English (UK)'],
            'assessments'    => [
                [
                    'assessment_date' => '2024-04-04',
                    'identifiers'     => ['assessment_id' => 23019, 'organization_external_id' => 13],
                    'language'        => 'English (UK)',
                    'language_code'   => 'en',
                    'assessment_context' => [
                        'project'         => 'Meridian Internal Senior Managers 2024',
                        'client'          => 'Meridian Advisory',
                        'assessment_name' => 'Meridian Premium Managerial: Development (2.1)',
                        'level'           => 'Managerial',
                    ],
                    'self_described' => [
                        'introduction'      => 'Hello. My name is Alex, and I currently manage the RGC division at Meridian Advisory, a position I\'ve held for four years. My tenure spans nearly seven years, beginning after I transitioned from the audit division. I thoroughly enjoy my role as it has provided me with numerous opportunities to mentor and train team members at different stages of their careers.',
                        'strengths'         => 'Alex believes she is an effective leader who excels in managing both her teams and herself. She has experience leading smaller teams, focusing on delegating tasks while also empowering her team members to grow. Alex opposes micromanagement, preferring instead to give her team the responsibility and opportunity to achieve their personal goals and KPIs. She values her time management skills and her ability to handle multiple tasks simultaneously.',
                        'development_areas' => 'Alex wants to emphasize the importance of well-being in her professional interactions. She intends to improve processes and manage expectations more effectively within the teams she collaborates with. She also recognizes the importance of building strong relationships with new team members who may have preconceived notions.',
                        'aspirations'       => 'Alex has been working at Meridian Advisory for nearly 10 years, and for about seven of those years, she has been involved with the RGC division. She expresses a desire to continue her work with the RGC division and explore new areas the firm has not yet ventured into, including training and setting up guidelines for new projects.',
                        'cbi'               => [null, null],
                    ],
                    'instruments' => [
                        'ptg_personality' => [
                            'result' => [
                                'openness'          => 'high',
                                'conscientiousness' => 'high',
                                'extraversion'      => 'high',
                                'agreeableness'     => 'high',
                                'imaginative'       => 'high',
                                'achieving'         => 'medium',
                                'engaging'          => 'high',
                                'diligent'          => 'high',
                                'empathic'          => 'high',
                                'gregarious'        => 'medium',
                                'trusting'          => 'high',
                                'benevolent'        => 'medium',
                                'assertive'         => 'medium',
                                'analytical'        => 'medium',
                                'organised'         => 'medium',
                                'variety_seeking'   => 'medium',
                            ],
                        ],
                        'ptg_experience_drivers' => [
                            'result' => [
                                'driver1' => 'community',
                                'driver2' => 'collaboration',
                                'driver3' => 'wellness',
                            ],
                        ],
                        'ptg_career_path_preferences' => [
                            'result'         => 'leadership1',
                            'interpretation' => [
                                'label'                              => 'Moderate leadership preference',
                                'candidate_score_level_interpretation' => 'Is somewhat more likely to prefer career opportunities that involve leadership, coordination, and responsibility for collective outcomes.',
                            ],
                        ],
                        'ptg_team_role' => [
                            'label'    => 'Innovator',
                            'ref_code' => 'innovator',
                        ],
                    ],
                    'competency_scores' => [
                        '5617' => ['name' => 'Collaboration and Teamwork',        'refcode' => 'collaboration_and_teamwork',        'score' => '3.51042', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '5618' => ['name' => 'Communicating with Impact',          'refcode' => 'communicating_with_impact',          'score' => '4.08299', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '5619' => ['name' => 'Building Relationships',             'refcode' => 'building_relationships',             'score' => '3.09498', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '5620' => ['name' => 'Planning and Organizing',            'refcode' => 'planning_and_organizing',            'score' => '3.57265', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '5621' => ['name' => 'Analysing Information',              'refcode' => 'analysing_information',              'score' => '3.22656', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '5622' => ['name' => 'Managing Resources',                 'refcode' => 'managing_resources',                 'score' => '2.52137', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '5623' => ['name' => 'Continuous Learning',                'refcode' => 'continuous_learning',                'score' => '2.89983', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '5625' => ['name' => 'Delivering Results',                 'refcode' => 'delivering_results',                 'score' => '2.77609', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '5626' => ['name' => 'Decision Making',                    'refcode' => 'decision_making',                    'score' => '3.33978', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '5627' => ['name' => 'Working under Pressure',             'refcode' => 'working_under_pressure',             'score' => '3.65950', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '5628' => ['name' => 'Focus on Quality and Standards',     'refcode' => 'focus_on_quality_and_standards',     'score' => '2.95854', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '5629' => ['name' => 'Managing Performance',               'refcode' => 'managing_performance',               'score' => '2.94444', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '5630' => ['name' => 'Delivering Processes',               'refcode' => 'delivering_processes',               'score' => '3.78790', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '5633' => ['name' => 'Driving Innovation',                 'refcode' => 'driving_innovation',                 'score' => '4.07205', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '5634' => ['name' => 'Customer Focus',                     'refcode' => 'customer_focus',                     'score' => '4.04714', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '5639' => ['name' => 'Developing People',                  'refcode' => 'developing_people',                  'score' => '3.40370', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '5642' => ['name' => 'Leading Change',                     'refcode' => 'leading_change',                     'score' => '4.05914', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '5643' => ['name' => 'Strategic Forecasting',              'refcode' => 'strategic_forecasting',              'score' => '2.68205', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '5644' => ['name' => 'Managing Ambiguity',                 'refcode' => 'managing_ambiguity',                 'score' => '2.67375', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '5646' => ['name' => 'Solutioning Complexity',             'refcode' => 'solutioning_complexity',             'score' => '2.72795', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                    ],
                    'assessor_comments'                => [],
                    'assessor_designed_development_plan' => [
                        'idp' => [
                            ['devactionid' => 71015, 'title' => 'Facilitate a conflict between team members',  'description' => 'Allowing Alex to refine her facilitation skills',                       'rationale' => 'Resolving a dispute or bringing parties closer together to find common ground.',                    'category' => 'experience', 'duration' => 'short_term',          'state' => 'proposed'],
                            ['devactionid' => 71016, 'title' => 'Compile a stakeholder map',                    'description' => 'Define the needs of different role players',                            'rationale' => 'Ensure alignment of goals, objectives and outcomes',                                              'category' => 'experience', 'duration' => 'medium_term',         'state' => 'proposed'],
                            ['devactionid' => 71017, 'title' => 'Conduct a 3R Application',                    'description' => 'Imagine and reflect on a complex situation using the 3R model',         'rationale' => 'Reframing challenges and expanding nonlinear thinking',                                           'category' => 'experience', 'duration' => 'short_term',          'state' => 'proposed'],
                            ['devactionid' => 71018, 'title' => 'Iterate a new concept',                       'description' => 'Test and assess a new idea',                                           'rationale' => 'Iterating with the view of improving processes',                                                  'category' => 'experience', 'duration' => 'long_term',           'state' => 'proposed'],
                            ['devactionid' => 71019, 'title' => 'Work on a business intelligence (BI) platform', 'description' => 'Analysing data with a digital tool',                                'rationale' => 'Uncovering insights through advanced business tools such as Tableau or Power BI',               'category' => 'experience', 'duration' => 'as_opportunities_arise', 'state' => 'proposed'],
                            ['devactionid' => 71022, 'title' => 'Lead a performance review',                   'description' => 'Reviewing outcomes against set standards',                             'rationale' => 'Ensuring quality outcomes and meeting of deliverables',                                           'category' => 'experience', 'duration' => 'medium_term',         'state' => 'proposed'],
                            ['devactionid' => 71023, 'title' => 'Attend Workshop: Customer Experience',        'description' => 'Action learning for Customer Experience',                              'rationale' => 'Practical application of the latest principles of a compelling customer experience (CX)',         'category' => 'exposure',   'duration' => 'medium_term',         'state' => 'proposed'],
                            ['devactionid' => 71024, 'title' => 'Join / start a Community of Practice',        'description' => 'Joining a professional and / or industry body',                       'rationale' => 'Staying abreast with key trends in your field and / or functional area',                         'category' => 'exposure',   'duration' => 'long_term',           'state' => 'proposed'],
                            ['devactionid' => 71025, 'title' => 'Course in Operations and Process Excellence', 'description' => 'Course focused on Continuous Improvement and Efficiency Tools',       'rationale' => 'Integrate processes, enhance work efficiency and outputs.',                                        'category' => 'education',  'duration' => 'long_term',           'state' => 'proposed'],
                        ],
                    ],
                ],
                [
                    'assessment_date' => '2024-02-29',
                    'identifiers'     => ['assessment_id' => 22153, 'organization_external_id' => 13],
                    'language'        => 'English (UK)',
                    'language_code'   => 'en',
                    'assessment_context' => [
                        'project'         => 'Meridian Recruitment: Internal Managers 2.0',
                        'client'          => 'Meridian Advisory',
                        'assessment_name' => 'Meridian+ Managerial: Development (2.0)',
                        'level'           => 'Managerial',
                    ],
                    'self_described' => [
                        'introduction'      => 'Hello. I am Alex, a manager in the RGC division. I\'ve been in this role for almost five years and have been with Meridian Advisory for nearly a decade. I particularly enjoy the coaching and learning and development aspects of my job.',
                        'strengths'         => null,
                        'development_areas' => null,
                        'aspirations'       => null,
                    ],
                    'instruments' => [
                        'ptg_personality' => [
                            'result' => [
                                'openness'          => 'high',
                                'conscientiousness' => 'high',
                                'extraversion'      => 'high',
                                'agreeableness'     => 'high',
                                'imaginative'       => 'high',
                                'achieving'         => 'medium',
                                'engaging'          => 'high',
                                'diligent'          => 'high',
                                'empathic'          => 'high',
                                'gregarious'        => 'medium',
                                'trusting'          => 'high',
                                'benevolent'        => 'medium',
                                'assertive'         => 'medium',
                                'analytical'        => 'medium',
                                'organised'         => 'medium',
                                'variety_seeking'   => 'medium',
                            ],
                        ],
                        'ptg_experience_drivers' => [
                            'result' => ['driver1' => 'community', 'driver2' => 'collaboration', 'driver3' => 'wellness'],
                        ],
                        'ptg_career_path_preferences' => null,
                        'ptg_team_role' => ['label' => 'Innovator', 'ref_code' => 'innovator'],
                    ],
                    'competency_scores' => [
                        '4112' => ['name' => 'Collaboration and Teamwork',    'refcode' => 'collaboration_and_teamwork',    'score' => '3.52047', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '4113' => ['name' => 'Communicating with Impact',     'refcode' => 'communicating_with_impact',     'score' => '3.77778', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '4128' => ['name' => 'Driving Innovation',            'refcode' => 'driving_innovation',            'score' => '4.37321', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '4137' => ['name' => 'Leading Change',                'refcode' => 'leading_change',                'score' => '4.14197', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                        '4139' => ['name' => 'Managing Ambiguity',            'refcode' => 'managing_ambiguity',            'score' => '2.85428', 'minValue' => '1.00000', 'maxValue' => '5.00000'],
                    ],
                    'assessor_comments'                => [],
                    'assessor_designed_development_plan' => ['idp' => [], 'learning' => []],
                ],
            ],
        ])
        ->runAndWait(10);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getStatus())->toBeIn(['ok', 'no_new_assessment', 'error']);
        expect($result->getAssessmentResolution())->toBeInstanceOf(Collection::class);
        expect($result->getSummary())->toBeInstanceOf(Collection::class);
        expect($result->getProfileFactualUpdates())->toBeInstanceOf(Collection::class);
        expect($result->getQualificationUpdates())->toBeInstanceOf(Collection::class);
        expect($result->getExperienceUpdates())->toBeInstanceOf(Collection::class);
        expect($result->getReplaceablePreferenceContextUpdates())->toBeInstanceOf(Collection::class);
        expect($result->getStrengthUpdates())->toBeInstanceOf(Collection::class);
        expect($result->getDevelopmentAreaUpdates())->toBeInstanceOf(Collection::class);
        expect($result->getAspirationUpdates())->toBeInstanceOf(Collection::class);
        expect($result->getDevelopmentActionProposalCandidates())->toBeInstanceOf(Collection::class);
        expect($result->getLearningContextCandidates())->toBeInstanceOf(Collection::class);
        expect($result->getWarnings())->toBeInstanceOf(Collection::class);
    }
});
