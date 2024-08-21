<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaNameSplitResult;

class NameSplitProcessor extends AINinjaProcessor
{

    protected function getEndpoint(): string
    {
        return '/name_splitter';
    }

    protected function getResultClass(): string
    {
        return AINinjaNameSplitResult::class;
    }

    public function addName($id, $name): self
    {
        $this->addToInputArray('names', $name, $id);
        return $this;
    }

    public function addNames(array $namesById): self
    {
        foreach ($namesById as $id => $name) {
            $this->addName($id, $name);
        }
        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'names' => 'required|array',
        ];
    }

    public function get(): AINinjaNameSplitResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaNameSplitResult
    {
        return parent::stream($callback);
    }

    protected function getMocked()
    {
        return [
            '1' => ['name'=>'John', 'surname'=>'Doe'],
            '2' => ['name'=>'Jane', 'surname'=>'Doe']
        ];
    }
}
