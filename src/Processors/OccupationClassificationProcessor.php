<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaCodeNamePairResult;

class OccupationClassificationProcessor extends AINinjaProcessor
{
    protected function getEndpoint(): string
    {
        return '/classify_soc_role';
    }

    protected function getResultClass(): string
    {
        return AINinjaCodeNamePairResult::class;
    }

    protected function getMocked(): array
    {
        return [
            'code' => '15-1252',
            'name' => 'Software Developers',
        ];
    }

    public function addToContext(string $type, $context): self
    {
        if (is_array($context)) {
            $context = json_encode($context);
        }
        $this->addToInputArray('context', $context, $type);

        return $this;
    }

    public function hasContext(): bool
    {
        return $this->input && array_key_exists('context', $this->input) && ! empty($this->input['context']);
    }

    protected function getValidationRules(): array
    {
        return [
            'context' => 'required|array',
        ];
    }

    public function get(): AINinjaCodeNamePairResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaCodeNamePairResult
    {
        return parent::stream($callback);
    }
}
