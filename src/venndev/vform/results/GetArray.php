<?php

declare(strict_types=1);

namespace venndev\vform\results;

use Override;
use venndev\vformoopapi\results\VResultArray;

final class GetArray extends VResultArray
{

    public function __construct(array $input)
    {
        parent::__construct($input);
    }

    #[Override] public function getResult(): array
    {
        // You can do something here
        return $this->getInput();
    }

}