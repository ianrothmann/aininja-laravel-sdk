<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaRefineConversationSummaryResult;

class RefineConversationSummaryProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/refine_conversation_summary';
    }

    protected function getResultClass(): string
    {
        return AINinjaRefineConversationSummaryResult::class;
    }

    protected function getMocked(): string
    {
        return 'Ian wants to order a large pizza with pepperoni and is interacting with a bot for assistance. The bot confirms his order will be ready in 30 minutes.';
    }

    public function basedOn($content): self
    {
        if (is_array($content)) {
            $content = json_encode($content);
        }

        $this->setInputParameter('text', $content);

        return $this;
    }

    public function withPreviousSummary(string $summary): self
    {
        $this->setInputParameter('previous_summary', $summary);

        return $this;
    }

    public function get(): AINinjaRefineConversationSummaryResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaRefineConversationSummaryResult
    {
        return parent::stream($callback);
    }
}
