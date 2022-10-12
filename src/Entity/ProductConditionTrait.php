<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

const NEUF = 0;
const OCCASION_1 = 1;
const OCCASION_2 = 2;
const OCCASION_3 = 3;

trait ProductConditionTrait
{
    /**
     * @ORM\Column(type="smallint", options={"default" : 0})
     */
    private  $productcondition = 0;

    public static $productconditions = [
        NEUF        => 'Neuf',
        OCCASION_1      => 'Excellent état',
        OCCASION_2       => 'Très bon état',
        OCCASION_3       => 'Etat correct',
    ];


    public function getProductcondition(): int
    {
        return $this->productcondition;
    }

    public function getProductconditionName(): string
    {
        return self::$productconditions[$this->productcondition];
    }
    public function setProductcondition(int $genre): self
    {
        $this->productcondition = $genre;

        return $this;
    }
}
