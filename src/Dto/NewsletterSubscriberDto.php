<?php
declare(strict_types=1);

namespace BlackCat\Database\Packages\NewsletterSubscribers\Dto;

/**
 * Jednoduché, neměnné DTO s veřejnými readonly vlastnostmi.
 * - Bez logiky; pouze nosič dat.
 * - Silné typy drží kontrakt napříč vrstvami.
 */
final class NewsletterSubscriberDto {
    public function __construct(
        public readonly ?int $id,
        public readonly ?int $userId,
        public readonly string $emailHash,
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
        public readonly ?string $ipHash,
        public readonly ?string $ipHashKeyVersion,
        public readonly array|null $meta,
        public readonly \DateTimeImmutable $createdAt,
        public readonly \DateTimeImmutable $updatedAt,
        public readonly int $version
    ) {}

    /** Vhodné pro serializaci/logování (bez velkých blobů). */
    public function toArray(): array {
        return get_object_vars($this);
    }
}
