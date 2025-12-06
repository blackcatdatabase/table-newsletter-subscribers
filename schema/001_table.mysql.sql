-- Auto-generated from schema-map-mysql.yaml (map@sha1:5E62933580349BE7C623D119AC9D1301A62F03EF)
-- engine: mysql
-- table:  newsletter_subscribers

CREATE TABLE IF NOT EXISTS newsletter_subscribers (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  tenant_id BIGINT UNSIGNED NOT NULL,
  user_id BIGINT UNSIGNED NULL,
  email_hash BINARY(32) NOT NULL,
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
  version INT UNSIGNED NOT NULL DEFAULT 0,
  UNIQUE KEY ux_ns_tenant_email_hash (tenant_id, email_hash),
  UNIQUE KEY ux_ns_confirm_selector (confirm_selector),
  INDEX idx_ns_tenant (tenant_id),
  INDEX idx_ns_user (user_id),
  INDEX idx_ns_confirm_expires (confirm_expires),
  INDEX idx_ns_unsubscribed_at (unsubscribed_at),
  INDEX idx_ns_confirmed_at (confirmed_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
