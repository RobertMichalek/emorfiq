<?php
namespace Aplikace\Interface;

interface ZamekRozhrani
{
    public function ziskat(string $klic): bool;

    public function uvolnit(string $klic): void;
}
