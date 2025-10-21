-- Auto-generated from schema-map.psd1 @ 1e83bb6 (2025-10-21T10:18:36+02:00)
-- table: newsletter_subscribers
CREATE TABLE IF NOT EXISTS newsletter_subscribers (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NULL,
  email_hash BINARY(32) NULL,
  email_hash_key_version VARCHAR(64) NULL,
  email_enc LONGBLOB NULL,
  email_key_version VARCHAR(64) NULL,
  confirm_selector CHAR(12) DEFAULT NULL,
  confirm_validator_hash BINARY(32) DEFAULT NULL,
  confirm_key_version VARCHAR(64) DEFAULT NULL,
  confirm_expires DATETIME(6) DEFAULT NULL,
  confirmed_at DATETIME(6) DEFAULT NULL,
  unsubscribe_token_hash BINARY(32) DEFAULT NULL,
  unsubscribe_token_key_version VARCHAR(64) DEFAULT NULL,
  unsubscribed_at DATETIME(6) DEFAULT NULL,
  origin VARCHAR(100) DEFAULT NULL,
  ip_hash BINARY(32) DEFAULT NULL,
  ip_hash_key_version VARCHAR(64) DEFAULT NULL,
  meta JSON DEFAULT NULL,
  created_at DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  updated_at DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  UNIQUE KEY ux_ns_email_hash (email_hash),
  UNIQUE KEY ux_ns_confirm_selector (confirm_selector),
  INDEX idx_ns_user (user_id),
  INDEX idx_ns_confirm_expires (confirm_expires),
  INDEX idx_ns_unsubscribed_at (unsubscribed_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
