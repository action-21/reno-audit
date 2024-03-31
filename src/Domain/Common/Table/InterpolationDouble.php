<?php

namespace App\Domain\Common\Table;

trait InterpolationDouble
{
    /**
     * Retourne la séquence de valeurs utilisées pour calculer la donnée interpolée
     * 
     * Exemple : [
     *      'x' => 2.38,
     *      'x1' => 3.33,
     *      'x2' => 1.43,
     *      'y' => 11,
     *      'y1' => 10,
     *      'y2' => 12,
     *      'q11' => 0.33,
     *      'q21' => 0.31,
     *      'q12' => 0.28,
     *      'q22' => 0.27,
     * ]
     * 
     * @return float[]
     */
    abstract public function sequence(float $x, float $y): array;

    /**
     * Retourne la valeur tabulaire de q aux coordonnées x,y
     */
    abstract public function q(?float $x, ?float $y): ?float;

    /**
     * Retourne la valeur interpolée pour f(x,y) =
     *              (($x2 - $x) * ($y2 - $y)) / $m * $q11 
     *               + (($x - $x1) * ($y2 - $y)) / $m * $q21
     *               + (($x2 - $x) * ($y - $y1)) / $m * $q12
     *               + (($x - $x1) * ($y - $y1)) / $m * $q22
     * 
     * avec m = ($x2 - $x1) * ($y2 - $y1)
     */
    public function p(float $x, float $y): float
    {
        $sequence = $this->sequence($x, $y);
        \extract($sequence);

        if ($q = $this->qxy($x, $y)) {
            return $q;
        }
        if (0 === $m = ($x2 - $x1) * ($y2 - $y1)) {
            return 0;
        }

        $p = (($x2 - $x) * ($y2 - $y)) / $m * $q11;
        $p += (($x - $x1) * ($y2 - $y)) / $m * $q21;
        $p += (($x2 - $x) * ($y - $y1)) / $m * $q12;
        $p += (($x - $x1) * ($y - $y1)) / $m * $q22;

        return $p;
    }
}
