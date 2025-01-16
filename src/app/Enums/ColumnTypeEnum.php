<?php

namespace Sindor\LaravelCode\App\Enums;

enum ColumnTypeEnum: string
{
    case STRING = 'string';
    case TEXT = 'text';

    case INTEGER = 'integer';
    case BIG_INTEGER = 'bigInteger';
    case FLOAT = 'float';
    case DOUBLE = 'double';

    case UNSIGNED_INTEGER = 'unsignedInteger';
    case UNSIGNED_BIG_INTEGER = 'unsignedBigInteger';

    case BOOLEAN = 'boolean';

    case DATE = 'date';
    case DATETIME = 'dateTime';
    case TIMESTAMP = 'timestamp';
    case TIME = 'time';

    case JSON = 'json';
    case JSONB = 'jsonb';
    case UUID = 'uuid';

    public function getCast(): string
    {
        return match ($this) {
            self::DATE, self::TIMESTAMP, self::DATETIME => 'datetime',
            self::JSON, self::JSONB => 'array',
            default => ''
        };
    }

    public function getRule(): string
    {
        return match ($this) {
            self::DATE, self::TIMESTAMP, self::DATETIME => 'date',
            self::JSON, self::JSONB => 'array',
            self::UUID => 'uuid',
            self::BOOLEAN => 'boolean',
            self::DOUBLE, self::FLOAT => 'numeric',
            self::INTEGER, self::BIG_INTEGER, self::UNSIGNED_BIG_INTEGER, self::UNSIGNED_INTEGER => 'integer',
            default => 'string'
        };
    }

    public function getProperty(): string
    {
        return match ($this) {
            self::DATE, self::TIMESTAMP, self::DATETIME => "\\" . \DateTime::class,
            self::JSON, self::JSONB => 'array',
            self::BOOLEAN => 'bool',
            self::DOUBLE, self::FLOAT => 'float',
            self::INTEGER, self::BIG_INTEGER, self::UNSIGNED_BIG_INTEGER, self::UNSIGNED_INTEGER => 'int',
            default => 'string'
        };
    }

    public function getFakerMethod(): string
    {
        return match ($this) {
            self::DATE => 'date',
            self::TIME => 'time',
            self::TIMESTAMP,
            self::DATETIME => 'dateTime',
            self::JSON, self::JSONB => 'words',
            self::UUID => 'uuid',
            self::BOOLEAN => 'boolean',
            self::TEXT => 'paragraph',
            self::DOUBLE, self::FLOAT => 'randomFloat',
            self::INTEGER, self::BIG_INTEGER,
            self::UNSIGNED_BIG_INTEGER, self::UNSIGNED_INTEGER => 'randomNumber',
            default => 'word'
        };
    }
}
