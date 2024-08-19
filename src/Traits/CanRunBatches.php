<?php

namespace IanRothmann\AINinja\Traits;

use IanRothmann\AINinja\Processors\AINinjaProcessor;
use IanRothmann\AINinja\Runners\AINinjaRunner;
use IanRothmann\LangServePhpClient\Responses\RemoteRunnableResponse;
use Illuminate\Support\Collection;

trait CanRunBatches
{
    public function batch($processors, $forceNoCache = false): Collection
    {
        foreach ($processors as $processor) {
            if (! $processor instanceof AINinjaProcessor) {
                throw new \Exception('The processor must be an instance of AINinjaProcessor');
            }
        }

        if ($processors instanceof Collection) {
            $processors = $processors->toArray();
        }

        if (count($processors) == 0) {
            return collect();
        }

        $templateProcessor = $processors[0];

        $runner = new AINinjaRunner($forceNoCache);

        return collect($runner->batch($processors)
            ->getResponses())
            ->map(function (RemoteRunnableResponse $response) use ($templateProcessor) {
                return $templateProcessor->hydrateResult($response);
            });
    }

    /**
     * @param array|Collection $processors
     * @return Collection
     * @throws \Exception
     */
    public function pool($processors): Collection
    {
        foreach ($processors as $processor) {
            if (! $processor instanceof AINinjaProcessor) {
                throw new \Exception('The processor must be an instance of AINinjaProcessor');
            }
        }

        if ($processors instanceof Collection) {
            $processors = $processors->toArray();
        }

        if (count($processors) == 0) {
            return collect();
        }

        $runner = new AINinjaRunner;

        return collect($runner->invokeAsyncAndWait($processors))->map(function (RemoteRunnableResponse $response, $key) use ($processors) {
            return $processors[$key]->hydrateResult($response);
        });
    }
}
