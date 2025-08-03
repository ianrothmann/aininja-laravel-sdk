<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use IanRothmann\AINinja\Processors\Traits\ProcessorInputHandling;
use IanRothmann\AINinja\Processors\Traits\ProcessorTraceHandling;
use IanRothmann\AINinja\Runners\AINinjaRunner;

abstract class AINinjaAgent
{
    use ProcessorInputHandling;
    use ProcessorTraceHandling;

    public function __construct() {}

    abstract protected function getEndpoint(): string;

    abstract public function getResultClass(): string;

    abstract public function getMocked();

    public function run(): AINinjaAgentRun
    {
        $shouldMock = config('aininja.should_mock');
        if ($shouldMock) {
            return new AINinjaAgentRun(static::class, 'test', 'test', $this->getMocked());
        }

        $runner = new AINinjaRunner(true);
        $rawResult = $runner->invoke($this->toArray())->getContent();

        return new AINinjaAgentRun(static::class, $rawResult['thread_id'], $rawResult['run_id']);
    }

    public function runAndWait($waitIntervalSeconds = 10): AINinjaRunResult
    {
        $run = $this->run();

        if (! $waitIntervalSeconds) {
            $waitIntervalSeconds = 10;
        }

        $tries = 0;
        $maxTries = 5000 / $waitIntervalSeconds;

        do {
            sleep($waitIntervalSeconds);
            $runResult = $run->check();
        } while ($tries++ < $maxTries && $runResult->isPending());

        return $runResult;
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaRunResult
    {
        return $run->check();
    }

    public function toArray(): array
    {
        $this->validate();

        return [
            'endpoint' => $this->getEndpoint(),
            'input' => $this->transformInputForTransport(),
            'mocked' => [
                'run_id' => 'test',
                'thread_id' => 'test',
            ],
            'trace_id' => $this->traceId,
        ];
    }

    public function dd(): self
    {
        dd($this->toArray());

        return $this;
    }
}
