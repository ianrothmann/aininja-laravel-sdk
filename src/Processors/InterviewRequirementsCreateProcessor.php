<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaInterviewRequirementsResult;

class InterviewRequirementsCreateProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/create_interview_requirements';
    }

    protected function getResultClass(): string
    {
        return AINinjaInterviewRequirementsResult::class;
    }

    public function basedOn(string $text): self
    {
        $this->setInputParameter('text', $text);

        return $this;
    }

    public function getValidationRules(): array
    {
        return [
            'text' => 'required|string',
        ];
    }

    public function get(): AINinjaInterviewRequirementsResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaInterviewRequirementsResult
    {
        return parent::stream($callback);
    }

    protected function getMocked(): array
    {
        return [
            'title' => 'Data Scientist',
            'summary' => 'The role of the Data Scientist is critical in developing and implementing machine learning models and analytics solutions to significantly influence business decisions. Responsibilities include designing cloud-based ML production pipelines, maintaining data quality, developing predictive models, data acquisition, processing, and performing in-depth analysis. The position requires working closely with cross-functional teams for effective model deployment and monitoring, leading projects that utilize data insights for solving complex business issues, optimizing model performance, and establishing analytics strategies and databases. A stringent framework for model quality testing is also to be maintained.',
            'requirements' => 'Proficiency in statistical analysis, quantitative analytics, and optimization algorithms; Experience with ML frameworks and libraries; Strong programming skills in SQL, Python, TensorFlow, and C/C++; Familiarity with distributed data/computing tools; Expertise in data visualization tools; Excellent communication skills; Dedication to continuous learning; Ability to excel in a fast-paced environment; Strong project management and organizational skills; Understanding of design principles and data architecture; Proven track record of applying ML and AI to drive business results',
        ];
    }
}
