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
    "anchors": [
      {
        "title": "Not Evident",
        "value": 1,
        "description": "The candidate does not propose any technological solutions."
      },
      {
        "title": "General Mention",
        "value": 2,
        "description": "The candidate mentions technology but without specifics.",
        "prerequisites": [
          {
            "question": "Does the candidate mention technology?",
            "definitions": "The candidate references technology vaguely, like improving efficiency or streamlining processes, but without specific tools."
          }
        ]
      },
      {
        "title": "Specific Innovative Proposal",
        "value": 3,
        "description": "The candidate proposes one specific technological solution for the business.",
        "prerequisites": [
          {
            "question": "Does the candidate propose a specific solution?",
            "definitions": "The candidate suggests a clear tool, like a CRM system or cloud accounting software."
          },
          {
            "question": "Is the solution innovative?",
            "definitions": "The candidate mentions cutting-edge tools like AI or IoT."
          },
          {
            "question": "Is it relevant to Tom's business?",
            "definitions": "The solution improves Tom's operations, like automating processes or improving customer engagement."
          }
        ]
      },
      {
        "title": "Multiple Innovative Proposals",
        "value": 4,
        "description": "The candidate proposes two or more specific technological solutions.",
        "prerequisites": [
          {
            "question": "Does the candidate propose multiple solutions?",
            "definitions": "The candidate suggests at least two tools, like CRM and cloud storage."
          },
          {
            "question": "Are they innovative?",
            "definitions": "Both solutions involve emerging technologies like AI or machine learning."
          },
          {
            "question": "Are they relevant?",
            "definitions": "Each solution enhances Tom's processes, customer engagement, or data management."
          }
        ]
      },
      {
        "title": "Detailed Insightful Proposals",
        "value": 5,
        "description": "The candidate provides detailed benefits for multiple technological solutions.",
        "prerequisites": [
          {
            "question": "Does the candidate propose multiple solutions?",
            "definitions": "The candidate suggests two or more tools, like CRM and AI chatbots."
          },
          {
            "question": "Are they innovative?",
            "definitions": "Each solution includes innovative technology like AI or AR."
          },
          {
            "question": "Does the candidate explain the benefits?",
            "definitions": "The candidate explains how each tool improves business, like enhancing customer service or automating processes."
          }
        ]
      }
    ]
  }
}

TOC;

        return json_decode($json,true);
    }

    public function forItem(string $itemText): self
    {
        $this->setInputParameter('item', $itemText);

        return $this;
    }

    public function addAspectToAvoid($aspect): self
    {
        $this->addToInputArray('avoid_aspects', $aspect);

        return $this;
    }

    public function withRatingsBetween($min, $max): self
    {
        $options = [];
        for($i=$min; $i<=$max; $i++){
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
            'item' => 'required|string',
            'question' => 'required|string',
            'options' => 'required|array|min:2',
            'avoid_aspects' => 'required|array|min:1',
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
