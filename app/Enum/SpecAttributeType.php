<?php

namespace App\Enum;

enum SpecAttributeType: string
{
    case Integer = 'integer';
    case BigInteger = 'bigInteger';
    case SmallInteger = 'smallInteger';
    case UnsignedInteger = 'unsignedInteger';
    case Float = 'float';
    case Decimal = 'decimal';
    case Boolean = 'boolean';
    case String = 'string';
    case Text = 'text';
    case MediumText = 'mediumText';
    case LongText = 'longText';
    case Date = 'date';
    case DateTime = 'dateTime';
    case Timestamp = 'timestamp';
    case Time = 'time';
    case Binary = 'binary';
    case Enum = 'enum';
    case Json = 'json';
    case Jsonb = 'jsonb';

    public static function values(): array
    {
        return [
            self::Integer->value,
            self::BigInteger->value,
            self::SmallInteger->value,
            self::UnsignedInteger->value,
            self::Float->value,
            self::Decimal->value,
            self::Boolean->value,
            self::String->value,
            self::Text->value,
            self::MediumText->value,
            self::LongText->value,
            self::Date->value,
            self::DateTime->value,
            self::Timestamp->value,
            self::Time->value,
            self::Binary->value,
            self::Enum->value,
            self::Json->value,
            self::Jsonb->value,
        ];
    }
}
