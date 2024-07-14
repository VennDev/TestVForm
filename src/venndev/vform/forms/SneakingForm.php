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
    title: "Sneaking Form",
    type: TypeForm::NORMAL_FORM,
    content: ""
)]
final class SneakingForm extends Form
{

    public function __construct(Player $player)
    {
        parent::__construct($player);
    }

    #[VButton(
        text: "Test Button A",
        image: "https://example.com/image.png",
        label: "Click me!"
    )]
    public function testButton(Player $player, mixed $data): void
    {
        $player->sendMessage("You clicked the test button A!");
    }

    public function onClose(Player $player): void
    {
        $player->sendMessage("You have closed the form");
    }

}