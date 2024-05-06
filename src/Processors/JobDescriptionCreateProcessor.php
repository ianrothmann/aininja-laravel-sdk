<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaJobDescriptionResult;

class JobDescriptionCreateProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return 'create_job_description';
    }

    protected function getResultClass(): string
    {
        return AINinjaJobDescriptionResult::class;
    }

    public function basedOn(string $text): self
    {
        $this->setInputParameter('text', $text);

        return $this;
    }

    public function get(): AINinjaJobDescriptionResult
    {
        return parent::get();
    }

    protected function getMocked(): array
    {
        return [
            'title' => 'Data Scientist',
            'summary' => 'The role of the Data Scientist is critical in developing and implementing machine learning models and analytics solutions to significantly influence business decisions. Responsibilities include designing cloud-based ML production pipelines, maintaining data quality, developing predictive models, data acquisition, processing, and performing in-depth analysis. The position requires working closely with cross-functional teams for effective model deployment and monitoring, leading projects that utilize data insights for solving complex business issues, optimizing model performance, and establishing analytics strategies and databases. A stringent framework for model quality testing is also to be maintained.',
            'requirements_education' => "Master's degree in Computer Science, Statistics, Applied Math, or related field",
            'requirements_experience' => '3-5 years of experience in data manipulation and statistical model building',
            'requirements_skills' => 'Proficiency in statistical analysis, quantitative analytics, and optimization algorithms; Experience with ML frameworks and libraries; Strong programming skills in SQL, Python, TensorFlow, and C/C++; Familiarity with distributed data/computing tools; Expertise in data visualization tools; Excellent communication skills; Dedication to continuous learning; Ability to excel in a fast-paced environment; Strong project management and organizational skills; Understanding of design principles and data architecture; Proven track record of applying ML and AI to drive business results',
            'requirements_other' => 'N/A',
        ];
    }
}
