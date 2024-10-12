<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaScoringGuideCriteriaResult;

class ScoringGuideCriteriaProcessor extends AINinjaProcessor
{
    protected function getEndpoint(): string
    {
        return '/scoring_guide_anchors';
    }

    protected function getResultClass(): string
    {
        return AINinjaScoringGuideCriteriaResult::class;
    }

    protected function getMocked(): array
    {
        $json = <<<TOC
{
  "rubric": {
    "items": [
      {
        "id": 1,
        "item": "Starts with a friendly tone",
        "anchors": [
          {
            "value": 1,
            "name": "Negative Start",
            "description": "Begins with a negative or neutral tone.",
            "criteria": [
              "No warmth.",
              "Fails to engage."
            ],
            "examples": [
              "We need to discuss issues.",
              "Let's get to the point."
            ]
          },
          {
            "value": 2,
            "name": "Basic Greeting",
            "description": "Offers a simple greeting but lacks enthusiasm.",
            "criteria": [
              "Basic well-wishing.",
              "Some positivity."
            ],
            "examples": [
              "Hi, hope you're okay.",
              "Hello, good to see you."
            ]
          },
          {
            "value": 3,
            "name": "Warm Greeting",
            "description": "Shows warmth and positivity.",
            "criteria": [
              "Friendly tone.",
              "Engages the listener."
            ],
            "examples": [
              "Hi there! How's it going?",
              "Hello! Glad to chat."
            ]
          },
          {
            "value": 4,
            "name": "Very Friendly Start",
            "description": "Creates a strong positive atmosphere.",
            "criteria": [
              "Genuinely welcoming.",
              "Builds rapport."
            ],
            "examples": [
              "Hi! It's great to see you!",
              "Hello! I'm excited to talk."
            ]
          },
          {
            "value": 5,
            "name": "Exceptional Warmth",
            "description": "Exudes positivity and empathy.",
            "criteria": [
              "Deep connection.",
              "Encourages dialogue."
            ],
            "examples": [
              "Hi there! I hope you're well. Let's talk.",
              "Hello! I'm here to support you."
            ]
          }
        ],
        "guidelines": "Focus on warmth and positivity. Evaluate based on tone, not length."
      },
      {
        "id": 2,
        "item": "Recognizes issues and seeks understanding",
        "anchors": [
          {
            "value": 1,
            "name": "Minimal Recognition",
            "description": "Barely mentions issues.",
            "criteria": [
              "No desire to understand."
            ],
            "examples": [
              "We need to talk about performance.",
              "There are problems."
            ]
          },
          {
            "value": 2,
            "name": "Basic Recognition",
            "description": "Acknowledges issues but lacks depth.",
            "criteria": [
              "Some acknowledgment.",
              "Limited empathy."
            ],
            "examples": [
              "I've seen changes.",
              "We should discuss your work."
            ]
          },
          {
            "value": 3,
            "name": "Moderate Understanding",
            "description": "Shows some interest in the issues.",
            "criteria": [
              "Mentions concerns.",
              "Some willingness to help."
            ],
            "examples": [
              "I've noticed changes and want to help.",
              "Let's discuss your challenges."
            ]
          },
          {
            "value": 4,
            "name": "Strong Recognition",
            "description": "Actively seeks to understand.",
            "criteria": [
              "Directly addresses issues.",
              "Willing to support."
            ],
            "examples": [
              "I'm here to help with your challenges.",
              "Let's talk about how to move forward."
            ]
          },
          {
            "value": 5,
            "name": "Exceptional Support",
            "description": "Demonstrates deep empathy and support.",
            "criteria": [
              "Highly empathetic.",
              "Offers assistance."
            ],
            "examples": [
              "I care about your well-being. Let's work together.",
              "Your challenges matter to me. How can I assist?"
            ]
          }
        ],
        "guidelines": "Assess empathy and recognition over length. Evaluate based on clarity."
      }
    ]
  }
}
TOC;

        return json_decode($json, true);
    }

    public function addItem($id, string $itemText): self
    {
        $this->addToInputArray('items', [
            'id' => $id,
            'item' => $itemText,
        ]);

        return $this;
    }

//    public function addAspectToAvoid($aspect): self
//    {
//        $this->addToInputArray('avoid_aspects', $aspect);
//
//        return $this;
//    }

    public function withRatingsBetween($min, $max): self
    {
        $options = [];
        for ($i = $min; $i <= $max; $i++) {
            $options[] = $i;
        }
        $this->setInputParameter('options', $options);

        return $this;
    }

    public function candidateWasGivenQuestion(string $question): self
    {
        $this->setInputParameter('question', $question);

        return $this;
    }

    public function addExampleOfGoodResponse(string $example): self
    {
        $this->addToInputArray('good_examples', $example);

        return $this;
    }

    public function addExampleOfPoorResponse(string $example): self
    {
        $this->addToInputArray('poor_examples', $example);

        return $this;
    }

    public function addExampleOfModerateResponse(string $example): self
    {
        $this->addToInputArray('moderate_examples', $example);

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'items' => 'required|array',
            'items.*.id' => 'required',
            'items.*.item' => 'required|string',
            'question' => 'required|string',
            'options' => 'required|array|min:2',
           // 'avoid_aspects' => 'required|array|min:1',
            'good_examples' => 'array|min:1',
            'moderate_examples' => 'array|min:1',
            'poor_examples' => 'array|min:1',
        ];
    }

    public function get(): AINinjaScoringGuideCriteriaResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaScoringGuideCriteriaResult
    {
        return parent::stream();
    }
}
