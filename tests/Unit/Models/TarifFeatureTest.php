<?php

namespace Tests\Unit;

use App\Models\TarifUser;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TarifUserTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasCorrectTableName()
    {
        $model = new TarifUser();
        $this->assertEquals('tarif_users', $model->getTable());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasCorrectPrimaryKey()
    {
        $model = new TarifUser();
        $this->assertEquals('id', $model->getKeyName());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasIncrementingId()
    {
        $model = new TarifUser();
        $this->assertTrue($model->getIncrementing());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasTimestampsDisabled()
    {
        $model = new TarifUser();
        $this->assertFalse($model->usesTimestamps());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasFillableAttributes()
    {
        $model = new TarifUser();
        $this->assertEquals(['tarif_id', 'user_id', 'expired_at'], $model->getFillable());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasCorrectKeyType()
    {
        $model = new TarifUser();
        $this->assertEquals('int', $model->getKeyType());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasCorrectCasts()
    {
        $model = new TarifUser();
        $expectedCasts = [
            'id' => 'integer',
            'tarif_id' => 'integer',
            'user_id' => 'integer',
            'created_at' => 'datetime',
            'expired_at' => 'datetime',
        ];
        $this->assertEquals($expectedCasts, $model->getCasts());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasCorrectNumberOfLines()
    {
        $count = DB::table('tarif_users')->count();
        $this->assertEquals(3, $count); // ajuste à ta réalité
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itBelongsToTarif()
    {
        $relation = (new TarifUser())->tarif();
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
        $this->assertEquals('tarif_id', $relation->getForeignKeyName());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itBelongsToUser()
    {
        $relation = (new TarifUser())->user();
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
    }
}
