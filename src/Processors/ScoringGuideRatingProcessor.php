<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaScoringGuideRatingResult;
use IanRothmann\AINinja\Results\AINinjaScoringGuideRefinementResult;

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
    "reason": "The candidate did not mention specific products or services. They discussed general concepts like databases and apps but lacked concrete examples for Tom's business.",
    "questions": {
      "5": [
        {
          "question": "Does the candidate mention specific products or services in at least three business functions?",
          "answer": "No",
          "reason": "No specific products or services were mentioned in three business functions."
        },
        {
          "question": "Does the candidate explain how products or services apply to Tom's business?",
          "answer": "No",
          "reason": "General solutions were given, but no specific products or services were mentioned."
        }
      ],
      "4": [
        {
          "question": "Does the candidate mention products or services in three business functions?",
          "answer": "No",
          "reason": "General improvements were discussed without naming products or services."
        },
        {
          "question": "Does the candidate provide examples for each business function?",
          "answer": "No",
          "reason": "No specific examples or product names were given."
        }
      ],
      "3": [
        {
          "question": "Does the candidate mention products in two business functions?",
          "answer": "No",
          "reason": "No specific products or services were mentioned."
        }
      ],
      "2": [
        {
          "question": "Does the candidate mention at least one product or service?",
          "answer": "No",
          "reason": "General concepts were mentioned without naming products or services."
        }
      ]
    }
  },
  {
    "id": "2",
    "rating": 5,
    "reason": "The candidate presented multiple creative solutions like AI for measurements, AR for visualizing tiles, and an app for quotes. The solutions were integrated into a cohesive plan.",
    "questions": {
      "5": [
        {
          "question": "Does the candidate provide multiple creative solutions?",
          "answer": "Yes",
          "reason": "AI for measurements, AR for tiles, and an app for quotes were proposed."
        },
        {
          "question": "Are the solutions interconnected and form a cohesive plan?",
          "answer": "Yes",
          "reason": "The solutions form a unified approach to Tom's business challenges."
        }
      ],
      "4": [
        {
          "question": "Does the candidate provide distinct creative solutions beyond general suggestions?",
          "answer": "No",
          "reason": "There are not multiple distinct innovative strategies."
        }
      ],
      "3": [
        {
          "question": "Does the candidate provide at least one original solution?",
          "answer": "Yes",
          "reason": "The use of AI for measurements and AR for visualizing tiles shows creative thinking."
        }
      ],
      "2": [
        {
          "question": "Does the candidate provide any solutions to Tom's problems?",
          "answer": "Yes",
          "reason": "Several suggestions were provided, like a database, app, and AR for visualizing tiles."
        },
        {
          "question": "Are the suggestions general or lacking originality?",
          "answer": "No",
          "reason": "The solutions include specific and somewhat innovative approaches."
        }
      ]
    }
  }
]

TOC;

        return json_decode($json,true);
    }

    public function onAnswer(string $answer): self
    {
        $this->setInputParameter('answer', $answer);

        return $this;
    }

    public function rateItemId($itemId): self
    {
        $this->addToInputArray('rubric', ['id' => $itemId, 'anchors' => []]);

        return $this;
    }

    public function withAnchor(int $value, $title = "", $description = ""): self
    {
        if (!array_key_exists('rubric', $this->input)) {
            throw new \Exception('First add the item for rating');
        }

        $lastKey = array_key_last($this->input['rubric']);

        if ($lastKey === null) {
            throw new \Exception('No items found in the rubric to add an anchor.');
        }

        $this->input['rubric'][$lastKey]['anchors'][] = [
            'title' => $title,
            'value' => $value,
            'description' => $description,
            'prerequisites' => []
        ];

        return $this;
    }

    public function withPrerequisite($question, $definitions): self
    {
        if (!array_key_exists('rubric', $this->input)) {
            throw new \Exception('First add the item for rating');
        }

        $lastKey = array_key_last($this->input['rubric']);

        if ($lastKey === null) {
            throw new \Exception('No items found in the rubric to add a prerequisite.');
        }

        $lastAnchorKey = array_key_last($this->input['rubric'][$lastKey]['anchors']);

        if ($lastAnchorKey === null) {
            throw new \Exception('No anchors found in the rubric to add a prerequisite.');
        }

        $this->input['rubric'][$lastKey]['anchors'][$lastAnchorKey]['prerequisites'][] = [
            'question' => $question,
            'definitions' => $definitions
        ];

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'answer' => 'required|string',
            'rubric' => 'required|array|min:1',
            'rubric.*.id' => 'required',
            'rubric.*.anchors' => 'required|array|min:1',
            'rubric.*.anchors.*.value' => 'required|integer',
            'rubric.*.anchors.*.title' => 'string',
            'rubric.*.anchors.*.description' => 'sometimes|string',
            'rubric.*.anchors.*.prerequisites' => 'array',
            'rubric.*.anchors.*.prerequisites.*.question' => 'required|string',
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
