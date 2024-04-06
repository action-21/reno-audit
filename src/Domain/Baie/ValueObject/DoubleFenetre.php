<?php

namespace App\Domain\Baie\ValueObject;

use App\Domain\Baie\Enum\{TypeBaie, TypePose};

final class DoubleFenetre
{
    public function __construct(
        public readonly TypeBaie $type_baie,
        public readonly TypePose $type_pose,
        public readonly Vitrage $vitrage,
        public readonly Menuiserie $menuiserie,
        public readonly Performance $performance,
    ) {
    }
}
