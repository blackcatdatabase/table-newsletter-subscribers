<?php
declare(strict_types=1);

namespace BlackCat\Database\Packages\NewsletterSubscribers\Service;

use BlackCat\Core\Database\Database;
use BlackCat\Database\Packages\NewsletterSubscribers\Dto\NewsletterSubscriberDto;
use BlackCat\Database\Packages\NewsletterSubscribers\Mapper\NewsletterSubscriberDtoMapper;
use BlackCat\Database\Packages\NewsletterSubscribers\Repository\NewsletterSubscriberRepository;

/**
 * Orchestruje více repozitářů v **jedné transakci**.
 * - Idempotentní vzory (zámky, verze) nechává na vrstvě Repository/DB.
 * - Zde řešíme business workflow přes hranice tabulek.
 */
final class NewsletterSubscribersAggregateService
{
    public function __construct(
        private Database $db, private NewsletterSubscriberRepository $newsletterSubscriberRepo
    ) {}

    /**
     * Vykoná akci v transakci – adaptuje se na dostupné API DB wrapperu.
     * Předpoklad:
     *   - pokud existuje Database::transaction(callable): mixed, použijeme jej
     *   - jinak fallback begin/commit/rollback
     */
    private function runInTransaction(callable $fn): mixed {
        if (method_exists($this->db, 'transaction')) {
            return $this->db->transaction($fn);
        }
        if (method_exists($this->db, 'beginTransaction')
            && method_exists($this->db, 'commit')
            && method_exists($this->db, 'rollBack')) {
            $this->db->beginTransaction();
            try {
                $res = $fn($this->db);
                $this->db->commit();
                return $res;
            } catch (\Throwable $e) {
                $this->db->rollBack();
                throw $e;
            }
        }
        // nouzově (neatomické) – ale aspoň nezabrání běhu v testech
        return $fn($this->db);
    }


}
