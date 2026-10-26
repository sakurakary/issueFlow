<?php

declare (strict_types= 1);

namespace App\Model;


/*Definir las prioridades permitidas*/

enum TicketStatus: string{

    case Open = 'open';
    case Escalated = 'escalated';
    case Close = 'close';
    case InProgress = 'in progress';

    public function getLabel(): string{
        return match ($this) {
           self::Open => 'Abierto',
           self::Escalated => 'Escalado',
           self::Close => 'Cerrado',
           self::InProgress => 'En Progreso',
        };
    }
    
    //evalua la prioridad del ticket
    public function isOpen (): bool {
        return $this === self::Open;
    }
    public function isClosed (): bool {
        return $this === self::Close;
    }
    public function isEscalated (): bool {
        return $this === self::Escalated;
    }
    public function isInProgress (): bool {
        return $this === self::InProgress;
    }
}

    