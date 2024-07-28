<?php

declare(strict_types=1);

namespace venndev\vform;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerToggleSneakEvent;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use venndev\vform\forms\BreakForm;
use venndev\vform\forms\JoinForm;
use venndev\vform\forms\PlaceForm;
use venndev\vform\forms\SneakingForm;
use venndev\vformoopapi\attributes\normal\VButton;
use venndev\vformoopapi\VFormLoader;
use Throwable;

final class Main extends PluginBase implements Listener
{
    use SingletonTrait;

    public function onLoad(): void
    {
        self::setInstance($this);
    }

    public function onEnable(): void
    {
        VFormLoader::init($this);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    /**
     * @throws Throwable
     */
    public function onJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();
        JoinForm::getInstance($player)->sendForm();
    }

    /**
     * @throws Throwable
     */
    public function onBreak(BlockBreakEvent $event): void
    {
        $player = $event->getPlayer();
        BreakForm::getInstance($player)->sendForm();
    }

    /**
     * @throws Throwable
     */
    public function onPlace(BlockPlaceEvent $event): void
    {
        $player = $event->getPlayer();
        PlaceForm::getInstance($player)->sendForm();
    }

    /**
     * @throws Throwable
     */
    public function onSneak(PlayerToggleSneakEvent $event): void
    {
        $player = $event->getPlayer();

        $sneakingForm = SneakingForm::getInstance($player);

        // suppose you have data config like this
        $buttons = [
            [
                "text" => "Test Button B",
                "image" => "https://example.com/image.png",
                "cmd" => "say Hello B"
            ],
            [
                "text" => "Test Button C",
                "image" => "https://example.com/image.png",
                "cmd" => "say Hello C"
            ]
        ];

        // add buttons for form available!
        foreach ($buttons as $button) {
            $sneakingForm->addContent(new VButton(
                text: $button["text"],
                image: $button["image"]
            ), function(Player $player, mixed $data) use($button): void {
                $player->sendMessage($button["cmd"]);
            });
        }

        $sneakingForm->sendForm();
    }

}