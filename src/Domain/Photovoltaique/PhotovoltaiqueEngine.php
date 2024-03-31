<?php

namespace App\Domain\Photovolotaique;

use App\Domain\Audit\Enum\Mois;
use App\Domain\Photovoltaique\Table\{CoefficientOrientation, CoefficientOrientationRepository};

/**
 * @see §16.2
 */
final class PhotovoltaiqueEngine
{
    private ?Photovoltaique $input = null;
    private ?CoefficientOrientation $table_coeff_orientation_pv = null;

    public function __construct(
        private CoefficientOrientationRepository $table_coeff_orientation_pv_repository,
    ) {
    }

    /**
     * Ppv - Production annuelle d'électricité par les capteurs photovoltaïques (kWh)
     */
    public function production(): ?float;

    /**
     * Ppv,j - Production annuelle d'électricité par les capteurs photovoltaïques pour le mois j (kWh)
     */
    public function production_j(Mois $mois): ?float;

    /**
     * Scapteurs - Surface des capteurs (m²)
     */
    public function surface_capteurs(): ?float;

    /**
     * k - oefficient de pondération prenant en compte l’altération par rapport à l’orientation optimale
     */
    public function k(): ?float
    {
        return $this->input()->k
    }

    /**
     * Valeur de la table utilisée pour le calcul du coefficient d'orientation des panneaux photovoltaïques
     */
    public function table_coef_orientation_pv(): ?CoefficientOrientation
    {
        return $this->table_coeff_orientation_pv;
    }

    public function input(): Photovoltaique
    {
        if (null === $this->input) {
            throw new \DomainException("input:data:uninitialized");
        }
        return $this->input;
    }

    public function __invoke(Photovoltaique $input): self
    {
        $this->input = $input;

        return $this;
    }
}
