<?php

namespace Aplikace\Planovac;

use Crunz\Schedule as CrunzSchedule;
use Aplikace\Interface\PlanovacRozhrani;
use Aplikace\Interface\UlohaRozhrani;
use Aplikace\Interface\ZamekRozhrani;

class CrunzPlanovac implements PlanovacRozhrani
{
    protected array $ulohy = [];

    public function __construct(
        protected ZamekRozhrani $zamek
    ) {}

    public function naplanuj(UlohaRozhrani $uloha): void
    {
        $this->ulohy[] = $uloha;
    }

    public function spustNaplanovane(): void
    {
        foreach ($this->ulohy as $uloha) {
            if (!$this->zamek->ziskat($uloha->ziskatNazev())) {
                continue;
            }

            $schedule = new CrunzSchedule();
            $event = $schedule->run(fn() => $uloha->spustitCallback());
            $event->cron($uloha->ziskatCrontab());

            $dueEvents = $schedule->dueEvents(new \DateTimeZone(date_default_timezone_get()));

            foreach ($dueEvents as $dueEvent) {
                $uloha->spustitCallback();
            }

            $this->zamek->uvolnit($uloha->ziskatNazev());
        }
    }
}
