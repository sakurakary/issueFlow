<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use InvalidArgumentException;

#[ORM\Entity]
#[ORM\Table(name:"category")]
final class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::BIGINT, options: ['unsigned' => true])]
    private ?int $id = null;

    public function __construct(
        #[ORM\Column(length: 120, unique: true)]
        private string $name,
    ){
        /*
         * Normalizamos $name
         */
        $normalizedName = trim($name);
        //validamos que el nomre de usuario no está vacío
        if ($normalizedName === ''){
            throw new InvalidArgumentException('El nombre de usuario no puede estar vacío');
        }
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
   
}