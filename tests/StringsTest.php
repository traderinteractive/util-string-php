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
     * Verify basic behavior of ucwords().
     *
     * @test
     * @covers ::ucwords
     *
     * @return void
     */
    public function ucwords()
    {
        $input = 'break-down o\'boy up_town you+me here now,this:place';
        $this->assertSame('Break-Down O\'Boy Up_Town You+Me Here Now,This:Place', S::ucwords($input));
    }

    /**
     * Verify behavior of ucwords() with optional delimiters.
     *
     * @test
     * @covers ::ucwords
     *
     * @return void
     */
    public function ucwordsOptionalDelimiters()
    {
        $input = 'break-down o\'boy up_town you+me here now,this:place';
        $this->assertSame('Break-Down O\'boy Up_town You+me Here Now,this:place', S::ucwords($input, '- '));
    }

    /**
     * @test
     * @covers ::ucwords
     *
     * @return void
     */
    public function ucwordsNoDelimiters()
    {
        $input = 'Mary had a little-lamb';
        $this->assertSame($input, S::ucwords($input, ''));
    }

    /**
     * Verify behavior of ucwords() with single delimiter.
     *
     * @test
     * @covers ::ucwords
     *
     * @return void
     */
    public function ucwordsSingleDelimiter()
    {
        $input = 'Mary had a little-lamb';
        $this->assertSame('MaRy haD a little-laMb', S::ucwords($input, 'a'));
    }
}
