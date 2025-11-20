<?php
declare(strict_types=1);

namespace BlackCat\Database\Packages\NewsletterSubscribers;

use BlackCat\Database\Support\Criteria as BaseCriteria;
use BlackCat\Core\Database;

/**
 * Per-repo Criteria - thin layer on top of the central BlackCat\Database\Support\Criteria.
 *
 * Tokens filled by the generator:
 *  - FILTERABLE_COLUMNS_ARRAY   e.g., ["id","tenant_id","status","created_at"]
 *  - SEARCHABLE_COLUMNS_ARRAY   e.g., ["order_no","customer_email"]
 *  - DEFAULT_PER_PAGE           e.g., 50
 *  - MAX_PER_PAGE               e.g., 500
 *
 * All the "hard" logic (dialect, LIKE/ILIKE, NULLS LAST, tenancy, seek, join params,
 * andWhere()/bind() compatibility, etc.) lives in BaseCriteria. Here we only declare whitelists
 * and per-repo limits plus an optional fromDb() factory.
 */
final class Criteria extends BaseCriteria
{
    /** Hard clamp perPage to [1..maxPerPage] for this repo. */
    protected function perPage(): int
    {
        $pp = (int) parent::perPage();
        $pp = max(1, $pp);
        return min($pp, $this->maxPerPage());
    }

    /** Columns that are safe to use inside WHERE filters. */
    protected function filterable(): array
    {
        return [ 'id', 'tenant_id', 'user_id', 'email_hash', 'email_hash_key_version', 'email_enc', 'email_key_version', 'confirm_selector', 'confirm_validator_hash', 'confirm_key_version', 'confirm_expires', 'confirmed_at', 'unsubscribe_token_hash', 'unsubscribe_token_key_version', 'unsubscribed_at', 'origin', 'ip_hash', 'ip_hash_key_version', 'meta', 'created_at', 'updated_at', 'version' ];
    }

    /** Columns used for full-text LIKE/ILIKE searches. */
    protected function searchable(): array
    {
        return [ 'email_hash_key_version', 'email_key_version', 'confirm_selector', 'confirm_key_version', 'unsubscribe_token_key_version', 'origin', 'ip_hash_key_version' ];
    }

    /** Columns allowed in ORDER BY (falls back to filterable() when empty). */
    protected function sortable(): array
    {
        $x = [ 'id', 'tenant_id', 'user_id', 'email_hash_key_version', 'email_key_version', 'confirm_selector', 'confirm_key_version', 'confirm_expires', 'confirmed_at', 'unsubscribe_token_key_version', 'unsubscribed_at', 'origin', 'ip_hash_key_version', 'created_at', 'updated_at', 'version' ];
        return $x ?: $this->filterable();
    }

    /**
     * Whitelist of joinable entities (for safe ->join() usage):
     * e.g., [ 'orders' => 'j0', 'users' => 'j1' ]
     */
    protected function joinable(): array
    {
        /** @var array<string,string> */
        return [ 'users' => 'j0', 'tenants' => 'j1' ];
    }

    /** Default page size for this repository. */
    protected function defaultPerPage(): int
    {
        return 50;
    }

    /** Maximum allowed page size. */
    protected function maxPerPage(): int
    {
        return 500;
    }

    /**
     * QoL factory: detect dialect based on the PDO driver and optionally apply a tenancy filter.
     *
     * Example:
     *   $crit = Criteria::fromDb($db, tenantId: 42)
     *                   ->search("foo")
     *                   ->orderBy("created_at","DESC");
     */
    public static function fromDb(
        Database $db,
        int|string|array|null $tenantId = null,
        string $tenantColumn = "tenant_id",
        bool $quoteIdentifiers = false
    ): static {
        $c = new static(); // previously: new self()

        $c->setDialectFromDatabase($db);
        if ($quoteIdentifiers) { $c->quoteIdentifiers(true); }
        if ($tenantId !== null) { $c->tenant($tenantId, $tenantColumn); }

        if (\method_exists(\BlackCat\Database\Packages\NewsletterSubscribers\Definitions::class, 'softDeleteColumn')) {
            $soft = \BlackCat\Database\Packages\NewsletterSubscribers\Definitions::softDeleteColumn();
            if ($soft) { $c->softDelete($soft); }
        }
        return $c;
    }

    // --- Generated criteria helpers (per table) ---
    
    public function byId(int|string $id): self {
        return $this->where('t.id = :cid', ['cid' => $id]);
    }
    public function byIds(array $ids): self {
        if (!$ids) return $this->where('1=0');
        return $this->whereIn('t.id', array_values($ids));
    }
    /** @param int|string|array<int,int|string> $tenantId */
    public function forTenant(int|string|array $tenantId): self {
        if (is_array($tenantId)) { return $this->whereIn('t.tenant_id', $tenantId); }
        return $this->where('t.tenant_id = :tid', ['tid' => $tenantId]);
    }
    public function createdBetween(?\DateTimeInterface $from, ?\DateTimeInterface $to): self {
        return $this->range('t.created_at', $from, $to);
    }
    public function updatedSince(\DateTimeInterface $ts): self {
        return $this->where('t.updated_at >= :u', ['u' => $ts]);
    }

}
