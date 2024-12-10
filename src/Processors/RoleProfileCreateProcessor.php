<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaRoleProfileResult;

class RoleProfileCreateProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/create_role_profile';
    }

    protected function getResultClass(): string
    {
        return AINinjaRoleProfileResult::class;
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

    public function get(): AINinjaRoleProfileResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaRoleProfileResult
    {
        return parent::stream($callback);
    }

    protected function getMocked(): array
    {
        return [
            'title' => 'Data Scientist',
            'role_profile' => 'The role of the Data Scientist is critical in developing and implementing machine learning models and analytics solutions to significantly influence business decisions. Responsibilities include designing cloud-based ML production pipelines, maintaining data quality, developing predictive models, data acquisition, processing, and performing in-depth analysis. The position requires working closely with cross-functional teams for effective model deployment and monitoring, leading projects that utilize data insights for solving complex business issues, optimizing model performance, and establishing analytics strategies and databases. A stringent framework for model quality testing is also to be maintained.',
        ];
    }
}
