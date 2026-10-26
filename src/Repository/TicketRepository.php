<?php

declare(strict_types= 1);

namespace App\Repository;

use App\Contract\TicketCatalogInterface;
use App\Entity\Ticket;

use Doctrine\bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Override;

/*
    Reopository Doctrine de Ticket implementa TicketCatalogInterface
*/
final class TicketRepository extends ServiceEntityRepository implements TicketCatalogInterface
{
    public function __construct(ManagerRegistry $registry) 
    {
        parent::__construct($registry, Ticket::class);
    }
    //Método que devuelve todas las incidencias
    public function all(): array
    {
        return $this->findBy([], ['id'=>'ASC']);
    }

    //Método que devuelve incidencias por su código, si no la encuentra devuelve null
    #[Override]
    public function findByCode(string $code): ?Ticket
    {
        return $this->findOneBy(['code'=>$code]);
    }
}    
