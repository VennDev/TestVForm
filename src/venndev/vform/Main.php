<?php

declare(strict_types=1);

namespace venndev\vform;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use Throwable;
use venndev\vform\forms\BreakForm;
use venndev\vform\forms\JoinForm;
use venndev\vform\forms\PlaceForm;
use vennv\vapm\VapmPMMP;

final class Main extends PluginBase implements Listener
{
    use SingletonTrait;

    public function onLoad(): void
    {
        self::setInstance($this);
    }

    public function onEnable(): void
    {
        VapmPMMP::init($this);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    /**
     * @throws Throwable
     */
    public function onJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();
        JoinForm::send($player);
    }

    /**
     * @throws Throwable
     */
    public function onBreak(BlockBreakEvent $event): void
    {
        $player = $event->getPlayer();
        BreakForm::send($player);
    }

    /**
     * @throws Throwable
     */
    public function onPlace(BlockPlaceEvent $event): void
    {
        $player = $event->getPlayer();
        PlaceForm::send($player);
    }

}