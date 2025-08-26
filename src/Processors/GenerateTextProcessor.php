<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaGenerateTextResult;

class GenerateTextProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/generate_text';
    }

    protected function getResultClass(): string
    {
        return AINinjaGenerateTextResult::class;
    }

    protected function getMocked()
    {
        return '1. Kwame 2. Aisha 3. Simba 4. Nala 5. Kofi';
    }

    public function addInstruction(string $instruction): self
    {
        $this->addToInputArray('instructions', $instruction);

        return $this;
    }

    public function useAdvancedMode(): self
    {
        $this->setInputParameter('advanced', true);

        return $this;
    }

    public function withoutReasoning(): self
    {
        $this->setInputParameter('without_reasoning', true);

        return $this;
    }

    public function useQuickMode(): self
    {
        $this->setInputParameter('quick', true);

        return $this;
    }

    public function getValidationRules(): array
    {
        return [
            'instructions' => 'required|array',
            'instructions.*' => 'required|string',
            'advanced' => 'sometimes|boolean',
            'without_reasoning' => 'sometimes|boolean',
            'quick' => 'sometimes|boolean',
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
