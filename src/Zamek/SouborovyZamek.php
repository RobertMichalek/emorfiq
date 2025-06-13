<?php

namespace Aplikace\Zamek;

use Aplikace\Interface\ZamekRozhrani;

class SouborovyZamek implements ZamekRozhrani
{
    protected string $adresar;
    /** @var array<string, resource> */
    protected array $otevreneZamky = [];

    public function __construct(string $adresar = __DIR__ . '/../../zamky')
    {
        $this->adresar = rtrim($adresar, '/');
        if (!is_dir($this->adresar)) {
            mkdir($this->adresar, 0777, true);
        }
    }

    public function ziskat(string $klic): bool
    {
        $soubor = $this->adresar . '/' . $klic . '.lock';
        $fp = fopen($soubor, 'c');
        if ($fp === false) {
            return false;
        }

        if (flock($fp, LOCK_EX | LOCK_NB)) {
            $this->otevreneZamky[$klic] = $fp;
            return true;
        }

        fclose($fp);
        return false;
    }

    public function uvolnit(string $klic): void
    {
        if (!isset($this->otevreneZamky[$klic])) {
            return;
        }

        $fp = $this->otevreneZamky[$klic];
        flock($fp, LOCK_UN);
        fclose($fp);

        $soubor = $this->adresar . '/' . $klic . '.lock';
        if (file_exists($soubor)) {
            @unlink($soubor);
        }

        unset($this->otevreneZamky[$klic]);
    }
}
