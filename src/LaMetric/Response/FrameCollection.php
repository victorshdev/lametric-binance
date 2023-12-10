<?php

declare(strict_types=1);

namespace LaMetric\Response;

class FrameCollection
{
    /**
     * @var array
     */
    private array $frames = [];

    /**
     * @param Frame $frame
     */
    public function addFrame(IFrame $frame): void
    {
        $this->frames[] = $frame->setIndex(count($this->frames));
    }

    /**
     * @return array
     */
    public function getFrames(): array
    {
        return $this->frames;
    }
}
