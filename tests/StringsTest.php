<?php

namespace TraderInteractive\Util;

use TraderInteractive\Util\Strings as S;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \TraderInteractive\Util\Strings
 * @covers ::<private>
 */
final class StringsTest extends TestCase
{
    /**
     * Verify bahavior of format() with argument cannot be casted to a string.
     *
     * @test
     * @expectedException TypeError
     * @covers ::format
     *
     * @return void
     */
    public function formatNonStringCastableObject()
    {
        S::format('{0} and {1}', new \StdClass(), 'Jill');
    }

    /**
     * Verify bahavior of format() with object argument casted to a string.
     *
     * @test
     * @covers ::format
     *
     * @return void
     */
    public function formatStringCastableObject()
    {
        $e = new \Exception();
        $this->assertSame(
            "Exception {$e} was thrown",
            S::format('Exception {0} was thrown', $e)
        );
    }

    /**
     * Verify bahavior of format() with repeated key.
     *
     * @test
     * @covers ::format
     *
     * @return void
     */
    public function formatKeysAreRepeatable()
    {
        $this->assertSame('AAA', S::format('{0}{0}{0}', 'A'));
    }

    /**
     * Verify bahavior of format() with repeated unordered keys.
     *
     * @test
     * @covers ::format
     *
     * @return void
     */
    public function formatKeyOrderDoesNotMatter()
    {
        $this->assertSame('ABC', S::format('{2}{1}{0}', 'C', 'B', 'A'));
    }

    /**
     * Verify bahavior of format() with non-string $format.
     *
     * @test
     * @expectedException TypeError
     * @covers ::format
     *
     * @return void
     */
    public function formatNonStringFormat()
    {
        S::format([], 'C', 'B', 'A');
    }

    /**
     * @test
     * @covers ::endsWith
     *
     * @return void
     */
    public function endsWithEmptyString()
    {
        $nonSuffix = null;
        $this->assertFalse(S::endsWith('', 'suffix', $nonSuffix));
        $this->assertSame('', $nonSuffix);
    }

    /**
     * Verify matching bahavior of endsWith().
     *
     * @test
     * @covers ::endsWith
     *
     * @return void
     */
    public function endsWithMatches()
    {
        $nonSuffix = null;
        $this->assertTrue(S::endsWith('bah', 'h', $nonSuffix));
        $this->assertSame('ba', $nonSuffix);
    }

    /**
     * Verify non-matching bahavior of endsWith().
     *
     * @test
     * @covers ::endsWith
     *
     * @return void
     */
    public function endsWithNoMatches()
    {
        $nonSuffix = null;
        $this->assertFalse(S::endsWith('bah', 'z', $nonSuffix));
        $this->assertSame('bah', $nonSuffix);
    }

    /**
     * Verify non-matching bahavior of endsWith().
     *
     * @test
     * @expectedException TypeError
     * @covers ::endsWith
     *
     * @return void
     */
    public function endsWithBadTypeForSubject()
    {
        S::endsWith(new \StdClass(), '');
    }

    /**
     * Verify behavior of endsWith() with non-string $suffix.
     *
     * @test
     * @expectedException TypeError
     * @covers ::endsWith
     *
     * @return void
     */
    public function endsWithBadTypeForSuffix()
    {
        S::endsWith('', new \StdClass());
    }

    /**
     * Verify behavior of endsWith() with all arguments as empty strings.
     *
     * @test
     * @covers ::endsWith
     *
     * @return void
     */
    public function endsWithEmptyBoth()
    {
        $nonSuffix = null;
        $this->assertTrue(S::endsWith('', '', $nonSuffix));
        $this->assertSame('', $nonSuffix);
    }

    /**
     * Verify behavior of endsWith() with empty string $suffix.
     *
     * @test
     * @covers ::endsWith
     *
     * @return void
     */
    public function endsWithEmptySuffix()
    {
        $nonSuffix = null;
        $this->assertTrue(S::endsWith('a', '', $nonSuffix));
        $this->assertSame('a', $nonSuffix);
    }

    /**
     * Verify behavior of endsWith() with empty string $subject.
     *
     * @test
     * @covers ::endsWith
     *
     * @return void
     */
    public function endsWithEmptySubject()
    {
        $nonSuffix = null;
        $this->assertFalse(S::endsWith('', 'b', $nonSuffix));
        $this->assertSame('', $nonSuffix);
    }

    /**
     * Verify basic behavior of ellipsize().
     *
     * @test
     * @covers ::ellipsize
     *
     * @return void
     */
    public function ellipsize()
    {
        $input = 'Short text is an arbitrary thing.';
        $this->assertSame('', S::ellipsize($input, 0));
        $this->assertSame('.', S::ellipsize($input, 1));
        $this->assertSame('...', S::ellipsize($input, 3));
        $this->assertSame('S...', S::ellipsize($input, 4));
        $this->assertSame('Short text...', S::ellipsize($input, 13));
        $this->assertSame('Short text is an arbitrary th...', S::ellipsize($input, 32));
        $this->assertSame($input, S::ellipsize($input, 33));
        $this->assertSame($input, S::ellipsize($input, 34));
        $this->assertSame($input, S::ellipsize($input, 35));
        $this->assertSame($input, S::ellipsize($input, 50));
    }

    /**
     * Verify behavior of ellipsize() with negative max length.
     *
     * @test
     * @covers ::ellipsize
     *
     * @return void
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage $maxLength is negative
     */
    public function ellipsizeNegativeMaxLength()
    {
        S::ellipsize('foo', -1);
    }

    /**
     * Tests that ellipsize works with a custom suffix.
     *
     * @test
     * @covers ::ellipsize
     *
     * @return void
     */
    public function ellipsizeCustomSuffix()
    {
        $this->assertSame('Test!', S::ellipsize('Testing', 5, '!'));
    }

    /**
     * Tests that ellipsize fails with an integer instead of a string.
     *
     * @test
     * @expectedException TypeError
     * @covers ::ellipsize
     *
     * @return void
     */
    public function ellipsizeIntegerInsteadOfString()
    {
        S::ellipsize(null, 10);
    }

    /**
     * Tests that ellipsize fails with a string for $maxLength.
     *
     * @test
     * @expectedException TypeError
     * @covers ::ellipsize
     *
     * @return void
     */
    public function ellipsizeStringMaxLength()
    {
        S::ellipsize('test', 'a');
    }

    /**
     * @test
     * @expectedException TypeError
     * @covers ::ellipsize
     *
     * @return void
     */
    public function ellipsizeNonStringSuffix()
    {
        S::ellipsize('test', 10, new \StdClass());
    }
}
