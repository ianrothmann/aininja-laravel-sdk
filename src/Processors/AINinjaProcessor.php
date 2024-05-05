<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaResult;
use IanRothmann\AINinja\Runners\AINinjaRunner;
use IanRothmann\LangServePhpClient\Responses\RemoteRunnableResponse;
use IanRothmann\LangServePhpClient\Responses\RemoteRunnableStreamResponse;

abstract class AINinjaProcessor
{
    protected $input = [];

    abstract protected function getEndpoint(): string;

    abstract protected function getMocked(): mixed;

    abstract protected function getResultClass(): string;

    public function get(): AINinjaResult
    {
        $runner = new AINinjaRunner();
        return $this->hydrateResult($runner->invoke($this));
    }

    protected function createResult($content): AINinjaResult
    {
        $class=$this->getResultClass();
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
            'mocked' => $this->getMocked()
        ];
    }

    public function hydrateResult(RemoteRunnableResponse|RemoteRunnableStreamResponse $response): AINinjaResult
    {
        $content = $response->getContent();
        $decoded = json_decode($content, true);
        if(json_last_error() !== JSON_ERROR_NONE){
            return $this->createResult($content);
        }else{
            return $this->createResult($decoded);
        }
    }
}
