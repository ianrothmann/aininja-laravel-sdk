<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaTechnicalCompetencyQuestionResult;

class TechnicalCompetencyQuestionProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/technical_competency_question_generator';
    }

    protected function getResultClass(): string
    {
        return AINinjaTechnicalCompetencyQuestionResult::class;
    }

    protected function getMocked(): array
    {
        $content = <<<'TOC'
{
  "questions": [
    {
      "question_text": "What is the primary goal of innovation management within a financial institution?",
      "difficulty": "easy",
      "options": [
        {
          "option_text": "Encourage and implement novel solutions that add value to the organization",
          "correct": true
        },
        {
          "option_text": "Eliminate every existing process",
          "correct": false
        },
        {
          "option_text": "Only purchase the latest hardware regardless of need",
          "correct": false
        },
        {
          "option_text": "Outsource all functions to vendors",
          "correct": false
        }
      ]
    },
    {
      "question_text": "During the rollout of a new digital payment platform, which tactic best addresses stakeholder concerns and builds support?",
      "difficulty": "medium",
      "options": [
        {
          "option_text": "Holding interactive town-hall sessions to solicit feedback",
          "correct": true
        },
        {
          "option_text": "Issuing a one-time email filled with technical jargon",
          "correct": false
        },
        {
          "option_text": "Limiting information to senior managers only",
          "correct": false
        },
        {
          "option_text": "Waiting until after go-live to disclose details",
          "correct": false
        }
      ]
    },
    {
      "question_text": "An organization plans concurrent rollouts of an open-banking API and a real-time settlement upgrade. To minimize change fatigue, which scheduling approach aligns with portfolio management best practice?",
      "difficulty": "hard",
      "options": [
        {
          "option_text": "Stagger the initiatives so that the high-impact phases do not overlap",
          "correct": true
        },
        {
          "option_text": "Launch all changes on the same date to create a single disruption window",
          "correct": false
        },
        {
          "option_text": "Delay both projects indefinitely until no objections are raised",
          "correct": false
        },
        {
          "option_text": "Randomly sequence activities without assessing resource capacity",
          "correct": false
        }
      ]
    }
  ]
}
TOC;

        return json_decode($content, true);
    }

    public function inContextOf(string $text): self
    {
        $this->setInputParameter('context', strip_tags($text));

        return $this;
    }

    public function forAudience(string $text): self
    {
        $this->setInputParameter('audience', strip_tags($text));

        return $this;
    }

    public function forCompetency(string $name, string $description): self
    {
        $this->setInputParameter('competency_name', strip_tags($name));
        $this->setInputParameter('competency_description', strip_tags($description));

        return $this;
    }

    public function numberOfQuestions(int $numEasy = 3, int $numMedium = 4, int $numHard = 3): self
    {
        $this->setInputParameter('num_easy', $numEasy);
        $this->setInputParameter('num_medium', $numMedium);
        $this->setInputParameter('num_hard', $numHard);

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'audience' => 'required|string',
            'context' => 'required|string',
            'competency_name' => 'required|string',
            'competency_description' => 'required|string',
            'num_easy' => 'required|integer|min:1',
            'num_medium' => 'required|integer|min:1',
            'num_hard' => 'required|integer|min:1',
        ];
    }

    public function get(): AINinjaTechnicalCompetencyQuestionResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaTechnicalCompetencyQuestionResult
    {
        return parent::stream($callback);
    }
}
