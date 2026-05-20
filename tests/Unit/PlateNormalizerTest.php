<?php

namespace Tests\Unit;

use App\Models\WorkOrder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Task 2.2 Checkpoint: Normalization Engine
 *
 * "Menulis unit test khusus untuk melemparkan 5 variasi format plat nomor acak.
 *  Test dinyatakan PASS jika nilai yang tersimpan di kolom normalized_plat
 *  terbukti identik dan bersih dari karakter non-alfanumerik."
 */
class PlateNormalizerTest extends TestCase
{
    #[DataProvider('plateVariationsProvider')]
    public function test_normalize_plate_produces_clean_alphanumeric_uppercase(string $input, string $expected): void
    {
        $result = WorkOrder::normalizePlate($input);

        $this->assertSame($expected, $result, "Input '{$input}' should normalize to '{$expected}'");
        $this->assertMatchesRegularExpression('/^[A-Z0-9]+$/', $result, 'Result must be alphanumeric uppercase only');
    }

    /**
     * 7 variations of plate numbers in different formats.
     */
    public static function plateVariationsProvider(): array
    {
        return [
            'spaced with mixed case'       => ['b  8888  xZ', 'B8888XZ'],
            'hyphenated lowercase'         => ['ae-1234-bz', 'AE1234BZ'],
            'clean uppercase'              => ['AE1234BZ', 'AE1234BZ'],
            'trailing/leading spaces'      => ['  AE 1234 BZ  ', 'AE1234BZ'],
            'dots and underscores'         => ['B.1234.ABC', 'B1234ABC'],
            'tabs and special chars'       => ["D\t5678\tGH!", 'D5678GH'],
            'all lowercase no separator'   => ['ab1234cd', 'AB1234CD'],
        ];
    }

    /**
     * Verify all 5 variations of the same plate produce identical output.
     */
    public function test_all_plate_variations_converge_to_same_result(): void
    {
        $variations = [
            'b  8888  xZ',
            'B-8888-XZ',
            'B 8888 XZ',
            'b8888xz',
            '  B.8888.XZ  ',
        ];

        $results = array_map(fn($v) => WorkOrder::normalizePlate($v), $variations);
        $unique = array_unique($results);

        $this->assertCount(1, $unique, 'All variations must converge to the same normalized value');
        $this->assertSame('B8888XZ', $unique[0]);
    }
}
