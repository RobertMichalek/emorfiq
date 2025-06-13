<?php
namespace Aplikace\Interface;

use Aplikace\Interface\UlohaRozhrani;

interface PlanovacRozhrani
{
    public function naplanuj(UlohaRozhrani $uloha): void;

    public function spustNaplanovane(): void;
}
