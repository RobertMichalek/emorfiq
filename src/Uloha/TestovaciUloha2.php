<?php
namespace Aplikace\Uloha;

use Aplikace\Interface\UlohaRozhrani;

class TestovaciUloha2 implements UlohaRozhrani
{
    public function ziskatNazev(): string
    {
        return 'vypis-test-emorfiq-2';
    }

    public function ziskatCrontab(): string
    {
        return '* * * * *'; // každou minutu
    }

    public function spustitCallback(): void
    {
        echo "Úloha 'vypis-test-emorfiq-2' spuštěna.\n";
    }
}
