-- Auto-generated from schema-views-mysql.psd1 (map@38d5403)
-- engine: mysql
-- table:  newsletter_subscribers
-- Contract view for [newsletter_subscribers]
-- Hides email_enc; adds HEX helpers for hashes.
CREATE OR REPLACE SQL SECURITY INVOKER VIEW vw_newsletter_subscribers AS
SELECT
  id,
  user_id,
  email_hash,
  HEX(email_hash) AS email_hash_hex,
  email_hash_key_version,
  confirm_selector,
  confirm_validator_hash,
  HEX(confirm_validator_hash) AS confirm_validator_hash_hex,
  confirm_key_version,
  confirm_expires,
  confirmed_at,
  unsubscribe_token_hash,
  HEX(unsubscribe_token_hash) AS unsubscribe_token_hash_hex,
  unsubscribe_token_key_version,
  unsubscribed_at,
  origin,
  ip_hash,
  HEX(ip_hash) AS ip_hash_hex,
  ip_hash_key_version,
  meta,
  created_at,
  updated_at
FROM newsletter_subscribers;
