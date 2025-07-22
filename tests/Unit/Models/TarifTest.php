<?php

namespace Tests\Unit;

use App\Models\Tarif;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TarifTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasCorrectTableName()
    {
        $tarif = new Tarif();
        $this->assertEquals('tarifs', $tarif->getTable());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasCorrectPrimaryKey()
    {
        $tarif = new Tarif();
        $this->assertEquals('id', $tarif->getKeyName());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasIncrementingId()
    {
        $tarif = new Tarif();
        $this->assertTrue($tarif->getIncrementing());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasTimestampsDisabled()
    {
        $tarif = new Tarif();
        $this->assertFalse($tarif->usesTimestamps());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasFillableAttributes()
    {
        $tarif = new Tarif();
        $this->assertEquals(['name', 'amount', 'max_limit'], $tarif->getFillable());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasCorrectKeyType()
    {
        $tarif = new Tarif();
        $this->assertEquals('int', $tarif->getKeyType());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasCorrectCasts()
    {
        $tarif = new Tarif();
        $expectedCasts = [
            'id' => 'integer',
            'amount' => 'float',
            'max_limit' => 'integer',
        ];
        $this->assertEquals($expectedCasts, $tarif->getCasts());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasCorrectNumberOfLines(): void
    {
        $count = DB::table('tarifs')->count();
        $this->assertEquals(11, $count);
    }
}
