<?php

namespace App\Domain\Batiment\Engine;

use App\Domain\Batiment\BatimentEngine;

/**
 * @see §11.1
 */
final class Occupation
{
    private BatimentEngine $context;

    /**
     * Nadeq - Nombre d'adultes équivalents
     */
    public function nadeq(): ?float
    {
        return ($n_max = $this->nmax()) < 1.75
            ? $this->context->input()->logement_collection()->count() * $n_max
            : $this->context->input()->logement_collection()->count() * (1.75 + 0.3 * ($n_max - 1.75));
    }

    /**
     * Nmax - Coefficient d'occupation maximal
     * 
     * @return float|null - Retourne null en cas d'incohérence
     */
    public function nmax(): ?float
    {
        $sh_moy = $this->context->input()->caracteristique()->surface_habitable_moyenne();

        // Logements individuels
        if ($this->context->input()->caracteristique()->type_batiment->maison()) {
            if ($sh_moy < 30) {
                return 1;
            } else if ($sh_moy < 70) {
                return 1.75 - 0.01875 * (70 - $sh_moy);
            } else if ($sh_moy >= 70) {
                return 0.025 * $sh_moy;
            }
            return null;
        }
        // Logements collectifs
        if ($sh_moy < 10) {
            return 1;
        } else if ($sh_moy < 50) {
            return 1.75 - 0.01875 * (50 - $sh_moy);
        } else if ($sh_moy >= 50) {
            return 0.035 * $sh_moy;
        }
        return null;
    }

    public function __invoke(BatimentEngine $context): self
    {
        $this->context = $context;
        return $this;
    }
}
