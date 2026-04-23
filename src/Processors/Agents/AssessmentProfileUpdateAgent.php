<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentAssessmentProfileUpdateResult;

class AssessmentProfileUpdateAgent extends AINinjaAgent
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_assessment_profile_update';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentAssessmentProfileUpdateResult::class;
    }

    public function profileSnapshot(array $snapshot): self
    {
        $this->input['profile_snapshot'] = $snapshot;

        return $this;
    }

    public function incomingAssessment(array $assessment): self
    {
        $this->input['incoming_assessment'] = $assessment;

        return $this;
    }

    public function options(array $options): self
    {
        $this->input['options'] = $options;

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'profile_snapshot'    => 'required|array',
            'incoming_assessment' => 'required|array',
            'options'             => 'nullable|array',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentAssessmentProfileUpdateResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentAssessmentProfileUpdateResult
    {
        return parent::retrieveRunResult($run);
    }

    public function getMocked(): array
    {
        return [
            'output' => [
                'status' => 'ok',
                'assessment_resolution' => [
                    'source_id'                        => 'fitt',
                    'already_represented_external_ids' => ['22153'],
                    'incoming_assessment_external_ids' => ['22153', '23019'],
                    'selected_assessment_external_id'  => '23019',
                    'selected_assessment_date'         => '2024-11-01',
                    'selected_assessment_name'         => 'Fitt Growth Assessment',
                    'selection_reason'                 => 'latest_incoming_assessment_not_already_represented_on_profile',
                    'new_assessment_found'             => true,
                ],
                'summary' => [
                    'headline'                        => 'New assessment identified and update candidates generated.',
                    'selected_assessment_external_id' => '23019',
                    'counts'                          => [
                        'profile_factual_updates'                => 2,
                        'qualification_updates'                  => 1,
                        'experience_updates'                     => 1,
                        'replaceable_preference_context_updates' => 4,
                        'strength_updates'                       => 3,
                        'development_area_updates'               => 3,
                        'aspiration_updates'                     => 1,
                        'development_action_proposal_candidates' => 2,
                        'learning_context_candidates'            => 1,
                    ],
                ],
                'profile_factual_updates' => [
                    [
                        'id'             => 'profile_summary',
                        'field'          => 'profile_summary',
                        'decision'       => 'add',
                        'current_value'  => null,
                        'proposed_value' => 'You bring a strong foundation in financial advisory...',
                        'reason'         => 'Field was empty; new assessment provides sufficient evidence.',
                        'confidence'     => 0.85,
                    ],
                    [
                        'id'             => 'current_position',
                        'field'          => 'current_position',
                        'decision'       => 'add',
                        'current_value'  => null,
                        'proposed_value' => 'Senior Financial Advisor',
                        'reason'         => 'Current position extracted from assessment context.',
                        'confidence'     => 0.90,
                    ],
                ],
                'qualification_updates' => [
                    [
                        'id'                      => 'bcom_honours_wits_2001',
                        'decision'                => 'add',
                        'matched_existing'        => false,
                        'current_match_reference' => null,
                        'proposed_item'           => [
                            'qualification_name' => 'BCom Honours (Accounting)',
                            'qualification_type' => 'Postgraduate Honours',
                            'field_of_study'     => 'Accounting',
                            'institution'        => 'University of the Witwatersrand',
                            'year_completed'     => 2001,
                        ],
                        'reason'     => 'Not found on profile; clearly stated in assessment.',
                        'confidence' => 0.90,
                    ],
                ],
                'experience_updates' => [
                    [
                        'id'                      => 'manager_pwc_2015',
                        'decision'                => 'add',
                        'matched_existing'        => false,
                        'current_match_reference' => null,
                        'proposed_item'           => [
                            'job_title'    => 'Manager',
                            'organization' => 'PwC',
                            'start_year'   => 2015,
                            'end_year'     => null,
                            'is_current'   => true,
                        ],
                        'reason'     => 'Current role not found in profile structured experience.',
                        'confidence' => 0.88,
                    ],
                ],
                'replaceable_preference_context_updates' => [
                    [
                        'id'               => 'preferences.personality',
                        'context_key'      => 'preferences.personality',
                        'instrument_key'   => 'ptg_personality',
                        'decision'         => 'replace',
                        'current_exists'   => true,
                        'proposed_context' => ['label' => 'Personality', 'catalog' => 'Preferences'],
                        'reason'           => 'Selected assessment contains ptg_personality data; replacing existing context.',
                        'confidence'       => 1.0,
                    ],
                    [
                        'id'               => 'preferences.experience_drivers',
                        'context_key'      => 'preferences.experience_drivers',
                        'instrument_key'   => 'ptg_experience_drivers',
                        'decision'         => 'replace',
                        'current_exists'   => false,
                        'proposed_context' => ['label' => 'Experience Drivers', 'catalog' => 'Preferences'],
                        'reason'           => 'New experience drivers data available from assessment.',
                        'confidence'       => 1.0,
                    ],
                    [
                        'id'               => 'preferences.career_path',
                        'context_key'      => 'preferences.career_path',
                        'instrument_key'   => null,
                        'decision'         => 'keep_existing',
                        'current_exists'   => true,
                        'proposed_context' => null,
                        'reason'           => 'Selected assessment does not contain ptg_career_path_preferences data; preserving existing.',
                        'confidence'       => 1.0,
                    ],
                    [
                        'id'               => 'preferences.team_role',
                        'context_key'      => 'preferences.team_role',
                        'instrument_key'   => null,
                        'decision'         => 'keep_existing',
                        'current_exists'   => false,
                        'proposed_context' => null,
                        'reason'           => 'No team role data available in assessment.',
                        'confidence'       => 1.0,
                    ],
                ],
                'strength_updates' => [
                    [
                        'id'                      => 'strategic_thinking',
                        'decision'                => 'keep',
                        'current_match_reference' => 'Strategic Thinking',
                        'proposed_item'           => [
                            'title'   => 'Strategic Thinking',
                            'summary' => 'You approach complex challenges with a clear long-term lens.',
                        ],
                        'reason'     => 'Strongly supported by competency scores and assessor comments.',
                        'confidence' => 0.92,
                    ],
                    [
                        'id'                      => 'commercial_acumen',
                        'decision'                => 'add',
                        'current_match_reference' => null,
                        'proposed_item'           => [
                            'title'   => 'Commercial Acumen',
                            'summary' => 'You demonstrate a sharp instinct for translating financial insight.',
                        ],
                        'reason'     => 'High competency scores in commercial and business development areas.',
                        'confidence' => 0.80,
                    ],
                    [
                        'id'                      => 'relationship_building',
                        'decision'                => 'add',
                        'current_match_reference' => null,
                        'proposed_item'           => [
                            'title'   => 'Relationship Building',
                            'summary' => 'You build trust quickly and maintain strong stakeholder networks.',
                        ],
                        'reason'     => 'Consistently evidenced across self-description and assessor comments.',
                        'confidence' => 0.88,
                    ],
                ],
                'development_area_updates' => [
                    [
                        'id'                      => 'executive_presence',
                        'decision'                => 'add',
                        'current_match_reference' => null,
                        'proposed_item'           => [
                            'title'   => 'Executive Presence',
                            'summary' => 'Develop gravitas and authority when operating at board level.',
                        ],
                        'reason'     => 'Assessor identified this as a priority development area.',
                        'confidence' => 0.85,
                    ],
                    [
                        'id'                      => 'delegation',
                        'decision'                => 'add',
                        'current_match_reference' => null,
                        'proposed_item'           => [
                            'title'   => 'Delegation',
                            'summary' => 'Trust the team to execute while focusing on strategic priorities.',
                        ],
                        'reason'     => 'Pattern noted in 360 feedback and self-reflection.',
                        'confidence' => 0.78,
                    ],
                    [
                        'id'                      => 'data_driven_decisions',
                        'decision'                => 'add',
                        'current_match_reference' => null,
                        'proposed_item'           => [
                            'title'   => 'Data-Driven Decision Making',
                            'summary' => 'Build confidence in using analytical insights to guide strategy.',
                        ],
                        'reason'     => 'Below-average competency score in analytical reasoning.',
                        'confidence' => 0.82,
                    ],
                ],
                'aspiration_updates' => [
                    [
                        'id'                      => 'cfo_role',
                        'decision'                => 'add',
                        'current_match_reference' => null,
                        'proposed_item'           => [
                            'title'   => 'CFO / Senior Finance Leadership',
                            'summary' => 'Aspires to step into a CFO or equivalent senior finance leadership role.',
                        ],
                        'reason'     => 'Clearly stated aspiration supported by career trajectory evidence.',
                        'confidence' => 0.88,
                    ],
                ],
                'development_action_proposal_candidates' => [
                    [
                        'id'                   => 'devaction_71015',
                        'source_type'          => 'assessor_idp',
                        'decision'             => 'new',
                        'overlap_reference'    => null,
                        'proposed_item'        => [
                            'title'       => 'Lead a cross-functional strategy review',
                            'description' => 'Volunteer to lead or co-lead an upcoming strategy review.',
                            'rationale'   => 'Builds executive presence and strategic framing skills.',
                            'category'    => 'experience',
                            'timeframe'   => 'short_term',
                        ],
                        'suggested_goal_match' => 'Lead with clarity and decisiveness',
                        'reason'               => 'Not yet represented in existing development work.',
                        'confidence'           => 0.85,
                    ],
                    [
                        'id'                   => 'devaction_71016',
                        'source_type'          => 'assessor_idp',
                        'decision'             => 'new',
                        'overlap_reference'    => null,
                        'proposed_item'        => [
                            'title'       => 'Engage a delegation coach',
                            'description' => 'Work with an executive coach on structured delegation practices.',
                            'rationale'   => 'Directly targets the delegation development area.',
                            'category'    => 'education',
                            'timeframe'   => 'medium_term',
                        ],
                        'suggested_goal_match' => null,
                        'reason'               => 'Assessor recommendation; not covered in existing IDP.',
                        'confidence'           => 0.80,
                    ],
                ],
                'learning_context_candidates' => [
                    [
                        'id'          => 'stakeholder_influence',
                        'decision'    => 'new',
                        'topic'       => 'stakeholder influence',
                        'description' => 'Low competency score in influencing without authority; developing this will strengthen advisory impact.',
                        'reason'      => 'Not covered by existing learning resources.',
                        'confidence'  => 0.80,
                    ],
                ],
                'warnings' => [],
            ],
        ];
    }
}
