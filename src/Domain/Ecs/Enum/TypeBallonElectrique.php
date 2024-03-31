<?php

namespace App\Domain\Ecs\Enum;

/**
 * Type de ballon électrique en complément d'une chaudière électrique utilisée pour la production d'ECS
 */
enum TypeBallonElectrique: int
{
    case ID_01 = 1;
    case ID_02 = 2;
    case ID_03 = 3;
    case ID_04 = 4;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Ballon électrique à accumulation horizontal',
            self::ID_02 => 'Ballon électrique à accumulation vertical - Autres ou inconnue',
            self::ID_03 => 'Ballon électrique à accumulation vertical - Catégorie B ou 2 étoiles',
            self::ID_04 => 'Ballon électrique à accumulation vertical - Catégorie C ou 3 étoiles'
        };
    }

    /**
     * Coefficient applicable au rendement de stockage pour les ballons électriques
     * 
     * @see §11.6.3
     */
    public function coefficient_stockage(): float
    {
        return match ($this) {
            self::ID_01 => 1,
            self::ID_02 => 1,
            self::ID_03 => 1,
            self::ID_04 => 1.08
        };
    }
}
