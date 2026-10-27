<?php

//con el modelo podemos definir una clase objeto para poder utilizar en el controlador, en este caso Ticket, y poder crear objetos de tipo Ticket, con sus propiedades y métodos, para poder utilizarlos en el controlador y en la vista.

// representa una incidencia de IssuFlow com oun objeto PHP.

// Hasta la clase anterior cada ticket era un array asociativo, ahora damos un paso hacia POO: todos los datos y comportamientos de una incidencia quedan agrupados bajo la misma clase.

//Esta clase NO es todavía una entidad Doctrine. La persistenciá llegará más adelante; hoy queremos comprender primero el modelo orientado a objetos.

declare(strict_types=1);

namespace App\Model;

use InvalidArgumentException;

/*No es necesario el use por estar en el mismo namespace
        use app\Model\TicketPriority;
*/


final class Ticket {
    

    public function __construct(
        private readonly string $id,
        private string $title,
        private TicketPriority $priority,
        private string $description,
        private string $user,
        private \DateTime $date,
        private TicketStatus $status,
    ) {

        /* Verificamos la forma del id comparando con una regex (expresiones regulare) */
        if (preg_match('/^INC-\d{4}$/', $this->id) !== 1) {
            throw new InvalidArgumentException('El formato del id del ticket no es válido');
        }
        /* Hacemos un trim (eliminar espacios antes y después) del title */
        $normalizedTitle = trim($title);
        // Verificamos que la cadena de texto no esté vacía
        if ($normalizedTitle === '') {
            throw new InvalidArgumentException('El título no puede estar vacío');
        }
        $this->title = $normalizedTitle;

    }

    public function getId(): string {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getPriority(): TicketPriority {
        return $this->priority;
    }

    public function getDescription(): string{
        return $this->description;
    }

    public function getUser(): string{
        return $this->user;
    }
    
    public function getDate(): \DateTime{
        return $this->date;
    }

    public function getStatus():TicketStatus{
        return $this->status;
    }

    public function setId(string $id): void {
        $this->id = $id;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }   

    /*public function setPriority(string $priority): void {
        $this->priority = TicketPriority;
    }*/

    public function setDescription(string $description): void{
        $this->description = $description;
    }

    public function setUser(string $user): void{
        $this->user = $user;
    }

    public function setDate(\DateTime $date): void{
        $this->date = $date;
    }  

    /*public function setStatus(string $estado): void{
        $this->$estado = $estado; 
    }*/

    //llama al metodo del enum de TicketPriority donde se evalua la prioridad
    public function isUrgent (): bool {
        return $this->priority->isUrgent();
    }

    public function isClose (): bool {
        return $this->status->isClosed();
    }

    public function isOpen (): bool {
        return $this->status->isOpen();
    }
}