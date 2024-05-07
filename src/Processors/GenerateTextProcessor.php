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
        return "1. Kwame 2. Aisha 3. Simba 4. Nala 5. Kofi";
    }

    public function withInstruction(string $instruction): self
    {
        $this->input['instructions'][] = $instruction;
        return $this;
    }

    public function withInstructions($instructions): self
    {
        if (is_array($instructions)) {
            $instructions = json_encode($instructions);
        }

        $this->input['instructions'] = $instructions;

        return $this;
    }

    public function get(): AINinjaGenerateTextResult
    {
        if (is_array($this->input['instructions'])) {
            $this->input['instructions'] = json_encode($this->input['instructions']);
        }

        return parent::get();
    }

    public function stream($callback = null): AINinjaGenerateTextResult
    {
        if (is_array($this->input['instructions'])) {
            $this->input['instructions'] = json_encode($this->input['instructions']);
        }

        return parent::stream($callback);
    }
}
