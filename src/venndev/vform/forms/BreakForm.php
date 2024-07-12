<?php

declare(strict_types=1);

namespace venndev\vform\forms;

use pocketmine\player\Player;
use venndev\vformoopapi\attributes\modal\VButton;
use venndev\vformoopapi\attributes\VForm;
use venndev\vformoopapi\Form;
use venndev\vformoopapi\utils\TypeForm;

#[VForm(
    title: "Break Form",
    type: TypeForm::MODAL_FORM,
    content: ""
)]
final class BreakForm extends Form
{

    public function __construct(Player $player)
    {
        parent::__construct($player);
    }

    #[VButton(
        text: "Test Button A"
    )]
    public function buttonA(Player $player, mixed $data): void
    {
        $player->sendMessage("You clicked the test button A!");
    }

    #[VButton(
        text: "Test Button B"
    )]
    public function buttonB(Player $player, mixed $data): void
    {
        $player->sendMessage("You clicked the test button B!");
    }

    public function onClose(Player $player): void
    {
        $player->sendMessage("You have closed the form");
    }

}