<?php

declare(strict_types=1);

namespace LaMetric\Response;

class GoalFrame implements IFrame
{
    /**
     * @var string
     */
    private string $icon = '';

    private float $start = 0.0;
    private float $end = 0.0;
    private int $current = 0;
    private string $unit = '%';
    private int $index = 0;

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): GoalFrame
    {
        $this->icon = $icon;
        return $this;
    }

    public function getStart(): float
    {
        return $this->start;
    }

    public function setStart(float $start): GoalFrame
    {
        $this->start = $start;
        return $this;
    }

    public function getEnd(): float
    {
        return $this->end;
    }

    public function setEnd(float $end): GoalFrame
    {
        $this->end = $end;
        return $this;
    }

    public function getCurrent(): int
    {
        return $this->current;
    }

    public function setCurrent(int $current): GoalFrame
    {
        $this->current = $current;
        return $this;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): GoalFrame
    {
        $this->unit = $unit;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'icon' => $this->getIcon(),
            'index' => $this->getIndex(),
            'goalData' => [
                'start' => $this->getStart(),
                'end' => $this->getEnd(),
                'current' => $this->getCurrent(),
                'unit' => $this->getUnit()
            ],
        ];
    }

    public function setIndex(int $index): static
    {
        $this->index = $index;
        return $this;
    }

    public function getIndex(): int
    {
        return $this->index;
    }
}
