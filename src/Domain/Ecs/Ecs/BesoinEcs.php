<?php

namespace App\Domain\Moteur3CL\Ecs;

use App\Domain\Moteur3CL\Common\DataStore;

/**
 * @see §11.1
 */
final class BesoinEcs
{
    use DataStore;

    private BesoinEcsInput $input;

    /**
     * Nadeq - Nombre d'adultes équivalents
     */
    public function nadeq(): ?float
    {
        return ($n_max = $this->nmax()) < 1.75
            ? $this->input->logements() * $n_max
            : $this->input->logements() * (1.75 + 0.3 * ($n_max - 1.75));
    }

    /**
     * Nmax - Coefficient d'occupation maximal
     */
    public function nmax(): ?float
    {
        $sh_moy = $this->input->surface_habitable_moyenne();

        // Logements individuels
        if ($this->input->type_batiment()->maison()) {
            if ($sh_moy < 30) {
                return 1;
            } else if ($sh_moy < 70) {
                return 1.75 - 0.01875 * (70 - $sh_moy);
            } else if ($sh_moy >= 70) {
                return 0.025 * $sh_moy;
            }
        }
        // Logements collectifs
        if ($this->input->type_batiment()->appartement() || $this->input->type_batiment()->immeuble()) {
            if ($sh_moy < 10) {
                return 1;
            } else if ($sh_moy < 50) {
                return 1.75 - 0.01875 * (50 - $sh_moy);
            } else if ($sh_moy >= 50) {
                return 0.035 * $sh_moy;
            }
        }
        return null;
    }

    public function __invoke(BesoinEcsInput $input): self
    {
        $this->input = $input;

        return $this;
    }
}
