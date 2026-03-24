<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentInstrumentInterpretationProcessorResult;

class InstrumentInterpretationProcessorAgent extends AINinjaAgent
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_instrument_interpretation_processor';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentInstrumentInterpretationProcessorResult::class;
    }

    public function getMocked(): array
    {
        return [
            'output' => [
                'interpretations' => [
                    [
                        'instrument_key' => 'ptg_personality',
                        'instrument_interpretation' => 'This person demonstrates a strongly extraverted personality profile. They are energised by social interaction, assertive in group settings, and naturally draw others into collaboration. Their high agreeableness suggests a warm, empathic interpersonal style that builds trust and psychological safety in teams.',
                        'instrument_interpretation_short' => 'High extraversion with strong interpersonal warmth and assertiveness.',
                        'key_themes' => ['Social Energy', 'Assertiveness', 'Interpersonal Warmth', 'Team Orientation'],
                        'primary_basis' => ['result', 'interpretation'],
                        'secondary_basis' => ['definition', 'strengths'],
                        'interpretation_confidence' => 0.88,
                        'coverage_notes' => [
                            'used_result' => true,
                            'used_interpretation' => true,
                            'used_definition' => true,
                            'used_strengths' => true,
                            'used_risks' => false,
                        ],
                    ],
                    [
                        'instrument_key' => 'ptg_experience_drivers',
                        'instrument_interpretation' => 'This individual is primarily motivated by autonomy and growth. They need to feel ownership over their work and are energised by opportunities to learn and develop. Purpose is a secondary driver — they need to feel that their work connects to meaningful outcomes.',
                        'instrument_interpretation_short' => 'Motivated by autonomy, growth, and meaningful work.',
                        'key_themes' => ['Autonomy', 'Growth Orientation', 'Purpose-Driven'],
                        'primary_basis' => ['result', 'interpretation'],
                        'secondary_basis' => ['definition'],
                        'interpretation_confidence' => 0.85,
                        'coverage_notes' => [
                            'used_result' => true,
                            'used_interpretation' => true,
                            'used_definition' => true,
                            'used_strengths' => false,
                            'used_risks' => false,
                        ],
                    ],
                ],
            ],
        ];
    }

    public function instruments(array $instruments): self
    {
        $this->input['instruments'] = $instruments;

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'instruments' => 'required|array',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentInstrumentInterpretationProcessorResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentInstrumentInterpretationProcessorResult
    {
        return parent::retrieveRunResult($run);
    }
}
