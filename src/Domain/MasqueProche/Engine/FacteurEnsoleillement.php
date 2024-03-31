<?php

namespace App\Domain\MasqueProche\Engine;

use App\Domain\MasqueProche\MasqueProche;
use App\Domain\MasqueProche\Table\{Fe1, Fe1Repository};

/**
 * Facteur d'ensoleillement du fait du masque proche
 * 
 * @see §6.2.2.1 Masques proches
 */
final class FacteurEnsoleillement
{
    /**
     * Valeur par défaut de fe1
     */
    final public const FE1_DEFAULT = 1;

    private MasqueProche $input;
    private ?Fe1 $table_fe1;

    public function __construct(private Fe1Repository $table_fe1_repository)
    {
    }

    /**
     * Facteur d'ensoleillement du fait du masque proche
     */
    public function fe1(): float
    {
        return $this->table_fe1()?->fe1() ?? self::FE1_DEFAULT;
    }

    public function table_fe1(): ?Fe1
    {
        return $this->table_fe1;
    }

    public function input(): MasqueProche
    {
        return $this->input;
    }

    public function __invoke(MasqueProche $input): self
    {
        $this->input = $input;

        $this->table_fe1 = $this->table_fe1_repository->find(
            type_masque_proche: $input->type_masque(),
            orientation: $input->orientation(),
            avancee: $input->avancee(),
        );

        return $this;
    }
}
