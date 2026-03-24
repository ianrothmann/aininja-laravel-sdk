<?php

use IanRothmann\AINinja\AINinja;
use Illuminate\Support\Collection;

it('can run career aspiration extractor agent', function () {
    $result = (new AINinja)->agent()
        ->extractCareerAspirations()
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
                        'introduction' => 'Alex is a senior software engineer with 10 years of experience building scalable systems. She currently leads a team of 5 developers and has a strong track record of shipping high-quality product features on time.',
                        'strengths' => 'Alex highlighted her ability to translate complex technical requirements into clear engineering plans. She is known for mentoring junior developers and fostering a collaborative team environment.',
                        'development_areas' => 'Alex wants to develop stronger business acumen and stakeholder communication skills to complement her technical expertise.',
                        'aspirations' => 'Alex has expressed a clear desire to move into a CTO or VP of Engineering role within the next 3-5 years. She wants to shape product and technology strategy at an organizational level and build high-performing engineering teams.',
                        'cbi' => [
                            [
                                'transcript' => 'Our team was tasked with migrating a legacy monolith to microservices while keeping the product live. I created a phased migration roadmap, negotiated a temporary feature freeze with the product team, and ran weekly architecture reviews. We completed the migration with zero downtime and reduced deployment time by 80%.',
                                'context' => 'The candidate was asked: Describe a technically complex project you led and how you managed it.',
                            ],
                        ],
                    ],
                    'instruments' => [
                        'ptg_career_path_preferences' => [
                            'result' => 'leadership2',
                            'interpretation' => [
                                'label' => 'Strong leadership preference',
                                'candidate_score_level_interpretation' => 'Is likely to be more energised by career opportunities that involve leading, coordinating, and developing others.',
                            ],
                        ],
                    ],
                    'competency_scores' => [
                        '2001' => ['name' => 'Technical Excellence', 'refcode' => 'technical_excellence', 'description' => 'Applies deep technical knowledge to solve complex problems', 'minValue' => '1.00', 'maxValue' => '5.00', 'score' => '4.70'],
                        '2002' => ['name' => 'Developing People', 'refcode' => 'developing_people', 'description' => 'Coaches and mentors team members', 'minValue' => '1.00', 'maxValue' => '5.00', 'score' => '4.10'],
                        '2003' => ['name' => 'Strategic Thinking', 'refcode' => 'strategic_thinking', 'description' => 'Thinks beyond immediate tasks to longer-term direction', 'minValue' => '1.00', 'maxValue' => '5.00', 'score' => '3.50'],
                    ],
                    'assessor_comments' => [
                        [
                            'Alex demonstrated outstanding technical depth and a clear capacity for systems thinking. Her communication with non-technical stakeholders is improving but remains an area for development. Assessors noted that she consistently advocates for her team and takes ownership of outcomes. Her stated ambition to move into a CTO role is credible given her trajectory, though she will need to accelerate her commercial and strategic capability to be fully prepared for such a role.',
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
        expect($result->getAspirations())->toBeInstanceOf(Collection::class);
        expect($result->getVersion())->toBeString();
    }
});
