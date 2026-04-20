<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class ReleaseMetaTest extends TestCase
{
    public function testVersionIsNonEmptySemverShape(): void
    {
        $v = inmotion_ci_cd_poc_version();
        $this->assertNotSame('', $v);
        $this->assertMatchesRegularExpression('/^\d+\.\d+\.\d+$/', $v);
    }

    public function testBuildIdIsNonEmpty(): void
    {
        $b = inmotion_ci_cd_poc_build_id();
        $this->assertNotSame('', $b);
        $this->assertLessThanOrEqual(64, strlen($b));
    }
}
