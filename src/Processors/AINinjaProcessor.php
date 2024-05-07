<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaResult;
use IanRothmann\AINinja\Runners\AINinjaRunner;
use IanRothmann\LangServePhpClient\Responses\RemoteRunnableResponse;
use IanRothmann\LangServePhpClient\Responses\RemoteRunnableStreamResponse;

abstract class AINinjaProcessor
{
    protected $input = [];

    public function __construct()
    {
        if ($this->hasTrait(OutputsInLanguage::class)) {
            $this->input['output_language_name'] = 'English';
            $this->input['output_language_code'] = 'en';
        }
    }

    abstract protected function getEndpoint(): string;

    abstract protected function getResultClass(): string;

    abstract protected function getMocked(): mixed;

    public function get(): mixed
    {
        $runner = new AINinjaRunner();

        return $this->hydrateResult($runner->invoke($this));
    }

    public function stream($callback=null): mixed
    {
        $runner = new AINinjaRunner();

        return $this->hydrateResult($runner->stream($this,$callback));
    }

    protected function createResult($content): AINinjaResult
    {
        $class = $this->getResultClass();

        return new $class($content);
    }

    protected function setInputParameter($key, $value): void
    {
        $this->input[$key] = $value;
    }

    public function toArray(): array
    {
        return [
            'endpoint' => $this->getEndpoint(),
            'input' => $this->input,
            'mocked' => $this->getMocked(),
        ];
    }

    protected function hasTrait($traitName): bool
    {
        $traits = class_uses($this);

        return in_array($traitName, $traits);
    }

    public function hydrateResult(RemoteRunnableResponse|RemoteRunnableStreamResponse $response): AINinjaResult
    {
        $content = $response->getContent();
        $decoded = json_decode($content, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->createResult($content);
        } else {
            return $this->createResult($decoded);
        }
    }

    public function dd()
    {
        dd($this->toArray());
    }
}
