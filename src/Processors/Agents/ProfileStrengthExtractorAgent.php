<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentProfileStrengthExtractorResult;

class ProfileStrengthExtractorAgent extends AINinjaAgent
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_profile_strength_extractor';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentProfileStrengthExtractorResult::class;
    }

    public function getMocked(): array
    {
        return [
            'output' => [
                'profile_id' => null,
                'assessment_date_used' => '2024-01-15',
                'strength_extraction_version' => 'v1',
                'strengths' => [
                    [
                        'id' => 's_1',
                        'title' => 'Stakeholder Engagement',
                        'summary' => 'Naturally builds strong relationships and trust with diverse stakeholders at all levels.',
                        'confidence' => 0.9,
                        'evidence_score' => 0.88,
                        'primary_evidence_type' => ['assessor_comments', 'competency_scores'],
                        'supporting_evidence' => [
                            'competencies' => [['refcode' => 'REL01', 'name' => 'Relationship Building', 'score' => 4.2]],
                            'assessor_snippets' => ['Consistently praised for ability to bring people together'],
                            'self_snippets' => ['Described as a natural connector'],
                            'context_snippets' => [],
                        ],
                        'distinct_from' => [],
                    ],
                    [
                        'id' => 's_2',
                        'title' => 'Analytical Problem Solving',
                        'summary' => 'Applies structured thinking to break down complex problems into actionable components.',
                        'confidence' => 0.82,
                        'evidence_score' => 0.78,
                        'primary_evidence_type' => ['competency_scores'],
                        'supporting_evidence' => [
                            'competencies' => [['refcode' => 'ANA01', 'name' => 'Analytical Thinking', 'score' => 4.0]],
                            'assessor_snippets' => [],
                            'self_snippets' => [],
                            'context_snippets' => [],
                        ],
                        'distinct_from' => ['Stakeholder Engagement'],
                    ],
                ],
                'rejected_candidate_themes' => [
                    ['theme' => 'Public Speaking', 'reason' => 'too_narrow'],
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

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentProfileStrengthExtractorResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentProfileStrengthExtractorResult
    {
        return parent::retrieveRunResult($run);
    }
}
