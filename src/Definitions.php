<?php
declare(strict_types=1);

namespace BlackCat\Database\Packages\NewsletterSubscribers;

final class Definitions {
    // --- základní metadata ---
    public static function table(): string { return 'newsletter_subscribers'; }
    public static function contractView(): string { return 'v_newsletter_subscribers_contract'; }
    /** @return string[] */
    public static function columns(): array { return [ 'id', 'user_id', 'email_hash', 'email_hash_key_version', 'email_enc', 'email_key_version', 'confirm_selector', 'confirm_validator_hash', 'confirm_key_version', 'confirm_expires', 'confirmed_at', 'unsubscribe_token_hash', 'unsubscribe_token_key_version', 'unsubscribed_at', 'origin', 'ip_hash', 'ip_hash_key_version', 'meta', 'created_at', 'updated_at' ]; }
    public static function pk(): string { return 'id'; }

    // --- volitelná metadata (mohou být prázdná) ---
    public static function softDeleteColumn(): ?string {
        $c = ''; return $c !== '' ? $c : null;
    }
    public static function updatedAtColumn(): ?string {
        $c = 'updated_at'; return $c !== '' ? $c : null;
    }
    public static function versionColumn(): ?string {
        $c = ''; return $c !== '' ? $c : null; // pro optimistic locking
    }
    /** např. "created_at DESC, id DESC" */
    public static function defaultOrder(): ?string {
        $c = 'created_at DESC, id DESC'; return $c !== '' ? $c : null;
    }
    /** @return array<int,array<int,string>> seznam unikátních klíčů (sloupcových kombinací) */
    public static function uniqueKeys(): array { return []; }
    /** @return string[] JSON sloupce kvůli castům/operacím */
    public static function jsonColumns(): array { return [ 'meta' ]; }

    // --- pomocníci ---
    public static function hasColumn(string $col): bool {
        static $set = null;
        if ($set === null) { $set = array_fill_keys(self::columns(), true); }
        return isset($set[$col]);
    }
}
