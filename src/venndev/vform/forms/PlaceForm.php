<?php

declare(strict_types=1);

namespace venndev\vform\forms;

use pocketmine\player\Player;
use venndev\vform\Main;
use venndev\vformoopapi\attributes\custom\VDropDown;
use venndev\vformoopapi\attributes\custom\VInput;
use venndev\vformoopapi\attributes\custom\VLabel;
use venndev\vformoopapi\attributes\custom\VSlider;
use venndev\vformoopapi\attributes\custom\VStepSlider;
use venndev\vformoopapi\attributes\custom\VToggle;
use venndev\vformoopapi\attributes\VForm;
use venndev\vformoopapi\Form;
use venndev\vformoopapi\utils\TypeForm;

#[VForm(
    title: "Place Form",
    type: TypeForm::CUSTOM_FORM,
    content: ""
)]
final class PlaceForm extends Form
{

    public function __construct(Player $player)
    {
        parent::__construct(
            player: $player,
            middleWare: function () {
                $players = Main::getInstance()->getServer()->getOnlinePlayers();
                $playersName = [];
                foreach ($players as $player) $playersName[] = $player->getName();
                $this->setIndexContent(1, ["options" => $playersName]); // It is `Test DropDown`
            }
        );
    }

    #[VInput(
        text: "Test Input",
        placeholder: "Input your text here",
    )]
    public function input(Player $player, mixed $data): void
    {
        $player->sendMessage("You have inputted: " . $data);
    }

    #[VDropDown(
        text: "Test DropDown",
        options: ["Option 1", "Option 2", "Option 3"],
    )]
    public function dropDown(Player $player, mixed $data): void
    {
        $player->sendMessage("DropDown: You have selected: " . $data);
    }

    #[VLabel(
        text: "Test Label"
    )]
    public function label(Player $player, mixed $data): void
    {
        $player->sendMessage("You have clicked the label");
    }

    #[VSlider(
        text: "Test Slider",
        min: 0,
        max: 100,
        step: 1
    )]
    public function slider(Player $player, mixed $data): void
    {
        $player->sendMessage("Slider: You have selected: " . $data);
    }

    #[VStepSlider(
        text: "Test StepSlider",
        steps: ["Step 1", "Step 2", "Step 3", "Step 4", "Step 5"]
    )]
    public function stepSlider(Player $player, mixed $data): void
    {
        $player->sendMessage("StepSlider: You have selected: " . $data);
    }

    #[VToggle(
        text: "Test StepSlider",
        default: true
    )]
    public function toggle(Player $player, mixed $data): void
    {
        $player->sendMessage("Toggle: You have selected: " . ($data ? "true" : "false"));
    }

    public function onClose(Player $player): void
    {
        $player->sendMessage("You have closed the form");
    }

}
