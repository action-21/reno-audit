<?php

namespace Renolab\Dpe\Tests\Engine\Situation;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Renolab\Dpe\Engine\Situation\Caracteristique;

class CaracteristiqueTest extends TestCase
{
    public function test_volume_habitable(): void
    {
        /** @var MockObject|Caracteristique */
        $entity = $this->getMockForAbstractClass(originalClassName: Caracteristique::class, mockedMethods: [
            'surface_reference', 'hsp'
        ]);

        $entity->expects($this->once())->method('surface_reference')->will($this->returnValue((float) 100));
        $entity->expects($this->once())->method('hsp')->will($this->returnValue((float) 3));

        $this->assertEquals(300, $entity->volume_habitable());
    }
}
