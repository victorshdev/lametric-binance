<?php

namespace LaMetric\Response;

interface IFrame
{
    public function getIcon(): string;

    public function toArray(): array;
}