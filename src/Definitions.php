<?php
declare(strict_types=1);

namespace BlackCat\Database\Packages\NewsletterSubscribers;

final class Definitions {
    // --- základní metadata ---
    public static function table(): string { return 'newsletter_subscribers'; }
    public static function contractView(): string { return 'vw_newsletter_subscribers'; }
    /** @return string[] */
    public static function columns(): array { return [ 'id', 'user_id', 'email_hash', 'email_hash_key_version', 'email_enc', 'email_key_version', 'confirm_selector', 'confirm_validator_hash', 'confirm_key_version', 'confirm_expires', 'confirmed_at', 'unsubscribe_token_hash', 'unsubscribe_token_key_version', 'unsubscribed_at', 'origin', 'ip_hash', 'ip_hash_key_version', 'meta', 'created_at', 'updated_at', 'version' ]; }
    public static function pk(): string { return 'id'; }

    // --- volitelná metadata ---
    public static function softDeleteColumn(): ?string {
        $c = ''; return $c !== '' ? $c : null;
    }
    public static function updatedAtColumn(): ?string {
        $c = 'updated_at'; return $c !== '' ? $c : null;
    }
    public static function versionColumn(): ?string {
        $c = 'version'; return $c !== '' ? $c : null;
    }
    /** např. "created_at DESC, id DESC" */
    public static function defaultOrder(): ?string {
        $c = 'created_at DESC, id DESC'; return $c !== '' ? $c : null;
    }
    /** @return array<int,array<int,string>> seznam unikátních klíčů */
    public static function uniqueKeys(): array { return [ [ 'email_hash' ], [ 'confirm_selector' ] ]; }
    /** @return string[] JSON sloupce kvůli castům/operacím */
    public static function jsonColumns(): array { return [ 'meta' ]; }

    // --- pomocníci ---
    public static function hasColumn(string $col): bool {
        static $set = null;
        if ($set === null) { $set = array_fill_keys(self::columns(), true); }
        return isset($set[$col]);
    }

    /**
     * identity | uuid | natural | composite
     */
    public static function pkStrategy(): string {
        $c = 'identity';
        return $c !== '' ? $c : 'natural';
    }

    public static function isIdentityPk(): bool {
        return self::pkStrategy() === 'identity';
    }

    /** True, pokud je tabulka vhodná pro testy row-locků (bez kaskád/FK, malá šíře řádku apod.). */
    public static function isRowLockSafe(): bool {
        return false;
    }

    /** Pohodlný alias – má tabulka verzi pro optimistic locking? */
    public static function supportsOptimisticLocking(): bool {
        return self::versionColumn() !== null;
    }

    /** Pro JSON casty/operace – rychlý test bez vytváření setu. */
    public static function hasJsonColumn(string $col): bool {
        static $set = null;
        if ($set === null) { $set = array_fill_keys(self::jsonColumns(), true); }
        return isset($set[$col]);
    }

    public static function isSoftDeleteEnabled(): bool { return self::softDeleteColumn() !== null; }
}
