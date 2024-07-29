<?php

declare(strict_types=1);

namespace venndev\vform\forms;

use pocketmine\player\Player;
use venndev\vform\results\GetString;
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

    public static string $aa = "aa";

    public function __construct(Player $player)
    {
        parent::__construct($player);
        $this->setContent("Welcome to the server!");
    }

    #[VButton(
        text: new GetString("Test Button //player"),
        image: "https://raw.githubusercontent.com/GabBiswajit/ImageLoader/1c841d8c0cb80bf4d1adb28a4860f7dd7ac123e5/icon.png",
        label: "Click me!"
    )]
    public function testButton(Player $player, mixed $data): void
    {
        $player->sendMessage("You clicked the test button!");
    }

    protected function onClose(Player $player): void
    {
        $player->sendMessage("You have closed the form");
    }

    // This method is called when the form is submitted
    protected function onCompletion(Player $player, mixed $data): void
    {
        // TODO: Implement onCompletion() method.
    }

}