<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentJobRoleCompetencyExtractorResult;

class JobRoleCompetencyExtractorAgent extends AINinjaAgent
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_job_role_competency_extractor';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentJobRoleCompetencyExtractorResult::class;
    }

    public function getMocked(): array
    {
        return [
            'output' => [
                'positions' => [
                    [
                        'positionid' => 1,
                        'job_description' => '# Senior Manager, Training & Development...',
                        'competencies' => [
                            'bb996299-0a4e-4107-8b22-83fc93cadea1',
                            'f4a8c3d2-9b1e-4a77-8f3c-2d9e6b4a1c8f',
                        ],
                    ],
                    [
                        'positionid' => 2,
                        'job_description' => '# Assistant Controller...',
                        'competencies' => [
                            'a1b2c3d4-5e6f-7g8h-9i0j-1k2l3m4n5o6p',
                        ],
                    ],
                ],
                'new_competencies' => [
                    [
                        'competency_id' => 'a1b2c3d4-5e6f-7g8h-9i0j-1k2l3m4n5o6p',
                        'position_id' => '2',
                        'role_name' => 'Assistant Controller',
                        'name' => 'Financial Reporting & GAAP/IFRS Compliance',
                        'description' => 'Oversees the preparation and presentation of periodic financial reports ensuring compliance with Generally Accepted Accounting Principles (GAAP) and International Financial Reporting Standards (IFRS). Involves understanding complex accounting standards and their application.',
                        'success_criteria' => [
                            'Ensures all financial reports comply with GAAP and IFRS standards',
                            'Reviews and approves journal entries and balance sheet reconciliations',
                            'Coordinates with external auditors to provide required information',
                        ],
                        'evidence_spans' => [
                            [
                                'quote' => 'Oversee periodic financial reports, ensuring that the reported results comply with Generally Accepted Accounting Principles (GAAP) and International Financial Reporting Standards (IFRS)',
                                'location_hint' => 'Duties & Responsibilities',
                            ],
                        ],
                        'support_score' => 0.92,
                        'overlaps_with' => [],
                    ],
                ],
                'master_competency_list' => [
                    [
                        'competency_id' => 'bb996299-0a4e-4107-8b22-83fc93cadea1',
                        'name' => 'Learning Management System (LMS) Implementation for Offshore Operations',
                        'description' => 'Designs, implements, and operates a learning management system tailored to offshore and rig contexts.',
                        'success_criteria' => [
                            'Implements an LMS and configures role-based curricula',
                            'Maintains accurate training records',
                        ],
                        'evidence_spans' => [
                            [
                                'quote' => 'Experienced in establishing training and development programs and learning management system',
                                'location_hint' => 'Qualifications',
                            ],
                        ],
                        'support_score' => 0.86,
                        'overlaps_with' => [],
                        'position_id' => '1',
                        'role_name' => 'Senior Manager, Training & Development',
                    ],
                    [
                        'competency_id' => 'f4a8c3d2-9b1e-4a77-8f3c-2d9e6b4a1c8f',
                        'name' => 'Competency Management Framework Development & Governance',
                        'description' => 'Establishes and governs a company-wide competence framework for rig and office roles.',
                        'success_criteria' => [
                            'Defines competency standards and matrices',
                            'Benchmarks competence processes',
                        ],
                        'evidence_spans' => [
                            [
                                'quote' => 'manage strategic change in the company\'s approach to competence development',
                                'location_hint' => 'Duties',
                            ],
                        ],
                        'support_score' => 0.91,
                        'overlaps_with' => [],
                        'position_id' => '1',
                        'role_name' => 'Senior Manager, Training & Development',
                    ],
                    [
                        'competency_id' => 'a1b2c3d4-5e6f-7g8h-9i0j-1k2l3m4n5o6p',
                        'position_id' => '2',
                        'role_name' => 'Assistant Controller',
                        'name' => 'Financial Reporting & GAAP/IFRS Compliance',
                        'description' => 'Oversees the preparation and presentation of periodic financial reports ensuring compliance with Generally Accepted Accounting Principles (GAAP) and International Financial Reporting Standards (IFRS).',
                        'success_criteria' => [
                            'Ensures all financial reports comply with GAAP and IFRS standards',
                            'Reviews and approves journal entries and balance sheet reconciliations',
                            'Coordinates with external auditors to provide required information',
                        ],
                        'evidence_spans' => [
                            [
                                'quote' => 'Oversee periodic financial reports, ensuring that the reported results comply with Generally Accepted Accounting Principles (GAAP) and International Financial Reporting Standards (IFRS)',
                                'location_hint' => 'Duties & Responsibilities',
                            ],
                        ],
                        'support_score' => 0.92,
                        'overlaps_with' => [],
                    ],
                ],
            ],
        ];
    }

    public function jobDescriptions(array $jobDescriptions): self
    {
        $this->input['job_descriptions'] = $jobDescriptions;

        return $this;
    }

    public function existingCompetencies(?array $existingCompetencies): self
    {
        $this->input['existing_competencies'] = $existingCompetencies;

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'job_descriptions' => 'required|array|min:1',
            'job_descriptions.*.positionid' => 'required',
            'job_descriptions.*.role' => 'required|string',
            'job_descriptions.*.description' => 'required|string',
            'existing_competencies' => 'nullable|array',
            'existing_competencies.*.competency_id' => 'required|string',
            'existing_competencies.*.name' => 'required|string|min:3|max:100',
            'existing_competencies.*.description' => 'required|string|min:20|max:600',
            'existing_competencies.*.success_criteria' => 'required|array|min:2|max:4',
            'existing_competencies.*.evidence_spans' => 'required|array|min:1|max:5',
            'existing_competencies.*.support_score' => 'required|numeric|min:0|max:1',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentJobRoleCompetencyExtractorResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentJobRoleCompetencyExtractorResult
    {
        return parent::retrieveRunResult($run);
    }
}
