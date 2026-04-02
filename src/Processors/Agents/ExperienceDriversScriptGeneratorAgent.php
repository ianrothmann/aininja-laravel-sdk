<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentExperienceDriversScriptGeneratorResult;

class ExperienceDriversScriptGeneratorAgent extends AINinjaAgent
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_experience_drivers_script_generator';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentExperienceDriversScriptGeneratorResult::class;
    }

    public function getMocked(): array
    {
        return [
            'output' => [
                'title' => 'What Drives You Forward',
                'script' => 'You thrive when you have freedom — freedom to own your decisions, shape your direction, and work without someone constantly looking over your shoulder. Autonomy isn\'t just a preference for you; it\'s the fuel that keeps you going. Pair that with a drive to keep growing, and you\'ve got someone who needs work to feel like it\'s going somewhere. And underneath it all, there\'s a practical streak — you want work that actually matters and connects to real outcomes. When you get all three, you\'re unstoppable. When you don\'t, things start feeling hollow pretty quickly. The good news is you know what you need. Now it\'s about finding environments — and creating ones — where those things show up.',
                'word_count' => 112,
                'hidden_interpretation' => [
                    'title' => 'What Drives You Forward',
                    'candidate_first_name' => 'Sam',
                    'top_driver_anchor' => [
                        'code' => 'AUT',
                        'label' => 'Autonomy',
                        'meaning' => 'This person needs independence and ownership over their work to feel energised.',
                    ],
                    'driver_pattern_summary' => 'Autonomy anchors the profile, supported by growth orientation and a need for purposeful, outcome-driven work.',
                    'how_the_top_3_work_together' => [
                        'Autonomy gives them the freedom to grow in their own way.',
                        'Growth keeps them engaged and moving forward.',
                        'Purpose ensures their efforts feel meaningful.',
                    ],
                    'what_this_person_needs_from_work' => [
                        'Independence in decision-making',
                        'Opportunities to learn and develop',
                        'Clear connection between their work and real outcomes',
                    ],
                    'likely_energisers' => [
                        'Ownership of projects',
                        'Learning new skills',
                        'Seeing tangible results from their efforts',
                    ],
                    'likely_frustrators' => [
                        'Micromanagement',
                        'Repetitive work with no growth',
                        'Feeling disconnected from purpose',
                    ],
                    'practical_advice' => [
                        'Seek roles that offer project ownership',
                        'Invest in continuous learning',
                        'Communicate your need for autonomy upfront',
                    ],
                ],
            ],
        ];
    }

    public function firstName(string $name): self
    {
        $this->input['first_name'] = $name;

        return $this;
    }

    public function candidateContext(string $context): self
    {
        $this->input['candidate_context'] = $context;

        return $this;
    }

    public function experienceDriverDictionary(array $dictionary): self
    {
        $this->input['experience_driver_dictionary'] = $dictionary;

        return $this;
    }

    public function top3DriverCodes(string $driver1, string $driver2, string $driver3): self
    {
        $this->input['top_3_driver_codes'] = [
            'driver1' => $driver1,
            'driver2' => $driver2,
            'driver3' => $driver3,
        ];

        return $this;
    }

    public function outputLanguageName(string $name): self
    {
        $this->input['output_language_name'] = $name;

        return $this;
    }

    public function outputLanguageCode(string $code): self
    {
        $this->input['output_language_code'] = $code;

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'first_name' => 'required|string',
            'candidate_context' => 'required|string',
            'experience_driver_dictionary' => 'required|array',
            'top_3_driver_codes' => 'required|array',
            'top_3_driver_codes.driver1' => 'required|string',
            'top_3_driver_codes.driver2' => 'required|string',
            'top_3_driver_codes.driver3' => 'required|string',
            'output_language_name' => 'nullable|string',
            'output_language_code' => 'nullable|string',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentExperienceDriversScriptGeneratorResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentExperienceDriversScriptGeneratorResult
    {
        return parent::retrieveRunResult($run);
    }
}
