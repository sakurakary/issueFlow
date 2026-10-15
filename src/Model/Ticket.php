<?php

//con el modelo podemos definir una clase objeto para poder utilizar en el controlador, en este caso Ticket, y poder crear objetos de tipo Ticket, con sus propiedades y métodos, para poder utilizarlos en el controlador y en la vista.

// representa una incidencia de IssuFlow com oun objeto PHP.

// Hasta la clase anterior cada ticket era un array asociativo, ahora damos un paso hacia POO: todos los datos y comportamientos de una incidencia quedan agrupados bajo la misma clase.

//Esta clase NO es todavía una entidad Doctrine. La persistenciá llegará más adelante; hoy queremos comprender primero el modelo orientado a objetos.

declare(strict_types=1);

namespace App\Model;

use app\Model\TicketPriority;

/*No es necesario el use por estar en el mismo namespace
        use app\Model\TicketPriority;
*/


final class Ticket {
    

    public function __construct(
        private string $id,
        private string $title,
        private TicketPriority $priority,
        private string $descripcion,
        private string $usuario,
        private \DateTime $fecha,
        private string $estado,
    ) {}

    public function getId(): string {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getPriority(): TicketPriority {
        return $this->priority;
    }

    public function getDescripción(): string{
        return $this->descripcion;
    }

    public function getUsuario(): string{
        return $this->usuario;
    }
    
    public function getFecha(): \DateTime{
        return $this->fecha;
    }

    public function getStatus():string{
        return $this->estado;
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

    public function setDescription(string $descripcion): void{
        $this->descripcion = $descripcion;
    }

    public function setUsuario(string $usuario): void{
        $this->usuario = $usuario;
    }

    public function setFecha(\DateTime $fecha): void{
        $this->fecha = $fecha;
    }  

    public function setStatus(string $estado): void{
        $this->$estado = $estado; 
    }
    //llama al metodo del enum de TicketPriority donde se evalua la prioridad
    public function isUrgent (): bool {
        return $this->priority === isUrgent();
    }

    public function isOpen (): bool {
        return $this->status === 'open';
    }

    public static function getAllTickets(): array{
        return [
            new Ticket(
                id: 'INC-1001',
                title: 'Error en la factura',
                priority: TicketyPriority::Urgent,
                descripcion:'Al imprimir salta un error en la factura',
                usuario:'Galimatias33',
                fecha: new \DateTime('05/02/2026'),
                estado: 'open',
            ),
            new Ticket(
                id: 'INC-1002',
                title: 'PC no enciednde',
                priority: TicketyPriority::High,
                descripcion:'Al imprimir salta un error en la factura',
                usuario:'Galimatias02',
                fecha: new \DateTime('05/02/2026'),
                estado: 'open',
            ),
            new Ticket(
                id: 'INC-1003',
                title: 'Error en la factura',
                priority: TicketyPriority::Normal,
                descripcion:'Al imprimir salta un error en la factura',
                usuario:'Galimatias18',
                fecha: new \DateTime('05/02/2026'),
                estado: 'open',
            )
        ];
    }
}



//Las posibles prioridades que va a aceptar el código
/* enum TicketPriority: string
{
    case Urgent = 'urgent';
    case High = 'high';
    case Normal = 'normal';
    case Low = 'low';
}
*/