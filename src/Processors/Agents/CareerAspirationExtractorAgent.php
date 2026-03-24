<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentCareerAspirationExtractorResult;

class CareerAspirationExtractorAgent extends AINinjaAgent
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_career_aspiration_extractor';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentCareerAspirationExtractorResult::class;
    }

    public function getMocked(): array
    {
        return [
            'output' => [
                'profile_id' => null,
                'assessment_date_used' => '2024-01-15',
                'career_aspiration_extraction_version' => 'v1',
                'aspirations' => [
                    [
                        'title' => 'Senior Leadership Role',
                        'summary' => 'Aspires to move into a senior leadership position within the next 3-5 years, leveraging strong people management and strategic thinking skills.',
                        'confidence' => 0.85,
                        'source_type' => 'declared',
                        'status' => 'active',
                        'direction_class' => 'leadership_scope',
                        'primary_evidence_type' => 'self_described',
                        'supporting_evidence' => ['Candidate explicitly mentioned desire to lead teams', 'History of volunteering for leadership roles'],
                        'distinct_from' => [],
                        'horizon' => 'medium_term',
                    ],
                    [
                        'title' => 'Domain Expertise in Data Science',
                        'summary' => 'Strong drive to deepen technical expertise in data science and machine learning.',
                        'confidence' => 0.72,
                        'source_type' => 'inferred',
                        'status' => 'active',
                        'direction_class' => 'domain_specialisation',
                        'primary_evidence_type' => 'assessor_comments',
                        'supporting_evidence' => ['Assessor noted enthusiasm for data-driven projects'],
                        'distinct_from' => ['Senior Leadership Role'],
                        'horizon' => 'near_term',
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

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentCareerAspirationExtractorResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentCareerAspirationExtractorResult
    {
        return parent::retrieveRunResult($run);
    }
}
