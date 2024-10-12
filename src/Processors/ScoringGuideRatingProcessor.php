<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaScoringGuideRatingResult;

class ScoringGuideRatingProcessor extends AINinjaProcessor
{
    protected function getEndpoint(): string
    {
        return '/scoring_guide_rating';
    }

    protected function getResultClass(): string
    {
        return AINinjaScoringGuideRatingResult::class;
    }

    protected function getMocked(): array
    {
        $json = <<<TOC
[
  {
    "id": "1",
    "rating": 1,
    "reason": "The candidate did not mention specific products or services. They discussed general concepts like databases and apps but lacked concrete examples for Tom's business."
  },
  {
    "id": "2",
    "rating": 5,
    "reason": "The candidate presented multiple creative solutions like AI for measurements, AR for visualizing tiles, and an app for quotes. The solutions were integrated into a cohesive plan."
  }
]
TOC;

        return json_decode($json, true);
    }

    public function onAnswer(string $answer): self
    {
        $this->setInputParameter('answer', $answer);

        return $this;
    }

    public function givenQuestion(string $question): self
    {
        $this->setInputParameter('question', $question);

        return $this;
    }

    public function rateItem($itemId, $itemText, $guidelines=''): self
    {
        $this->addToInputArray('rubric', ['id' => $itemId, 'item' => $itemText, 'guidelines'=>$guidelines, 'anchors' => []]);

        return $this;
    }

    public function withAnchor(int $value, $title = '', $description = '', $criteria=[], $examples = []): self
    {
        if (! array_key_exists('rubric', $this->input)) {
            throw new \Exception('First add the item for rating');
        }

        $lastKey = array_key_last($this->input['rubric']);

        if ($lastKey === null) {
            throw new \Exception('No items found in the rubric to add an anchor.');
        }

        if(!is_array($criteria)){
            $criteria=[$criteria];
        }

        if(!is_array($examples)){
            $examples=[$examples];
        }

        $this->input['rubric'][$lastKey]['anchors'][] = [
            'name' => $title,
            'value' => $value,
            'description' => $description,
            'criteria' => $criteria,
            'examples' => $examples,
        ];

        return $this;
    }

    protected function transformInputForTransport(): array
    {
        $this->input['provide_reasons']=true;
        return parent::transformInputForTransport();
    }


    protected function getValidationRules(): array
    {
        return [
            'question' => 'required|string',
            'answer' => 'required|string',
            'rubric' => 'required|array|min:1',
            'rubric.*.id' => 'required',
            'rubric.*.item' => 'required',
            'rubric.*.guidelines' => 'sometimes',
            'rubric.*.anchors' => 'required|array|min:1',
            'rubric.*.anchors.*.value' => 'required|integer',
            'rubric.*.anchors.*.title' => 'string',
            'rubric.*.anchors.*.description' => 'sometimes|string',
            'rubric.*.anchors.*.examples' => 'array',
            'rubric.*.anchors.*.criteria' => 'array',
        ];
    }

    public function get(): AINinjaScoringGuideRatingResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaScoringGuideRatingResult
    {
        return parent::stream();
    }
}
