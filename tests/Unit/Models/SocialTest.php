<?php

namespace Tests\Unit;

use App\Models\Social;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class SocialTest extends TestCase
{

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasCorrectTableName()
    {
        $social = new Social();
        $this->assertEquals('socials', $social->getTable());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasCorrectPrimaryKey()
    {
        $social = new Social();
        $this->assertEquals('id', $social->getKeyName());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasIncrementingId()
    {
        $social = new Social();
        $this->assertTrue($social->getIncrementing());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasTimestampsDisabled()
    {
        $social = new Social();
        $this->assertFalse($social->usesTimestamps());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasFillableAttributes()
    {
        $social = new Social();
        $this->assertEquals(['name'], $social->getFillable());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasCorrectKeyType()
    {
        $social = new Social();
        $this->assertEquals('int', $social->getKeyType());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasCorrectCasts()
    {
        $social = new Social();
        $expectedCasts = [
            'id' => 'integer',
            'name' => 'string',
        ];
        $this->assertEquals($expectedCasts, $social->getCasts());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function itHasCorrectsNumberOfLine(): void
    {
        $count = DB::table('socials')->count();

        $this->assertEquals(3, $count);
    }
}
