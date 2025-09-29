<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentCompetencyDevelopmentCuratorResult;

class CompetencyDevelopmentCuratorAgent extends AINinjaAgent
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_competency_development_curator';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentCompetencyDevelopmentCuratorResult::class;
    }

    public function getMocked(): array
    {
        return [
            'output' => [
                'summary' => 'Curated development plan for Leadership and Decision Making at managerial level. Includes comprehensive learning resources and development activities.',
                'competency' => [
                    'name' => 'Leadership and Decision Making',
                    'description' => 'The ability to guide teams, make strategic decisions, and drive organizational success through effective leadership practices and sound judgment.',
                    'target_level' => 'managerial',
                ],
                'resources' => [
                    'e_learning' => [
                        [
                            'title' => 'Strategic Leadership for Banking Managers',
                            'description' => 'Interactive online course covering strategic thinking, team leadership, and decision-making frameworks specific to banking environments.',
                            'url' => 'https://example.com/strategic-leadership-banking',
                            'cover_image' => 'https://example.com/images/strategic-leadership.jpg',
                        ],
                        [
                            'title' => 'Decision Making Under Uncertainty',
                            'description' => 'Advanced course on making effective decisions in volatile financial markets and regulatory environments.',
                            'url' => 'https://example.com/decision-making-uncertainty',
                            'cover_image' => null,
                        ],
                    ],
                    'video' => [
                        [
                            'title' => 'Leading Through Change in Financial Services',
                            'description' => 'Video series featuring case studies from successful banking leaders navigating organizational transformation.',
                            'url' => 'https://example.com/leading-through-change',
                            'cover_image' => 'https://example.com/images/change-leadership.jpg',
                        ],
                        [
                            'title' => 'Central Bank Leadership Masterclass',
                            'description' => 'Expert interviews and presentations on leadership challenges unique to central banking.',
                            'url' => 'https://example.com/central-bank-masterclass',
                            'cover_image' => null,
                        ],
                    ],
                ],
                'development' => [
                    'experience' => [
                        [
                            'title' => 'Cross-Departmental Project Leadership',
                            'description' => 'Lead a strategic initiative that involves multiple departments within the central bank.',
                            'rationale' => 'Provides hands-on experience in managing complex stakeholder relationships and making decisions with organization-wide impact.',
                            'time_commitment_months' => 6,
                            'urls' => ['https://example.com/project-leadership-guide'],
                        ],
                        [
                            'title' => 'Crisis Response Team Participation',
                            'description' => 'Join or lead the crisis response team for market volatility or regulatory changes.',
                            'rationale' => 'Develops decision-making skills under pressure and leadership capabilities during high-stakes situations.',
                            'time_commitment_months' => 3,
                            'urls' => ['https://example.com/crisis-management-best-practices'],
                        ],
                    ],
                    'exposure' => [
                        [
                            'title' => 'Executive Shadowing Program',
                            'description' => 'Shadow senior executives during key decision-making processes and board meetings.',
                            'rationale' => 'Provides insight into high-level strategic thinking and executive decision-making processes.',
                            'time_commitment_months' => 2,
                            'urls' => ['https://example.com/executive-shadowing-framework'],
                        ],
                        [
                            'title' => 'Industry Conference Speaker Role',
                            'description' => 'Present at banking or financial services conferences on leadership topics.',
                            'rationale' => 'Builds thought leadership and provides exposure to diverse perspectives on leadership challenges.',
                            'time_commitment_months' => 1,
                            'urls' => ['https://example.com/conference-speaking-guide'],
                        ],
                    ],
                ],
            ],
        ];
    }

    public function competencyName(string $competencyName): self
    {
        $this->input['competency_name'] = $competencyName;

        return $this;
    }

    public function competencyDescription(string $description): self
    {
        $this->input['competency_description'] = $description;

        return $this;
    }

    public function targetLevel(string $level): self
    {
        $this->input['target_level'] = $level;

        return $this;
    }

    public function includeResources(array $resources): self
    {
        if (! isset($this->input['include'])) {
            $this->input['include'] = [];
        }
        $this->input['include']['resources'] = $resources;

        return $this;
    }

    public function includeEee(array $eee): self
    {
        if (! isset($this->input['include'])) {
            $this->input['include'] = [];
        }
        $this->input['include']['eee'] = $eee;

        return $this;
    }

    public function locale(string $locale): self
    {
        $this->input['locale'] = $locale;

        return $this;
    }

    public function constraints(int $perTypeMin = 3, int $perTypeMax = 6): self
    {
        $this->input['constraints'] = [
            'per_type_min' => $perTypeMin,
            'per_type_max' => $perTypeMax,
        ];

        return $this;
    }

    public function context(?string $industry = null, ?string $seniority = null, ?string $audience = null, ?array $regions = null): self
    {
        $contextData = array_filter([
            'industry' => $industry,
            'seniority' => $seniority,
            'audience' => $audience,
            'regions' => $regions,
        ], fn ($value) => $value !== null);

        if (! empty($contextData)) {
            $this->input['context'] = $contextData;
        }

        return $this;
    }

    public function quickMode(bool $quickMode = true): self
    {
        $this->input['quick_mode'] = $quickMode;

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'competency_name' => 'required|string',
            'competency_description' => 'required|string',
            'target_level' => 'required|string|in:professional,managerial,executive',
            'include' => 'array',
            'include.resources' => 'array',
            'include.resources.*' => 'in:e_learning,video,audio,reading',
            'include.eee' => 'array',
            'include.eee.*' => 'in:experience,exposure,education',
            'locale' => 'string',
            'constraints' => 'array',
            'constraints.per_type_min' => 'integer|min:1',
            'constraints.per_type_max' => 'integer|min:1',
            'context' => 'array',
            'context.industry' => 'string|nullable',
            'context.seniority' => 'string|nullable',
            'context.audience' => 'string|nullable',
            'context.regions' => 'array|nullable',
            'quick_mode' => 'boolean',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentCompetencyDevelopmentCuratorResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentCompetencyDevelopmentCuratorResult
    {
        return parent::retrieveRunResult($run);
    }
}