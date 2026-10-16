<?php

declare (strict_types= 1);

namespace App\Model;


/*Definir las prioridades permitidas*/

enum TicketStatus: string{

    case Open = 'open';
    case Close = 'close';
    case Progress = 'in progress';

    public function getLabel(): string{
        return match ($this) {
           self::Open => 'Abierto',
           self::Close => 'Cerrado',
           self::Progress => 'En Progreso',
        };
    }
    
    //evalua la prioridad del ticket
    public function isOpen (): bool {
        return $this === self::Open;
    }
    public function isClosed (): bool {
        return $this === self::Close;
    }
}

    

?>