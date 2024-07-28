<?php

declare(strict_types=1);

namespace venndev\vform\forms;

use pocketmine\player\Player;
use venndev\vformoopapi\attributes\normal\VButton;
use venndev\vformoopapi\attributes\VForm;
use venndev\vformoopapi\Form;
use venndev\vformoopapi\utils\ImageType;
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
        image: "https://raw.githubusercontent.com/GabBiswajit/ImageLoader/1c841d8c0cb80bf4d1adb28a4860f7dd7ac123e5/icon.png",
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