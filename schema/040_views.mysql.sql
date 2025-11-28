-- Auto-generated from schema-views-mysql.psd1 (map@mtime:2025-11-27T15:35:35Z)
-- engine: mysql
-- table:  newsletter_subscribers

-- Contract view for [newsletter_subscribers]
-- Hides email_enc; adds HEX helpers for hashes.
CREATE OR REPLACE ALGORITHM=MERGE SQL SECURITY INVOKER VIEW vw_newsletter_subscribers AS
SELECT
  id,
  tenant_id,
  user_id,
  email_enc,
  email_hash,
  CAST(LPAD(HEX(email_hash), 64, '0') AS CHAR(64)) AS email_hash_hex,
  email_hash_key_version,
  confirm_selector,
  CAST(LPAD(HEX(confirm_validator_hash), 64, '0') AS CHAR(64)) AS confirm_validator_hash_hex,
  confirm_key_version,
  confirm_expires,
  confirmed_at,
  CAST(LPAD(HEX(unsubscribe_token_hash), 64, '0') AS CHAR(64)) AS unsubscribe_token_hash_hex,
  unsubscribe_token_key_version,
  unsubscribed_at,
  origin,
  ip_hash,
  CAST(LPAD(HEX(ip_hash), 64, '0')  AS CHAR(64)) AS ip_hash_hex,
  ip_hash_key_version,
  meta,
  created_at,
  updated_at,
  version,
  CAST(LPAD(HEX(email_enc), 64, '0') AS CHAR(64)) AS email_enc_hex
FROM newsletter_subscribers;
