<?php
namespace Aplikace\Uloha;

use Aplikace\Interface\UlohaRozhrani;

class TestovaciUloha implements UlohaRozhrani
{
    public function ziskatNazev(): string
    {
        return 'vypis-test-emorfiq';
    }

    public function ziskatCrontab(): string
    {
        return '* * * * *'; // každou minutu
    }

    public function spustitCallback(): void
    {
        echo "Úloha 'vypis-test-emorfiq' spuštěna.\n";
    }
}
