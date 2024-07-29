<?php

declare(strict_types=1);

namespace venndev\vform;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerJumpEvent;
use pocketmine\event\player\PlayerToggleSneakEvent;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use venndev\vform\forms\BreakForm;
use venndev\vform\forms\JoinForm;
use venndev\vform\forms\PlaceForm;
use venndev\vform\forms\SneakingForm;
use venndev\vformoopapi\attributes\normal\VButton;
use venndev\vformoopapi\FormSample;
use venndev\vformoopapi\utils\TypeForm;
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
        $sneakingForm->setTitle("Sneaking Form Edited!");
        $sneakingForm->setContent("This is a sneaking form has Edited!");

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

        $sneakingForm->setFormClose(function(Player $player): void {
            $player->sendMessage("You closed the sneaking form!");
        });

        $sneakingForm->setFormSubmit(function(Player $player, mixed $data): void {
            $player->sendMessage("You submitted the sneaking form!");
        });

        $sneakingForm->sendForm();
    }

    /**
     * @throws Throwable
     */
    public function onJump(PlayerJumpEvent $event): void
    {
        $player = $event->getPlayer();
        $formJump = FormSample::getInstance($player);

        // Default form type is TypeForm::MODAL, if you want to change it, you can use setType() method
        $formJump->setTitle("Jump Form");
        $formJump->setContent("You are jumping!");
        $formJump->addContent(new VButton(
            text: "Jump Button",
            image: "https://example.com/image.png"
        ), function(Player $player, mixed $data): void {
            $player->sendMessage("You clicked the jump button!");
        });
        $formJump->sendForm();
    }

}