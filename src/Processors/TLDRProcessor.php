<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaTLDRResult;

class TLDRProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/TLDR';
    }

    protected function getResultClass(): string
    {
        return AINinjaTLDRResult::class;
    }

    protected function getMocked(): string
    {
        return "The Data Scientist role involves developing ML models and analytics solutions to impact business outcomes significantly. Responsibilities include managing cloud-based ML pipelines, ensuring data quality, creating predictive models, and collaborating with teams to deploy and monitor these models effectively. Candidates should have a Master's in a related field, 3-5 years of experience, and skills in statistical analysis, programming (SQL, Python, TensorFlow, C/C++), and data visualization. The role demands strong communication, project management, and a proven ability to apply ML and AI in business contexts";
    }

    public function basedOn(string $text): self
    {
        $this->setInputParameter('text', strip_tags($text));

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'text' => 'required|string',
        ];
    }

    public function get(): AINinjaTLDRResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaTLDRResult
    {
        return parent::stream($callback);
    }
}
