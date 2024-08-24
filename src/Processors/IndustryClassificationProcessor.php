<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaCodeNamePairResult;

class IndustryClassificationProcessor extends AINinjaProcessor
{
    protected function getEndpoint(): string
    {
        return '/classify_naic_industry';
    }

    protected function getResultClass(): string
    {
        return AINinjaCodeNamePairResult::class;
    }

    protected function getMocked(): array
    {
        return [
            'code' => '5221',
            'name' => 'Depository Credit Intermediation',
        ];
    }

    public function addToContext(string $type, $context): self
    {
        $this->addToInputArray('context', $context, $type);

        return $this;
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
