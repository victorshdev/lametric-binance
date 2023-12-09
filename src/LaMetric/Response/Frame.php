<?php

declare(strict_types=1);

namespace LaMetric\Response;

class Frame
{
    /**
     * @var string
     */
    private string $icon = '';

    private float $start = 0.0;
    private float $end = 0.0;
    private int $current = 0;
    private string $unit = '$';

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): Frame
    {
        $this->icon = $icon;
        return $this;
    }

    public function getStart(): float
    {
        return $this->start;
    }

    public function setStart(float $start): Frame
    {
        $this->start = $start;
        return $this;
    }

    public function getEnd(): float
    {
        return $this->end;
    }

    public function setEnd(float $end): Frame
    {
        $this->end = $end;
        return $this;
    }

    public function getCurrent(): int
    {
        return $this->current;
    }

    public function setCurrent(int $current): Frame
    {
        $this->current = $current;
        return $this;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): Frame
    {
        $this->unit = $unit;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'icon' => $this->getIcon(),
            'goalData' => [
                'start' => $this->getStart(),
                'end' => $this->getEnd(),
                'current' => $this->getCurrent(),
                'unit' => $this->getUnit()
            ],
        ];
    }
}
