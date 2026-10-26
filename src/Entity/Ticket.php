<?php

//con el modelo podemos definir una clase objeto para poder utilizar en el controlador, en este caso Ticket, y poder crear objetos de tipo Ticket, con sus propiedades y métodos, para poder utilizarlos en el controlador y en la vista.

// representa una incidencia de IssuFlow com oun objeto PHP.

// Hasta la clase anterior cada ticket era un array asociativo, ahora damos un paso hacia POO: todos los datos y comportamientos de una incidencia quedan agrupados bajo la misma clase.

//Esta clase NO es todavía una entidad Doctrine. La persistenciá llegará más adelante; hoy queremos comprender primero el modelo orientado a objetos.

declare(strict_types=1);

#mapeo de modelos, para ello pasamos de modelos a entidades
#para ello cambiamos el namespace de App\Model a App\Entity
namespace App\Entity;
#importamos el doctrine con 
use Doctrine\ORM\Mapping as ORM;
#importamos los tipos de la base de datos con 
use Doctrine\DBAL\Types\Types;
#importamos los modelos que usa ya que no están en \App\Molde más
use App\Model\TicketPriority;
use App\Model\TicketStatus;
use DateTime;
use InvalidArgumentException;

/*No es necesario el use por estar en el mismo namespace
        use app\Model\TicketPriority;
*/

#Comentario: Entity Doctrine de una incidencia de IssueFlow
#Sigue siendo un objeto PHP con reglas de dominio. Los atributos #[ORM\\...] añaden el mapping necesario para que Doctrine sepa como persistirlo.
#con esto le decimos que corresponde a cada cosa
#[ORM\Entity]
#[ORM\Table(name: 'tickets')]

final class Ticket {
    
      #Le decimos a la bd que cree el registro (id) siguiente con sus particularidades
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column(type: Types::BIGINT, options: ['unsigned' => true])]
        private ?int $id = null;
    public function __construct(
              #en empezamos el mapeo con las variables del constructor cambiamos $id por $code
        #[ORM\Column(length:8, unique: true)]
        private readonly string $code,

        #[ORM\Column(length:180)]
        private string $title,

        #[ORM\Column(length: 20, enumType: TicketPriority::class)]
        private TicketPriority $priority,

        #[ORM\Column(length: 20, enumType: TicketStatus::class)]
        private TicketStatus $status = TicketStatus::Open,

        #[ORM\Column(length:180)]
        private string $description,
        
        #[ORM\Column(length:180)]
        private string $user,

        #[ORM\Column(type: Types::DATETIME_MUTABLE)]
        private DateTime $date,
    ) {

        /* Verificamos la forma del id comparando con una regex (expresiones regulare) */
        if (preg_match('/^INC-\d{4}$/', $this->code) !== 1) {
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

    public function getId(): int {
        return $this->id;
    }

    public function getCode(): string {
        return $this->code;
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
    
    public function getDate(): DateTime{
        return $this->date;
    }

    public function getStatus():TicketStatus{
        return $this->status;
    }

    public function setCoded(string $code): void {
        $this->code = $code;
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

    public function setDate(DateTime $date): void{
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