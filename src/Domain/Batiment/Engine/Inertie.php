<?php

namespace App\Domain\Moteur3CL\Inertie;

use App\Domain\Batiment\Enum\ClasseInertie;

/**
 * @see §6
 */
final class Inertie
{
    private InertieInput $input;

    public function classe_inertie(): ?ClasseInertie
    {
        /** @var ClasseInertie[] */
        $collection = [];
        $ratio = 0;

        foreach (ClasseInertie::cases() as $classe_inertie) {
            if ($ratio < $ratio_classe_inertie = $this->ratio_classe_inertie($classe_inertie)) {
                $ratio = $ratio_classe_inertie;
                $collection[] = $classe_inertie;
            }
        }
        return ClasseInertie::tryFromCollection($collection);
    }

    /**
     * Ratio de la classe d'inertie
     */
    public function ratio_classe_inertie(ClasseInertie $classe_inertie): float
    {
        $sh = \array_reduce($this->input->niveau_collection(), fn (InertieNiveauInput $item, float $sh): float => $sh += $item->surface_habitable(), 0);

        return $sh === 0 ? 0 : \array_reduce($this->input->niveau_collection(), function (InertieNiveauInput $item, float $ratio) use ($sh, $classe_inertie): float {
            return $item->classe_inertie() == $classe_inertie ? $ratio += $item->surface_habitable() / $sh : $ratio;
        });
    }

    public function __invoke(InertieInput $input): self
    {
        $this->input = $input;

        return $this;
    }
}
