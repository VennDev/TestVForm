<?php

declare(strict_types=1);

namespace venndev\vform\forms;

use pocketmine\player\Player;
use Throwable;
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
use vennv\vapm\Async;
use vennv\vapm\Promise;

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

                // It is `Test DropDown` index
                // If you have set 'label' index, you can use $this->setIndexContent('labelName', ["options" => $playersName]);
                $this->setIndexContent(3, ["options" => $playersName]);
            }
        );
    }

    /**
     * @throws Throwable
     *
     * This is an example of how to use Async
     */
    #[VToggle(
        text: "Test StepSlider Async",
        default: true
    )]
    public function toggleAsync(Player $player, mixed $data): Async
    {
        return new Async(function () use ($player, $data) {
            $player->sendMessage("Toggle Async: You have selected: " . ($data ? "true" : "false"));
        });
    }

    /**
     * @throws Throwable
     *
     * This is an example of how to use Promise
     */
    #[VToggle(
        text: "Test StepSlider Promise",
        default: true
    )]
    public function togglePromise(Player $player, mixed $data): Promise
    {
        return new Promise(function ($resolve) use ($player, $data) {
            $player->sendMessage("Toggle Promise: You have selected: " . ($data ? "true" : "false"));
            $resolve();
        });
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
        options: [],
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