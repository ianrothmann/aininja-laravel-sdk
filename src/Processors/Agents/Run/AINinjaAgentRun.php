<?php

namespace IanRothmann\AINinja\Processors\Agents\Run;

use IanRothmann\AINinja\Processors\Agents\AINinjaAgent;
use IanRothmann\AINinja\Runners\AINinjaRunner;

class AINinjaAgentRun
{
    protected $agentType;

    protected $threadId;

    protected $runId;

    protected $mocked;

    public function __construct($agentType, $threadId, $runId, $mocked = null)
    {
        $this->agentType = $agentType;
        $this->threadId = $threadId;
        $this->runId = $runId;
        $this->mocked = $mocked;
    }

    public function check(): AINinjaRunResult
    {
        if ($this->mocked) {
            return $this->createResultObject([
                'status' => 'success',
                'response' => $this->mocked,
            ]);
        }

        $runner = new AINinjaRunner;

        $content = $runner->invoke([
            'endpoint' => '/agent_result',
            'input' => [
                'thread_id' => $this->threadId,
                'run_id' => $this->runId,
            ],
        ])->getContent();

        return $this->createResultObject($content);
    }

    protected function createResultObject($content): AINinjaRunResult
    {
        $class = $this->agentType;
        /**
         * @var AINinjaAgent $obj
         */
        $obj = new $class;
        $resultClass = $obj->getResultClass();

        return new $resultClass($content);
    }

    public function toArray(): array
    {
        return [
            'agent_type' => $this->agentType,
            'thread_id' => $this->threadId,
            'run_id' => $this->runId,
            'mocked' => $this->mocked,
        ];
    }

    public static function fromArray($array): self
    {
        return new self($array['agent_type'], $array['thread_id'], $array['run_id'], $array['mocked'] ?? null);
    }
}
