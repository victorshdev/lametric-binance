<?php

namespace LaMetric\Response;

interface IFrame
{
    public function getIcon(): string;
    public function setIndex(int $index): static;
    public function getIndex(): int;

    public function toArray(): array;
}