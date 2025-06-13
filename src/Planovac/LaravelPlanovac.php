<?php
namespace Aplikace\Planovac;

use Illuminate\Support\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Aplikace\Interface\PlanovacRozhrani;
use Aplikace\Interface\UlohaRozhrani;
use Aplikace\Interface\ZamekRozhrani;

class LaravelPlanovac implements PlanovacRozhrani
{
    public function __construct(
        protected Schedule $schedule,
        protected ZamekRozhrani $zamek
    ) {}

    public function naplanuj(UlohaRozhrani $uloha): void
    {
        $this->schedule->call(function () use ($uloha) {
            if (!$this->zamek->ziskat($uloha->ziskatNazev())) {
                return; // zámek aktivní
            }
            $uloha->spustitCallback();
            $this->zamek->uvolnit($uloha->ziskatNazev());
        })->cron($uloha->ziskatCrontab());
    }

    public function spustNaplanovane(): void
    {
        $events = $this->schedule->dueEvents(Carbon::now());

        foreach ($events as $event) {
            $event->run();
        }
    }
}
