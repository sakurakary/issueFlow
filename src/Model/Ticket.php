<?php

//con el modelo podemos definir una clase objeto para poder utilizar en el controlador, en este caso Ticket, y poder crear objetos de tipo Ticket, con sus propiedades y métodos, para poder utilizarlos en el controlador y en la vista.

// representa una incidencia de IssuFlow com oun objeto PHP.

// Hasta la clase anterior cada ticket era un array asociativo, ahora damos un paso hacia POO: todos los datos y comportamientos de una incidencia quedan agrupados bajo la misma clase.

//Esta clase NO es todavía una entidad Doctrine. La persistenciá llegará más adelante; hoy queremos comprender primero el modelo orientado a objetos.

declare(strict_types=1);

namespace App\Model;

final class ticket {
    private string $id;
    private string $title;
    private string $priority;
    private string $descripcion;
    private string $usuario;
    private \DateTime $fecha;

    public function __construct(string $id, string $title, string $priority, string $descripcion, string $usuario, \DateTime $fecha) {
        $this->id = $id;
        $this->title = $title;
        $this->priority = $priority;
        $this->descripcion = $descripcion;
        $this->usuario = $usuario;
        $this->fecha = $fecha;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getPriority(): string {
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

    public function setId(string $id): void {
        $this->id = $id;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }   

    public function setPriority(string $priority): void {
        $this->priority = $priority;
    }

    public function setDescription(string $descripcion): void{
        $this->descripcion = $descripcion;
    }

    public function setUsuario(string $usuario): void{
        $this->usuario = $usuario;
    }

    public function setFecha(\DateTime $fecha): void{
        $this->fecha = $fecha;
    }  

    public function isUrgent (): bool {
        return $this->priority === 'urgent';
    }
}