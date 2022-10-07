<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

const TOUS = 0;
const ENFANT = 1;
const FEMME = 2;
const HOMME = 3;
const HOMME_FEMME = 4;

trait GenreTrait
{
    /**
     * @ORM\Column(type="smallint", options={"default" : 0})
     */
    private  $genre = 0;

    public static $genres = [
        TOUS        => 'Tous',
        ENFANT      => 'Enfant',
        FEMME       => 'Femme',
        HOMME       => 'Homme',
        HOMME_FEMME => 'Homme / Femme',
    ];


    public function getGenre(): int
    {
        return $this->genre;
    }

    public function getGenreName(): string
    {
        return self::$genres[$this->genre];
    }
    public function setGenre(int $genre): self
    {
        $this->genre = $genre;

        return $this;
    }
}
