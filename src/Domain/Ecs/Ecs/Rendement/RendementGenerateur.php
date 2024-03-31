<?php

namespace App\Domain\Moteur3CL\Ecs\Rendement;

use App\Domain\Audit\Enum\ScenarioUsage;
use App\Domain\Moteur3CL\Common\DataStore;
use App\Domain\Moteur3CL\Ecs\Rendement\Table\{PerteStockage, PerteStockageRepository};
use App\Domain\Moteur3CL\Ecs\Rendement\Table\{RendementDistribution, RendementDistributionRepository};

/**
 * @see §11.5
 * @see §11.6
 */
final class RendementGenerateur
{
    use DataStore;

    private RendementGenerateurInput $input;

    public function __construct(
        private RendementDistributionRepository $table_rendement_distribution_repository,
        private PerteStockageRepository $table_perte_stockage_repository,
    ) {
    }

    /**
     * I,ecs - Inverse du rendement du générateur
     */
    public function iecs(ScenarioUsage $scenario): float
    {
        return ($rd = $this->rd() && $rs = $this->rs($scenario) && $rg = $this->rg($scenario)) ? 1 / ($rd * $rs * $rg) : 0;
    }

    /**
     * rd - Rendement de distribution
     */
    public function rd(): float
    {
        return $this->table_rendement_distribution()?->rd() ?? 0;
    }

    /**
     * rs - Rendement de stockage
     */
    public function rs(ScenarioUsage $scenario): float
    {
        return 0 < ($becs = $this->input->becs($scenario))
            ? $this->input->type_generateur()->coefficient_rendement_stockage_electrique() / (1 + $this->qgw() * $this->rd() / $becs)
            : 0;
    }

    /**
     * rg - Rendement de génération
     */
    public function rg(ScenarioUsage $scenario): float
    {
        return 0;
    }

    /**
     * Qg,w - Pertes de stockage des ballons électriques (Wh)
     */
    public function qgw(): float
    {
        if (0 == $this->input->volume_stockage()) {
            return 0;
        }
        return $this->input->type_generateur()->ballon_electrique()
            ? 8592 * 4524 * $this->input->volume_stockage() * $this->cr()
            : 67662 * $this->input->volume_stockage();
    }

    /**
     * Cr - Coefficient de perte du ballon de stockage (Wh/l.°C.jour)
     */
    public function cr(): ?float
    {
        return $this->table_perte_stockage()?->cr();
    }

    /**
     * Valeur de la table rendement_distribution
     */
    public function table_rendement_distribution(): ?RendementDistribution
    {
        return $this->has('table_rendement_distribution')
            ? $this->get('table_rendement_distribution')
            : $this->set('table_rendement_distribution', $this->table_rendement_distribution_repository->find(
                type_installation: $this->input->type_installation(),
                bouclage_reseau: $this->input->bouclage_reseau(),
                position_volume_habitable: $this->input->position_volume_habitable(),
                alimentation_contigue: $this->input->alimentation_contigue(),
            ));
    }

    /**
     * Valeur de la table perte_stockage
     */
    public function table_perte_stockage(): ?PerteStockage
    {
        return $this->has('table_perte_stockage')
            ? $this->get('table_perte_stockage')
            : $this->set('table_perte_stockage', $this->table_perte_stockage_repository->find(
                type_generateur: $this->input->type_generateur(),
                volume_stockage: $this->input->volume_stockage(),
            ));
    }

    public function __invoke(RendementGenerateurInput $input): self
    {
        $this->input = $input;

        return $this;
    }
}
