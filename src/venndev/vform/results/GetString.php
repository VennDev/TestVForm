<?php

declare(strict_types=1);

namespace venndev\vform\results;

use Override;
use venndev\vformoopapi\results\VResultString;

final class GetString extends VResultString
{

    public function __construct(string $input)
    {
        parent::__construct($input);
    }

    #[Override] public function getResult(): string
    {
        return $this->getInput();
    }

}