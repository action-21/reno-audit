<?php

namespace App\Domain\Common\Table;

trait InterpolationSimple
{
    /**
     * Retourne la séquence de valeurs utilisées pour calculer la donnée interpolée
     * 
     * Exemple : [
     *      'x' => 15,
     *      'x1' => 20,
     *      'x2' => 25,
     *      'y1' => 3.2,
     *      'y2' => 2.85,
     * ]
     * 
     * @return float[]
     */
    abstract public function sequence(float $x): array;

    /**
     * Retourne la valeur interpolé pour f(x) = $y1 + ($x - $x1) * (($y2 - $y1) / ($x2 - $x1))
     * 
     * (($y2 - $y1) / ($x2 - $x1)) pente
     * 
     * delta x delta y
     */
    public function p(float $x): float
    {
        $sequence = $this->sequence($x);
        \extract($sequence);

        if ($x1 === $x) {
            return $y1;
        }
        if (0 === $mx = ($x2 - $x1)) {
            return 0;
        }
        return $y1 + ($x - $x1) * ($y2 - $y1) / $mx;
    }
}
