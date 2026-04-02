<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentLearningDomainGeneratorResult;

class LearningDomainGeneratorAgent extends AINinjaAgent
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_learning_domain_generator';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentLearningDomainGeneratorResult::class;
    }

    public function getMocked(): array
    {
        return [
            'output' => [
                'person_id' => 'person_001',
                'profile_version_id' => 'pv_001',
                'development_goal_version_id' => 'dgv_001',
                'generation_summary' => [
                    'status' => 'success',
                    'warnings' => [],
                    'notes' => [],
                    'generation_mode' => 'llm_only',
                    'existing_domain_count' => 0,
                    'new_domain_count' => 2,
                    'total_active_domain_count_after_merge' => 2,
                ],
                'learning_domains' => [
                    [
                        'id' => 'ld_001',
                        'is_new' => true,
                        'title' => 'Strategic Leadership',
                        'slug' => 'strategic-leadership',
                        'summary' => 'Developing the ability to set direction, align stakeholders, and drive organisational outcomes at a senior level.',
                        'candidate_description' => 'This domain will help you build the strategic thinking and executive influence needed to move into a senior leadership role.',
                        'why_this_domain_exists' => 'Directly supports the aspiration to move into a CTO or VP Engineering role within 3-5 years.',
                        'goal_links' => [
                            ['goal_id' => 'goal_001', 'goal_name' => 'Senior Leadership Role', 'link_strength' => 'primary'],
                        ],
                        'domain_type' => 'role_transition',
                        'search_seed_terms' => ['strategic leadership', 'executive presence', 'VP Engineering'],
                        'freshness_priority' => 'mixed',
                        'confidence' => 0.92,
                    ],
                    [
                        'id' => 'ld_002',
                        'is_new' => true,
                        'title' => 'Business Acumen & Commercial Thinking',
                        'slug' => 'business-acumen-commercial-thinking',
                        'summary' => 'Building understanding of commercial drivers, financial literacy, and how engineering decisions impact business outcomes.',
                        'candidate_description' => 'This domain will help you develop the business perspective needed to lead at an executive level.',
                        'why_this_domain_exists' => 'Addresses the identified development area of business acumen and strengthens credibility for executive roles.',
                        'goal_links' => [
                            ['goal_id' => 'goal_001', 'goal_name' => 'Senior Leadership Role', 'link_strength' => 'secondary'],
                        ],
                        'domain_type' => 'applied_market',
                        'search_seed_terms' => ['business acumen', 'commercial thinking', 'P&L management'],
                        'freshness_priority' => 'evergreen',
                        'confidence' => 0.85,
                    ],
                ],
            ],
        ];
    }

    public function personProfile(array $profile): self
    {
        $this->input['person_profile'] = $profile;

        return $this;
    }

    public function developmentGoals(array $goals): self
    {
        $this->input['development_goals'] = $goals;

        return $this;
    }

    public function existingLearningDomains(array $domains): self
    {
        $this->input['existing_learning_domains'] = $domains;

        return $this;
    }

    public function generationContext(array $context): self
    {
        $this->input['generation_context'] = $context;

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'person_profile'                       => 'required|array',
            'person_profile.id'                    => 'required|string',
            'person_profile.name'                  => 'required|string',
            'person_profile.surname'               => 'required|string',
            'person_profile.country'               => 'required|string',
            'person_profile.current_position'      => 'required|string',
            'person_profile.current_organization'  => 'required|string',
            'development_goals'                    => 'required|array',
            'development_goals.*.id'               => 'required|string',
            'development_goals.*.name'             => 'required|string',
            'existing_learning_domains'            => 'nullable|array',
            'generation_context'                   => 'nullable|array',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentLearningDomainGeneratorResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentLearningDomainGeneratorResult
    {
        return parent::retrieveRunResult($run);
    }
}
