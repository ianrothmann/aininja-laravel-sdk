<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaImageDescribeResult;

class ImageDescribeProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/describe_image';
    }

    protected function getResultClass(): string
    {
        return AINinjaImageDescribeResult::class;
    }

    protected function getMocked()
    {
        return [
            'description' => 'This image captures a triumphant moment for a rugby team, celebrating their victory in what appears to be an important tournament, indicated by their joy in lifting a significant trophy — likely from a major event such as the Rugby World Cup. The team is surrounded by confetti, enhancing the festive atmosphere of their achievement. The players are visibly elated, with some raising their fists in victory, and others smiling broadly or cheering. The scene is filled with a sense of camaraderie and shared accomplishment among the team members.',
            'complement' => 'This team exemplifies resilience and unity in achieving their goals. Their ability to work together under pressure and come out as champions is truly inspiring. Congratulations on a well-deserved victory!',
        ];
    }

    public function forUrl(string $url): self
    {
        $this->setInputParameter('url', $url);

        return $this;
    }

    public function whereContext(string $context): self
    {
        $this->setInputParameter('context', $context);

        return $this;
    }

    public function getValidationRules(): array
    {
        return [
            'url' => 'required|url',
            'context' => 'required|string',
        ];
    }

    public function get(): AINinjaImageDescribeResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaImageDescribeResult
    {
        return parent::stream($callback);
    }
}
