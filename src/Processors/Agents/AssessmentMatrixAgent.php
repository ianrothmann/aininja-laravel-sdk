<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentAssessmentMatrixResult;

class AssessmentMatrixAgent extends AINinjaAgent
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_assessment_matrix';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentAssessmentMatrixResult::class;
    }

    public function getMocked(): array
    {
        return [
            'formatted_results' => [
                'collaboration_and_teamwork' => [
                    [
                        'dimension_id' => 'skills',
                        'weight' => 0.2,
                        'dimension_name' => 'Skills',
                        'measure_name' => 'Interview',
                        'source_name' => 'Assessment Centre',
                    ],
                    [
                        'dimension_id' => 'decision_making',
                        'weight' => 0.2,
                        'dimension_name' => 'Decision Making',
                        'measure_name' => 'Role Play',
                        'source_name' => 'Assessment Centre',
                    ],
                    [
                        'dimension_id' => 'emotional_intelligence',
                        'weight' => 0.3,
                        'dimension_name' => 'Emotional Intelligence',
                        'measure_name' => 'Personality Test',
                        'source_name' => 'Personality',
                    ],
                ],
                'communicating_with_impact' => [
                    [
                        'dimension_id' => 'skills',
                        'weight' => 0.5,
                        'dimension_name' => 'Skills',
                        'measure_name' => 'Interview',
                        'source_name' => 'Assessment Centre',
                    ],
                    [
                        'dimension_id' => 'emotional_intelligence',
                        'weight' => 0.2,
                        'dimension_name' => 'Emotional Intelligence',
                        'measure_name' => 'Personality Test',
                        'source_name' => 'Personality',
                    ],
                ],
            ],
        ];
    }

    public function addMethod($id, $name): self
    {
        $this->addToInputArray('methods', [
            'method_id' => (string) $id,
            'name' => $name,
        ], $id);

        return $this;
    }

    public function addMeasure($methodId, $id, $name, $description = null): self
    {
        if (! array_key_exists('methods', $this->input) || ! is_array($this->input['methods']) || count($this->input['methods']) == 0) {
            throw new \Exception('You must add a method before adding a measure');
        }

        if (! array_key_exists($methodId, $this->input['methods'])) {
            throw new \Exception('Method with id '.$methodId.' not found');
        }

        $this->addToInputArray('source_measures', [
            'method_id' => (string) $methodId,
            'measure_id' => (string) $id,
            'name' => $name,
            'description' => $description ?? '',
        ], $id);

        return $this;
    }

    public function addMappingDimension($measureId, $id, $name, $description = null): self
    {
        if (! array_key_exists('source_measures', $this->input) || ! is_array($this->input['source_measures']) || count($this->input['source_measures']) == 0) {
            throw new \Exception('You must add a measure before adding a dimension');
        }

        $this->addToInputArray('source_dimensions', [
            'measure_id' => (string) $measureId,
            'dimension_id' => (string) $id,
            'name' => $name,
            'description' => $description ?? '',
        ]);

        return $this;
    }

    public function addCompetency($id, $name, $description, $category): self
    {
        $this->addToInputArray('competencies', [
            'competency_id' => (string) $id,
            'name' => $name,
            'description' => $description ?? '',
            'category' => $category,
            'targets' => [],
            'count_targets' => [],
            'examples' => [],
        ], $id);

        return $this;
    }

    public function setCompetencyMethodTargets($competencyId, $methodId, $weightTarget, $numDimensionsTarget): self
    {
        $competency = $this->findAndValidateCompetency($competencyId);

        if (array_key_exists($methodId, $this->input['methods'])) {
            $this->input['competencies'][$competencyId]['targets'][$methodId] = (string) $weightTarget;
            $this->input['competencies'][$competencyId]['count_targets'][$methodId] = (string) $numDimensionsTarget;
        }

        return $this;
    }

    public function addCompetencyExample($competencyId, $mappedDimensionName, $fromMeasure, $method, $weight): self
    {
        $competency = $this->findAndValidateCompetency($competencyId);
        $this->input['competencies'][$competencyId]['examples'][] = [
            'name' => (string) $mappedDimensionName,
            'measure' => (string) $fromMeasure,
            'type' => (string) $method,
            'weight' => (string) $weight,
        ];

        return $this;
    }

    protected function findAndValidateCompetency($competencyId)
    {
        if (! array_key_exists('competencies', $this->input) || ! is_array($this->input['competencies']) || count($this->input['competencies']) == 0) {
            throw new \Exception('You must add a competency before setting a method target');
        }

        $competency = $this->input['competencies'][$competencyId] ?? null;

        if (! $competency) {
            throw new \Exception('Competency with id '.$competencyId.' not found');
        }

        return $competency;
    }

    protected function getValidationRules(): array
    {
        return [
            'competencies' => 'required|array',
            'competencies.*.targets' => 'required|array',
            'competencies.*.count_targets' => 'required|array',
            'methods' => 'required|array',
            'source_measures' => 'required|array',
            'source_dimensions' => 'required|array',
        ];
    }

    protected function transformInputForTransport(): array
    {
        $input = $this->input;

        $input['competencies'] = array_values($input['competencies']);
        $input['source_measures'] = array_values($input['source_measures']);
        $input['source_dimensions'] = array_values($input['source_dimensions']);
        $input['methods'] = array_values($input['methods']);

        return $input;
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentAssessmentMatrixResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentAssessmentMatrixResult
    {
        return parent::retrieveRunResult($run);
    }
}
