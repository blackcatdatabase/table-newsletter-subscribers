<?php
declare(strict_types=1);

namespace BlackCat\Database\Packages\NewsletterSubscribers\Dto;

/**
 * Simple immutable DTO with public readonly properties.
 * - No logic; just a data carrier.
 * - Strong types enforce the contract across layers.
 */
final class NewsletterSubscriberDto implements \JsonSerializable {
    public function __construct(
        public readonly int $id,
        public readonly int $tenantId,
        public readonly ?int $userId,
        #[\SensitiveParameter] public readonly string $emailHash,
        public readonly ?string $emailHashKeyVersion,
        public readonly ?string $emailEnc,
        public readonly ?string $emailKeyVersion,
        public readonly ?string $confirmSelector,
        public readonly ?string $confirmValidatorHash,
        public readonly ?string $confirmKeyVersion,
        public readonly ?\DateTimeImmutable $confirmExpires,
        public readonly ?\DateTimeImmutable $confirmedAt,
        public readonly ?string $unsubscribeTokenHash,
        public readonly ?string $unsubscribeTokenKeyVersion,
        public readonly ?\DateTimeImmutable $unsubscribedAt,
        public readonly ?string $origin,
        #[\SensitiveParameter] public readonly ?string $ipHash,
        public readonly ?string $ipHashKeyVersion,
        public readonly array|null $meta,
        public readonly \DateTimeImmutable $createdAt,
        public readonly \DateTimeImmutable $updatedAt,
        public readonly int $version
    ) {}

    /** Suitable for serialization/logging (without large blobs). */
    public function toArray(): array {
        return get_object_vars($this);
    }

    /** toArray() without null values - for clean logging/diffs. */
    public function toArrayNonNull(): array {
        return array_filter(get_object_vars($this), static fn($v) => $v !== null);
    }

    public function jsonSerialize(): array {
       $a = $this->toArray();
       foreach ($a as $k => $v) {
           if ($v instanceof \DateTimeInterface) {
               // ISO-8601 with a timezone; switch to 'Y-m-d H:i:s.u' if needed
               $a[$k] = $v->format(\DateTimeInterface::ATOM);
           }
       }
       return $a;
   }
}
