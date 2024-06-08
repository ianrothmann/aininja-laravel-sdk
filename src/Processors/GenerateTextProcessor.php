<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaGenerateTextResult;

class GenerateTextProcessor extends AiNinjaProcessor
{
    protected function getEndpoint(): string
    {
        return '/generate_text';
    }

    protected function getResultClass(): string
    {
        return AINinjaGenerateTextResult::class;
    }

    protected function getMocked(): mixed
    {
        return '1. Kwame 2. Aisha 3. Simba 4. Nala 5. Kofi';
    }

    public function addInstruction(string $instruction): self
    {
        $this->addToInputArray('instructions', $instruction);
        return $this;
    }

    public function getValidationRules(): array
    {
        return [
            'instructions' => 'required|array',
            'instructions.*' => 'required|string',
        ];
    }

    public function get(): AINinjaGenerateTextResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaGenerateTextResult
    {
        return parent::stream($callback);
    }
}
