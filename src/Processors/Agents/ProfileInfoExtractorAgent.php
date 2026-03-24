<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentProfileInfoExtractorResult;

class ProfileInfoExtractorAgent extends AINinjaAgent
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_profile_info_extractor';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentProfileInfoExtractorResult::class;
    }

    public function getMocked(): array
    {
        return [
            'output' => [
                'person_profile_extract' => [
                    'identity' => [
                        'first_name' => ['value' => 'Alex', 'status' => 'exact', 'confidence' => 1.0, 'source' => 'bio', 'evidence' => null],
                        'surname' => ['value' => 'Morgan', 'status' => 'exact', 'confidence' => 1.0, 'source' => 'bio', 'evidence' => null],
                        'full_name' => ['value' => 'Alex Morgan', 'status' => 'synthesized', 'confidence' => 0.98, 'source' => 'bio', 'evidence' => null],
                    ],
                    'demographics' => [
                        'country' => ['value' => 'South Africa', 'status' => 'exact', 'confidence' => 1.0, 'source' => 'bio', 'evidence' => null],
                        'city' => ['value' => null, 'status' => 'unknown', 'confidence' => 0.0, 'source' => null, 'evidence' => null],
                        'gender' => ['value' => 'female', 'status' => 'exact', 'confidence' => 1.0, 'source' => 'bio', 'evidence' => null],
                        'birth_year' => ['value' => null, 'status' => 'unknown', 'confidence' => 0.0, 'source' => null, 'evidence' => null],
                        'birth_year_range' => ['min' => null, 'max' => null, 'status' => 'unknown', 'confidence' => 0.0, 'source' => null, 'evidence' => null],
                    ],
                    'career_snapshot' => [
                        'year_first_started_working' => ['value' => 2014, 'status' => 'inferred', 'confidence' => 0.7, 'source' => 'experience', 'evidence' => null],
                        'current_position' => ['value' => 'Senior Software Engineer', 'status' => 'exact', 'confidence' => 0.95, 'source' => 'experience', 'evidence' => null],
                        'current_organization_name' => ['value' => null, 'status' => 'unknown', 'confidence' => 0.0, 'source' => null, 'evidence' => null],
                        'subtitle_hookline' => ['value' => 'Senior Software Engineer | 8 years experience', 'status' => 'synthesized', 'confidence' => 0.85, 'source' => 'experience', 'evidence' => null],
                        'profile_description' => ['value' => 'Experienced software engineer with strong leadership background.', 'status' => 'synthesized', 'confidence' => 0.8, 'source' => 'experience', 'evidence' => null],
                    ],
                    'experience' => [
                        'timeline_is_likely_complete' => true,
                        'entries' => [
                            [
                                'job_title' => 'Senior Software Engineer',
                                'organization' => null,
                                'start_year' => 2019,
                                'end_year' => null,
                                'is_current' => true,
                                'raw_text' => '2019 - Present: Senior Software Engineer',
                                'confidence' => 0.9,
                            ],
                        ],
                    ],
                    'qualifications' => [
                        'entries' => [
                            [
                                'qualification_name_raw' => 'BSc Computer Science',
                                'qualification_name_friendly' => 'Bachelor of Science in Computer Science',
                                'qualification_type' => 'degree',
                                'field_of_study' => 'Computer Science',
                                'institution' => 'Westfield University',
                                'year_completed' => 2015,
                                'confidence' => 0.95,
                            ],
                        ],
                        'highest_academic_qualification' => ['value' => 'BSc Computer Science', 'confidence' => 0.95, 'source' => 'qualifications'],
                        'highest_professional_designation' => ['value' => null, 'confidence' => 0.0, 'source' => null],
                        'highest_qualification_display' => ['value' => 'BSc Computer Science (Westfield University, 2015)', 'confidence' => 0.9, 'source' => 'qualifications'],
                    ],
                ],
                'extraction_meta' => [
                    'assessment_date_used' => null,
                    'latest_assessment_used' => true,
                    'records_checked' => ['bio', 'experience', 'qualifications'],
                    'warnings' => [],
                ],
                'instrument_interpretations' => [],
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

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentProfileInfoExtractorResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentProfileInfoExtractorResult
    {
        return parent::retrieveRunResult($run);
    }
}
