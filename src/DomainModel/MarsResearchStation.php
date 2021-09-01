<?php
declare(strict_types=1);

namespace App\DomainModel;

use App\Exception\WrongScientistTypeException;

class MarsResearchStation extends AbstractResearchStation
{
    public function __construct(int $id, array $scientists, array $products, array $events, bool $needHelp)
    {
        parent::__construct($id, $scientists, $products, $events, $needHelp);
    }

    public function addScientist(AbstractScientist $scientist): void
    {
        if (!$scientist instanceof MarsScientist) {
            throw new WrongScientistTypeException();
        }

        $this->scientists[] = $scientist;
    }
}
