<?php

namespace IanRothmann\AINinja\Processors\Traits;

use IanRothmann\AINinja\Results\AINinjaResult;
use IanRothmann\LangServePhpClient\Responses\RemoteRunnableResponse;
use IanRothmann\LangServePhpClient\Responses\RemoteRunnableStreamResponse;

trait ProcessorResultHandling
{
    protected function createResult($content): AINinjaResult
    {
        $class = $this->getResultClass();

        return new $class($content);
    }

    /**
     * @param  RemoteRunnableResponse|RemoteRunnableStreamResponse  $response
     */
    public function hydrateResult($response): AINinjaResult
    {
        $content = $response->getContent();

        if (is_array($content)) {
            return $this->createResult($content);
        }

        $decoded = json_decode($content, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->createResult($content);
        } else {
            return $this->createResult($decoded);
        }
    }
}
