<?php

declare(strict_types=1);

namespace venndev\vform\forms;

use pocketmine\player\Player;
use venndev\vformoopapi\attributes\normal\VButton;
use venndev\vformoopapi\attributes\VForm;
use venndev\vformoopapi\Form;
use venndev\vformoopapi\utils\TypeForm;

#[VForm(
    title: "Join Form",
    type: TypeForm::NORMAL_FORM,
    content: ""
)]
final class JoinForm extends Form
{

    public function __construct(Player $player)
    {
        parent::__construct($player);
        $this->setContent("Welcome to the server!");
    }

    #[VButton(
        text: "Test Button //player",
        image: "https://i.pinimg.com/736x/ee/28/3a/ee283a1348a90c6db74c2937493fce74.jpg",
        label: "Click me!"
    )]
    public function testButton(Player $player, mixed $data): void
    {
        $player->sendMessage("You clicked the test button!");
    }

    public function onClose(Player $player): void
    {
        $player->sendMessage("You have closed the form");
    }

}
