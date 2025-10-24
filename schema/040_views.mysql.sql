-- Auto-generated from schema-views-mysql.psd1 (map@mtime:2025-10-24T09:19:46Z)
-- engine: mysql
-- table:  newsletter_subscribers
-- Contract view for [newsletter_subscribers]
-- Hides email_enc; keeps hash and status fields.
CREATE OR REPLACE VIEW vw_newsletter_subscribers AS
SELECT
  id,
  user_id,
  email_hash,
  email_hash_key_version,
  confirm_selector,
  confirm_validator_hash,
  confirm_key_version,
  confirm_expires,
  confirmed_at,
  unsubscribe_token_hash,
  unsubscribe_token_key_version,
  unsubscribed_at,
  origin,
  ip_hash,
  ip_hash_key_version,
  meta,
  created_at,
  updated_at
FROM newsletter_subscribers;
