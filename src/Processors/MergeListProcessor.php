<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaMergedListResult;

class MergeListProcessor extends AINinjaProcessor
{
    protected function getEndpoint(): string
    {
        return '/list_matcher';
    }

    protected function getResultClass(): string
    {
        return AINinjaMergedListResult::class;
    }

    public function addToMasterList($id, $name): self
    {
        $this->addToInputArray('original_list', [
            'id' => $id,
            'name' => $name,
        ]);

        return $this;
    }

    public function addToAuxList($id, $name): self
    {
        $this->addToInputArray('new_list', [
            'id' => $id,
            'name' => $name,
        ]);

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'original_list' => 'required|array',
            'new_list' => 'required|array',
        ];
    }

    public function get(): AINinjaMergedListResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaMergedListResult
    {
        return parent::stream($callback);
    }

    protected function getMocked(): mixed
    {
        return [
            '1' => '2',
            '3' => '4',
        ];
    }
}
