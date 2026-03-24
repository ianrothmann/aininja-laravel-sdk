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
                'videos' => [
                    [
                        'title' => 'Your Social Energy',
                        'script' => 'You bring energy into every room you enter...',
                        'storyboard' => [
                            'audio' => 'https://example.com/audio/jane_extraversion.mp3',
                            'cover_content' => [
                                'heading' => 'Your Social Energy',
                                'subheading' => 'Understanding your extraverted personality.',
                                'image_url' => null,
                            ],
                            'scenes' => [],
                        ],
                    ],
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
