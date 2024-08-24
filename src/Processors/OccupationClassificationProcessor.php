<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaCodeNamePairResult;
use IanRothmann\AINinja\Results\AINinjaKeywordResult;

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
            'name' => 'Software Developers'
        ];
    }

    public function addToContext(string $type, $context): self
    {
        if(is_array($context)){
            $context = json_encode($context);
        }
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
