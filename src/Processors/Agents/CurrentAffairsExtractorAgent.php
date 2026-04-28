<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentCurrentAffairsExtractorResult;

class CurrentAffairsExtractorAgent extends AINinjaAgent
{
    use OutputsInLanguage;

    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_current_affairs_extractor';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentCurrentAffairsExtractorResult::class;
    }

    public function getMocked(): array
    {
        return [
            'output' => [
                'generated_at' => '2026-04-10T08:31:24.883408+00:00',
                'summary' => [
                    'headline' => 'Selective financing, tighter governance, and carbon costs define a make-or-break year for JSE-listed miners.',
                    'overview' => 'For a Johannesburg-based CFO of a diversified, JSE-listed mining group, 2026 is shaped by stricter governance requirements, rising carbon and minimum-tax obligations, and operational fragilities from uneven power reliability.',
                    'top_watch_items' => [
                        'Carbon Tax Phase 2 and Pillar Two mechanics on cash taxes, provisions, and guidance',
                        'Refinancing windows, spreads and covenant headroom as credit conditions remain selective',
                        'Eskom reliability trajectory vs. self-generation/renewables project timelines',
                    ],
                ],
                'issues' => [
                    [
                        'id' => 'sa-tax-cost-headwinds-carbon-tax-phase-2',
                        'title' => 'SA tax cost headwinds: Carbon Tax Phase 2 + Pillar Two drive higher effective rates',
                        'summary' => 'From 1 January 2026, South Africa\'s carbon tax rate rises materially while Global Minimum Tax rules go live.',
                        'why_it_matters' => 'This directly affects EBITDA-to-FCF conversion, guidance, dividend capacity and debt covenants.',
                        'relevance_score' => 0.95,
                        'importance_level' => 'high',
                        'change_status' => 'new',
                        'relevance_types' => ['geography', 'industry', 'professional_context', 'future_direction'],
                        'time_horizon' => 'immediate',
                        'implications' => [
                            'Model carbon tax pass-through scenarios into 2026–2028 guidance and covenants.',
                            'Stand up Pillar Two data pipelines and controls.',
                        ],
                        'watch_questions' => [
                            'What is the net 2026–2027 ETR and cash-tax uplift once carbon tax and GMT top-ups are combined?',
                        ],
                        'source_notes' => [
                            [
                                'source_name' => 'South African Revenue Service — Budget 2026 FAQ',
                                'source_type' => 'official',
                                'published_at' => null,
                                'url' => 'https://www.sars.gov.za/about/sars-tax-and-customs-system/budget/budget-2026-frequently-asked-questions/',
                            ],
                        ],
                    ],
                ],
                'changes' => [
                    'new_issue_ids' => ['sa-tax-cost-headwinds-carbon-tax-phase-2'],
                    'rising_issue_ids' => [],
                    'declining_issue_ids' => [],
                    'retired_issue_ids' => [],
                ],
                'agent_context' => [
                    'conversation_guidance' => 'The client is a CFO of a JSE-listed diversified mining group. 2026 environment features stronger governance, rising carbon costs, and a selective credit market.',
                    'development_guidance' => 'Build 2026–2028 cash-flow/scenario modeling under higher carbon costs; validate Pillar Two data pipelines.',
                    'advice_guidance' => 'Prioritize guidance on carbon tax/GMT effects on EBITDA-to-FCF and energy reliability strategies.',
                ],
            ],
        ];
    }

    public function personContext(array $context): self
    {
        $this->input['person_context'] = $context;

        return $this;
    }

    public function priorState(array $state): self
    {
        $this->input['prior_state'] = $state;

        return $this;
    }

    public function runDate(string $date): self
    {
        $this->input['run_date'] = $date;

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'person_context' => 'required|array',
            'prior_state' => 'nullable|array',
            'run_date' => 'nullable|string',
            'output_language_name' => 'nullable|string',
            'output_language_code' => 'nullable|string',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentCurrentAffairsExtractorResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentCurrentAffairsExtractorResult
    {
        return parent::retrieveRunResult($run);
    }
}
