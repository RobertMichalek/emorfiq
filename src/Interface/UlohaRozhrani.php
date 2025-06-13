<?php
namespace Aplikace\Interface;

interface UlohaRozhrani
{
    public function ziskatNazev(): string;

    public function ziskatCrontab(): string;

    public function spustitCallback(): void;
}
