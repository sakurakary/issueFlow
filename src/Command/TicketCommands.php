<?php

declare(strict_types= 1);

namespace App\Command;

use App\Entity\Ticket;
use App\Model\TicketPriority;
use App\Model\TicketStatus;
use App\Repository\TicketRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use DateTime;

 /**
     * Comandos de apoyo para el catálogo de tickets
     */
final class TicketCommands
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly TicketRepository $ticketRepository,
    ){}
    
    /**
     * Comando para insertar los tickets de demostración en la base de datos
     */

    #[AsCommand(name:"app:ticket:seed", description:"Carga de tickets iniciales en la BD")]

    public function seed(OutputInterface $output): int{
        $tickets = [
            ['INC-1001', 'No puedo iniciar sesión', TicketPriority::Urgent, TicketStatus::Open, 'Se queda el ordenador bloqueado en la pantalla de inicio', 'carlos47'],
            ['INC-1002', 'Error en la factura', TicketPriority::High, TicketStatus::InProgress,  'La factura no tiene el IVA desglosado', 'noelia43'],
            ['INC-1003', 'Actualizar datos de contacto', TicketPriority::Normal, TicketStatus::Close,  'Cliente llama para actualizar susdatos ', 'pedro61'],
        ];

        $createTickets = [];
        
        //Escribir $ticket de manera desestructurada
        foreach ($tickets as [$code,$title,$priority,$status,$description,$user,$date]) {
            //el comando es idempotente, verifica que el ticket existe, no crea duplicados 
            if($this->ticketRepository->findByCode($ticket[0])) {
                /**
                 * El método writeln de output escribe en el terminal, sprintf() me sirve para crear cadenas formateadas:
                 *     Cada símbolo % + letra, se sustituye por los argumentos a partir del segundo según el orden que aparezcan
                 */
                $output->writeln(sprintf('Incidencia %s ya exsite, se omite', $code));
                continue;
            }
            $ticket = new Ticket(
                code: $code,
                title: $title,
                priority: $priority,
                status: $status,
                description: $description,
                user: $user,
                date: new DateTime(),
            );      

            /**
             * persist() no hace el INSERT, agrega esta instrucción a la UniOfWWork
             */
            $this->entityManager->persist($ticket);
            $createTickets[] = $ticket;
            $output->writeln(sprintf('Incidencia %s preparada para persistir', $code));
        }
        /**
         * flush() sincroniza todos los cambios de una vez
         */
        $this->entityManager->flush();

        /**
         * Muestro en pantalla los agregados:
         */
        foreach ($createTickets as $ticket) {
            $output->writeln(sprintf('Incidencia %s persistida con id %d',
            $ticket->getCode().
            $ticket->getId()));
        }

        return Command::SUCCESS;
    }
}