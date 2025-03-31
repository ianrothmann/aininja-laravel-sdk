<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaJsonResult;

class GenerateJsonProcessor extends AINinjaProcessor
{
    protected function getEndpoint(): string
    {
        return '/generate_json';
    }

    protected function getResultClass(): string
    {
        return AINinjaJsonResult::class;
    }

    public function addInstruction(string $instruction): self
    {
        if (! array_key_exists('instructions', $this->input)) {
            $this->input['instructions'] = [];
        }

        $this->input['instructions'][] = $instruction;

        return $this;
    }

    public function expectJsonStructure(array $structure): self
    {
        $this->input['json_structure'] = json_encode($structure);

        return $this;
    }

    public function useAdvancedMode(): self
    {
        $this->setInputParameter('advanced', true);

        return $this;
    }

    public function getValidationRules(): array
    {
        return [
            'instructions' => 'required|array',
            'instructions.*' => 'required|string',
            'json_structure' => 'required|string',
            'advanced' => 'sometimes|boolean',
        ];
    }

    public function get(): AINinjaJsonResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaJsonResult
    {
        return parent::stream($callback);
    }

    protected function getMocked(): array
    {
        return [
            'key1' => 'value',
            'key2' => 'value',
        ];
    }
}
