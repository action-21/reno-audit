<?php

namespace App\Domain\Paroi;

use App\Domain\Common\Enum\Enum;
use App\Domain\Lnc\Lnc;
use App\Domain\Paroi\Enum\Mitoyennete;

abstract class Ouverture extends Paroi
{
    protected ?ParoiOpaque $paroi_opaque = null;
    protected ?Lnc $local_non_chauffe = null;
    protected ?Mitoyennete $mitoyennete = null;

    public function set_paroi_opaque(\Stringable $reference_paroi_opaque): self
    {
        if (null === $entity = $this->enveloppe->paroi_collection()->search_paroi_opaque()->find($reference_paroi_opaque)) {
            throw new \DomainException('Paroi opaque non trouvée');
        }
        $this->paroi_opaque = $entity;
        $this->local_non_chauffe = null;
        $this->mitoyennete = null;

        return $this;
    }

    public function set_mitoyennete(Mitoyennete $mitoyennete, ?\Stringable $reference_local_non_chauffe = null): self
    {
        $this->paroi_opaque = null;

        if ($mitoyennete === Mitoyennete::LOCAL_NON_CHAUFFE) {
            if (null === $reference_local_non_chauffe) {
                throw new \DomainException('Local non chauffé requis');
            }
            if (null === $entity = $this->enveloppe->lnc_collection()->find($reference_local_non_chauffe)) {
                throw new \DomainException('Local non chauffé non trouvé');
            }
            if (false === $entity->type_lnc()->applicable($this->type_paroi())) {
                throw new \DomainException('Type de local non chauffé non applicable');
            }
            $this->local_non_chauffe = $entity;
            $this->mitoyennete = $mitoyennete;
            return $this;
        }
        $this->mitoyennete = $mitoyennete;
        $this->local_non_chauffe = null;
        return $this;
    }

    /**
     * Paroi opaque associée à l'ouverture
     */
    public function paroi_opaque(): ?ParoiOpaque
    {
        return $this->paroi_opaque;
    }

    /**
     * @inheritdoc
     */
    public function local_non_chauffe(): ?Lnc
    {
        return $this->paroi_opaque() ? $this->paroi_opaque()->local_non_chauffe() : $this->local_non_chauffe;
    }
    /**
     * @inheritdoc
     */
    public function mitoyennete(): Mitoyennete
    {
        return $this->paroi_opaque() ? $this->paroi_opaque()->mitoyennete() : $this->mitoyennete;
    }

    /**
     * Présence de joint d'étanchéité
     */
    abstract public function presence_joint(): bool;

    /**
     * Présence d'un retour d'isolation
     */
    abstract public function presence_retour_isolation(): ?bool;

    /**
     * Largeur du dormant en mm
     */
    abstract public function largeur_dormant(): ?float;

    /**
     * Type de pose de l'ouverture
     */
    abstract public function type_pose(): Enum;
}
