<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentFittGrowInitialisationResult;

class FittGrowInitialisationAgent extends AINinjaAgent
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_fitt_grow_initialisation';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentFittGrowInitialisationResult::class;
    }

    public function getMocked(): array
    {
        return [
            'output' => [
                'profile_info' => [
                    'person_profile_extract' => [
                        'identity' => [
                            'first_name' => ['value' => 'Alex', 'status' => 'exact', 'confidence' => 1.0],
                            'surname' => ['value' => 'Morgan', 'status' => 'exact', 'confidence' => 1.0],
                            'full_name' => ['value' => 'Alex Morgan', 'status' => 'synthesized', 'confidence' => 0.98],
                        ],
                    ],
                    'extraction_meta' => [
                        'assessment_date_used' => null,
                        'latest_assessment_used' => true,
                        'records_checked' => ['bio', 'experience'],
                        'warnings' => [],
                    ],
                    'instrument_interpretations' => [],
                ],
                'profile_strengths' => [
                    'profile_id' => null,
                    'assessment_date_used' => null,
                    'strength_extraction_version' => 'v1',
                    'strengths' => [
                        [
                            'id' => 's_1',
                            'title' => 'Stakeholder Engagement',
                            'summary' => 'Builds strong relationships and trust with diverse stakeholders.',
                            'confidence' => 0.9,
                        ],
                    ],
                    'rejected_candidate_themes' => [],
                ],
                'career_aspirations' => [
                    'profile_id' => null,
                    'assessment_date_used' => null,
                    'career_aspiration_extraction_version' => 'v1',
                    'aspirations' => [
                        [
                            'title' => 'Senior Leadership Role',
                            'summary' => 'Aspires to move into senior leadership within 3-5 years.',
                            'confidence' => 0.85,
                            'source_type' => 'declared',
                            'status' => 'active',
                            'direction_class' => 'leadership_scope',
                            'primary_evidence_type' => 'self_described',
                            'supporting_evidence' => [],
                            'distinct_from' => [],
                            'horizon' => 'medium_term',
                        ],
                    ],
                ],
                'development_areas' => [
                    'profile_id' => null,
                    'assessment_date_used' => null,
                    'development_area_extraction_version' => 'v1.1',
                    'development_areas' => [
                        [
                            'id' => 'da_1',
                            'title' => 'Strategic Thinking',
                            'summary' => 'Needs to develop broader strategic perspective.',
                            'confidence' => 0.8,
                        ],
                    ],
                    'rejected_candidate_themes' => [],
                ],
                'scripts' => [
                    ['id' => 'personality', 'sub_id' => 'extraversion', 'title' => 'Your Social Energy', 'script' => 'You bring energy into every room you enter...'],
                    ['id' => 'personality', 'sub_id' => 'openness', 'title' => 'Your Curiosity', 'script' => 'You embrace new ideas and perspectives...'],
                    ['id' => 'personality', 'sub_id' => 'agreeableness', 'title' => 'Your Collaborative Nature', 'script' => 'You lead with warmth and care for others...'],
                    ['id' => 'personality', 'sub_id' => 'conscientiousness', 'title' => 'Your Drive for Excellence', 'script' => 'You approach work with discipline and high standards...'],
                    ['id' => 'experience_drivers', 'sub_id' => null, 'title' => 'What You Need from Your Work', 'script' => 'You thrive when you have the freedom to grow...'],
                ],
            ],
        ];
    }

    public function candidateContext(array $context): self
    {
        $this->input = $context;

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'bio' => 'array|nullable',
            'experience' => 'string|nullable',
            'qualifications' => 'string|nullable',
            'assessments' => 'array|nullable',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentFittGrowInitialisationResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentFittGrowInitialisationResult
    {
        return parent::retrieveRunResult($run);
    }
}
