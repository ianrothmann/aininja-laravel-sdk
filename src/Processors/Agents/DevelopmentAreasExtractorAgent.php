<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentDevelopmentAreasExtractorResult;

class DevelopmentAreasExtractorAgent extends AINinjaAgent
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_development_areas_extractor';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentDevelopmentAreasExtractorResult::class;
    }

    public function getMocked(): array
    {
        return [
            'output' => [
                'profile_id' => null,
                'assessment_date_used' => '2024-01-15',
                'development_area_extraction_version' => 'v1.1',
                'development_areas' => [
                    [
                        'id' => 'da_1',
                        'title' => 'Strategic Thinking',
                        'summary' => 'Needs to develop broader strategic perspective beyond immediate team scope.',
                        'confidence' => 0.8,
                        'evidence_score' => 0.75,
                        'primary_evidence_type' => ['competency_scores', 'assessor_comments'],
                        'supporting_evidence' => [
                            'competencies' => [['refcode' => 'STR01', 'name' => 'Strategic Orientation', 'score' => 2.5]],
                            'assessor_snippets' => ['Assessor noted tendency to focus on tactical rather than strategic issues'],
                            'self_snippets' => [],
                            'idp_snippets' => [],
                            'context_snippets' => [],
                        ],
                        'distinct_from' => [],
                    ],
                    [
                        'id' => 'da_2',
                        'title' => 'Executive Presence',
                        'summary' => 'Developing confidence and gravitas in senior stakeholder interactions.',
                        'confidence' => 0.65,
                        'evidence_score' => 0.60,
                        'primary_evidence_type' => ['assessor_comments'],
                        'supporting_evidence' => [
                            'competencies' => [],
                            'assessor_snippets' => ['Candidate can appear hesitant in senior forums'],
                            'self_snippets' => ['Self-acknowledged development area'],
                            'idp_snippets' => [],
                            'context_snippets' => [],
                        ],
                        'distinct_from' => ['Strategic Thinking'],
                    ],
                ],
                'rejected_candidate_themes' => [
                    ['theme' => 'Time Management', 'reason' => 'insufficient_evidence'],
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

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentDevelopmentAreasExtractorResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentDevelopmentAreasExtractorResult
    {
        return parent::retrieveRunResult($run);
    }
}
