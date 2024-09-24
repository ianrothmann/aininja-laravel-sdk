<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaScoringGuideRefinementResult;

class ScoringGuideItemRefineProcessor extends AINinjaProcessor
{
    protected function getEndpoint(): string
    {
        return '/scoring_guide_item_refinement';
    }

    protected function getResultClass(): string
    {
        return AINinjaScoringGuideRefinementResult::class;
    }

    protected function getMocked(): array
    {
        $json = <<<'TOC'
{
  "updated_items": [
    {
      "item_id": "4",
      "original_item": "Old item text 1",
      "updated_item": "New item text 1",
      "update_reason": "Reason 1",
      "update_excerpts": "Example 1"
    },
    {
      "item_id": "5",
      "original_item": "Old item text 2",
      "updated_item": "New item text 2",
      "update_reason": "Reason 2",
      "update_excerpts": "Example 2"
    }
  ]
}
TOC;

        return json_decode($json, true);
    }

    public function forDimension(string $dimensionName): self
    {
        $this->setInputParameter('dimension', $dimensionName);

        return $this;
    }

    public function candidateWasGivenQuestion(string $question): self
    {
        $this->setInputParameter('question', $question);

        return $this;
    }

    public function addItem($itemId, $itemText): self
    {
        $this->addToInputArray('items', ['item_id' => $itemId, 'item' => $itemText]);

        return $this;
    }

    public function addExample(string $example): self
    {
        $this->addToInputArray('examples', $example);

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'dimension' => 'required|string',
            'question' => 'required|string',
            'items' => 'required|array',
            'items.*.item_id' => 'required',
            'items.*.item' => 'required|string',
            'examples' => 'array|min:1',
        ];
    }

    public function get(): AINinjaScoringGuideRefinementResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaScoringGuideRefinementResult
    {
        return parent::stream();
    }
}
