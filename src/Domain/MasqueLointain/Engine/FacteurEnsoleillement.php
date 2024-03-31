<?php

namespace App\Domain\MasqueLointain\Engine;

use App\Domain\MasqueLointain\Enum\TypeMasqueLointain;
use App\Domain\MasqueLointain\MasqueLointain;
use App\Domain\MasqueLointain\Table\{Fe2Repository, Fe2, Omb, OmbRepository};

/**
 * Détermination du facteur d'ensoleillement
 * 
 * @see §6.2.2.2 Masques lointains
 */
final class FacteurEnsoleillement
{
    private MasqueLointain $input;
    private ?Fe2 $table_fe2;
    private ?Omb $table_omb;

    public function __construct(
        private Fe2Repository $table_fe2_repository,
        private OmbRepository $table_omb_repository,
    ) {
    }

    /**
     * Facteur d'ensoleillement dû au masque lointain
     */
    public function fe2(): float
    {
        return $this->table_fe2()?->fe2() ?? 1;
    }

    /**
     * Ombrage dû au masque lointain non homogène
     */
    public function omb(): float
    {
        return $this->table_omb()?->omb() ?? 0;
    }

    public function table_fe2(): ?Fe2
    {
        return $this->table_fe2;
    }

    public function table_omb(): ?Omb
    {
        return $this->table_omb;
    }

    public function input(): MasqueLointain
    {
        return $this->input;
    }

    public function __invoke(MasqueLointain $input): self
    {
        $this->input = $input;

        $this->table_fe2 = $this->input->type_masque() == TypeMasqueLointain::MASQUE_LOINTAIN_HOMOGENE
            ? $this->table_fe2_repository->find(
                orientation: $this->input->orientation(),
                hauteur_alpha: $this->input->hauteur_alpha()
            )
            : null;

        $this->table_omb = $this->input->type_masque() == TypeMasqueLointain::MASQUE_LOINTAIN_NON_HOMOGENE
            ? $this->table_omb_repository->find(
                secteur: $this->input->secteur(),
                orientation: $this->input->orientation(),
                hauteur_alpha: $this->input->hauteur_alpha()
            )
            : null;

        return $this;
    }
}
