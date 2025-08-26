<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentNewsGeneratorResult;
use Illuminate\Support\Carbon;

class NewsGeneratorAgent extends AINinjaAgent
{
    protected function getEndpoint(): string
    {
        return '/agent_news_generator';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentNewsGeneratorResult::class;
    }

    public function getMocked(): array
    {
        return [
            'topics' => [
                [
                    'title' => 'Global Economic Growth Forecast Revisions',
                    'summary' => 'S&P Global has revised its 2025 real GDP growth forecasts upward for major economies like the US, Canada, eurozone, UK, and China, while downgrading India and Brazil due to increased US tariffs.',
                ],
                [
                    'title' => 'Federal Reserve Signals Potential Interest Rate Cuts',
                    'summary' => 'Federal Reserve Chair Jerome Powell has indicated the possibility of interest rate cuts starting in September 2025, with futures markets predicting a 25 basis point cut, influenced by inflation and employment data.',
                ],
                [
                    'title' => 'Technology Sector Innovation Trends',
                    'summary' => 'Leading technology companies are investing heavily in artificial intelligence and quantum computing research, with significant breakthroughs expected in the coming quarters.',
                ],
            ],
        ];
    }

    public function withContext(string $context): self
    {
        $this->setInputParameter('context', strip_tags($context));

        return $this;
    }

    public function withRecencyFilter(Carbon $recencyFilter): self
    {
        $this->setInputParameter('recency_filter', $recencyFilter->format('d/m/Y'));

        return $this;
    }

    protected function transformInputForTransport(): array
    {
        return $this->input;
    }

    protected function getValidationRules(): array
    {
        return [
            'context' => 'required|string',
            'recency_filter' => 'nullable|string',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentNewsGeneratorResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentNewsGeneratorResult
    {
        return parent::retrieveRunResult($run);
    }
}
