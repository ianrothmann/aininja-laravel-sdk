<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Processors\Traits\ProcessorInputHandling;
use IanRothmann\AINinja\Processors\Traits\ProcessorResultHandling;
use IanRothmann\AINinja\Processors\Traits\ProcessorTraceHandling;
use IanRothmann\AINinja\Processors\Traits\ProcessorTraitDetection;
use IanRothmann\AINinja\Runners\AINinjaRunner;

abstract class AINinjaProcessor
{
    use ProcessorInputHandling;
    use ProcessorResultHandling;
    use ProcessorTraceHandling;
    use ProcessorTraitDetection;

    protected $forceNoCache = false;

    public function __construct()
    {
        if ($this->hasTrait(OutputsInLanguage::class)) {
            $this->input['output_language_name'] = 'English';
            $this->input['output_language_code'] = 'en';
        }
    }

    abstract protected function getEndpoint(): string;

    abstract protected function getResultClass(): string;

    abstract protected function getMocked();

    public function forceNoCache($force = true): self
    {
        $this->forceNoCache = $force;

        return $this;
    }

    public function get()
    {
        $runner = new AINinjaRunner($this->forceNoCache);

        return $this->hydrateResult($runner->invoke($this->toArray()));
    }

    public function stream($callback = null)
    {
        $runner = new AINinjaRunner($this->forceNoCache);

        return $this->hydrateResult($runner->stream($this, $callback));
    }

    public function dd()
    {
        dd($this->toArray());
    }

    public function toArray(): array
    {
        $this->validate();

        return [
            'endpoint' => $this->getEndpoint(),
            'input' => $this->transformInputForTransport(),
            'mocked' => $this->getMocked(),
            'trace_id' => $this->traceId,
        ];
    }
}
