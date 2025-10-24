<?php
declare(strict_types=1);

namespace BlackCat\Database\Packages\NewsletterSubscribers\Mapper;

use BlackCat\Database\Packages\NewsletterSubscribers\Dto\NewsletterSubscriberDto;
use DateTimeImmutable;
use DateTimeZone;

/**
 * Obousměrný mapovač řádek DB <-> DTO:
 * - bezpečné casty dle whitelistů sloupců (bool/int/float/json/date/binary)
 * - mapování názvů sloupců na vlastnosti DTO (COLUMNS_TO_PROPS_MAP)
 * - tolerantní k chybějícím sloupcům (ponechá null)
 */
final class NewsletterSubscriberDtoMapper
{
    /** @var array<string,string> */
    private const COL_TO_PROP = [ 'user_id' => 'userId', 'email_hash' => 'emailHash', 'email_hash_key_version' => 'emailHashKeyVersion', 'email_enc' => 'emailEnc', 'email_key_version' => 'emailKeyVersion', 'confirm_selector' => 'confirmSelector', 'confirm_validator_hash' => 'confirmValidatorHash', 'confirm_key_version' => 'confirmKeyVersion', 'confirm_expires' => 'confirmExpires', 'confirmed_at' => 'confirmedAt', 'unsubscribe_token_hash' => 'unsubscribeTokenHash', 'unsubscribe_token_key_version' => 'unsubscribeTokenKeyVersion', 'unsubscribed_at' => 'unsubscribedAt', 'ip_hash' => 'ipHash', 'ip_hash_key_version' => 'ipHashKeyVersion', 'created_at' => 'createdAt', 'updated_at' => 'updatedAt' ];
    /** @var string[] */
    private const BOOL_COLS   = [];
    /** @var string[] */
    private const INT_COLS    = [ 'id', 'user_id' ];
    /** @var string[] */
    private const FLOAT_COLS  = [];
    /** @var string[] */
    private const JSON_COLS   = [ 'meta' ];
    /** @var string[] */
    private const DATE_COLS   = [ 'confirm_expires', 'confirmed_at', 'unsubscribed_at', 'created_at', 'updated_at' ];
    /** @var string[] */
    private const BIN_COLS    = [ 'email_hash', 'email_enc', 'confirm_validator_hash', 'unsubscribe_token_hash', 'ip_hash' ];

    private const TZ = 'UTC';

    private static function colToProp(string $col): string {
        return self::COL_TO_PROP[$col] ?? $col; // fallback 1:1
    }
    private static function propToCol(string $prop): string {
        static $rev = null;
        if ($rev === null) { $rev = array_flip(self::COL_TO_PROP); }
        return $rev[$prop] ?? $prop;
    }

    private static function toBool(mixed $v): ?bool {
        if ($v === null || $v === '') return null;
        return match (true) {
            is_bool($v)   => $v,
            is_int($v)    => $v !== 0,
            is_string($v) => $v !== '' && $v !== '0',
            default       => (bool)$v,
        };
    }
    private static function toInt(mixed $v): ?int {
        if ($v === null || $v === '') return null;
        return (int)$v;
    }
    private static function toFloat(mixed $v): ?float {
        if ($v === null || $v === '') return null;
        return (float)$v;
    }
    private static function toDate(mixed $v): ?DateTimeImmutable {
        if ($v === null || $v === '') return null;
        $tz = new DateTimeZone(self::TZ);
        if ($v instanceof DateTimeImmutable) return $v->setTimezone($tz);
        return new DateTimeImmutable((string)$v, $tz);
    }

    private static function decodeJson(mixed $v): ?array {
        if ($v === null) return null;
        if (is_array($v)) return $v;
        if ($v instanceof \stdClass) return (array)$v;

        if (is_string($v)) {
            $t = trim($v);
            if ($t === '' || $t === 'null') return null;
            try {
                return json_decode($t, true, 512, JSON_THROW_ON_ERROR);
            } catch (\JsonException) {
                $x = json_decode($t, true); // best-effort bez výjimky
                return is_array($x) ? $x : null;
            }
        }
        // poslední možnost – „nějaké“ pole
        return (array)$v;
    }

    /**
     * Hydratuje DTO z řádku (sloupce -> vlastnosti + casty).
     */
    public static function fromRow(array $row): NewsletterSubscriberDto {
        $vals = [];

        foreach ($row as $col => $val) {
            $prop = self::colToProp((string)$col);

            if (in_array($col, self::BOOL_COLS, true))      { $val = self::toBool($val); }
            elseif (in_array($col, self::INT_COLS, true))   { $val = self::toInt($val); }
            elseif (in_array($col, self::FLOAT_COLS, true)) { $val = self::toFloat($val); }
            elseif (in_array($col, self::JSON_COLS, true))  { $val = self::decodeJson($val); }
            elseif (in_array($col, self::DATE_COLS, true))  { $val = self::toDate($val); }
            // BIN_COLS ponecháváme jako raw string/resource

            $vals[$prop] = $val;
        }

        $rc   = new \ReflectionClass(NewsletterSubscriberDto::class);
        $ctor = $rc->getConstructor();

        if ($ctor === null || $ctor->getNumberOfRequiredParameters() === 0) {
            return $rc->newInstance();
        }

        $ordered = [];
        foreach ($ctor->getParameters() as $p) {
            $name = $p->getName();
            $ordered[] = $vals[$name] ?? ($p->isDefaultValueAvailable() ? $p->getDefaultValue() : null);
        }
        return $rc->newInstanceArgs($ordered);
    }

    /**
     * Mapuje DTO zpět na asociativní řádek pro DB (insert/update).
     * - JSON sloupce se enkódují JSONem.
     * - DATETIME se formátuje na 'Y-m-d H:i:s.u' (MySQL DATETIME(6) / PG timestamptz).
     * - bool -> 0/1 (kvůli MySQL).
     */
    public static function toRow(NewsletterSubscriberDto $dto, ?array $onlyProps = null): array {
        $out = [];
        $src = $dto->toArray();

        if ($onlyProps !== null) {
            $src = array_intersect_key($src, array_fill_keys($onlyProps, true));
        }

        foreach ($src as $prop => $val) {
            $col = self::propToCol((string)$prop);

            if (in_array($col, self::JSON_COLS, true)) {
                $val = $val === null ? null : json_encode(
                    $val,
                    JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR
                );
            } elseif (in_array($col, self::DATE_COLS, true)) {
                if ($val instanceof DateTimeImmutable) {
                    $val = $val->format('Y-m-d H:i:s.u');
                } elseif ($val !== null && $val !== '') {
                    $val = (new DateTimeImmutable((string)$val, new DateTimeZone(self::TZ)))->format('Y-m-d H:i:s.u');
                } else {
                    $val = null;
                }
            } elseif (in_array($col, self::BOOL_COLS, true)) {
                $val = $val === null ? null : ($val ? 1 : 0);
            } elseif (in_array($col, self::INT_COLS, true)) {
                $val = $val === null ? null : (int)$val;
            } elseif (in_array($col, self::FLOAT_COLS, true)) {
                $val = $val === null ? null : (float)$val;
            }
            // BIN_COLS ponecháváme beze změny

            $out[$col] = $val;
        }
        return $out;
    }

    /** Batch varianta: mapuje pole řádků na pole DTO. */
    public static function hydrateList(array $rows): array {
        $out = [];
        foreach ($rows as $r) { $out[] = self::fromRow($r); }
        return $out;
    }
}
