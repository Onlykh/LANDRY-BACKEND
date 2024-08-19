<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

abstract class BaseEnumWithColor extends Enum
{
    /**
     * @var string
     */
    protected $color;

    /**
     * Constructor to initialize the enum with a key or value.
     *
     * @param string $input
     */
    public function __construct(string $input)
    {
        $values = static::values();

        // Check if the input is a key in the values array
        if (!array_key_exists($input, $values)) {
            // Flip the array to get values as keys and keys as values
            $flippedValues = array_flip($values);
            // Now you can match a value to its key
            $input = $flippedValues[$input] ?? $input;
        }

        parent::__construct($input);

        $this->color = static::colors()[$input];
    }

    /**
     * Get the color for the current enum value.
     *
     * @return string | array<string, string>
     */
    public function __get($name)
    {
        if ($name === 'color') {
            return $this->color;
        }

        if ($name === 'all') {
            return [
                'label' => $this->label,
                'value' => $this->value,
                'color' => $this->color,
            ];
        }

        return parent::__get($name);
    }



    /**
     * @return string[]|int[]|Closure
     * @psalm-return array<string, string|int> | Closure(string):(int|string)
     */
    protected static function colors()
    {
        return [];
    }
}
