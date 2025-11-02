-- Auto-generated from schema-views-postgres.psd1 (map@db2f8b8)
-- engine: postgres
-- table:  newsletter_subscribers
-- Contract view for [newsletter_subscribers]
-- Hides email_enc; adds hex helpers for hashes.
CREATE OR REPLACE VIEW vw_newsletter_subscribers AS
SELECT
  id,
  user_id,
  email_hash,
  UPPER(encode(email_hash,'hex'))::char(64) AS email_hash_hex,
  email_hash_key_version,
  confirm_selector,
  confirm_validator_hash,
  UPPER(encode(confirm_validator_hash,'hex'))::char(64) AS confirm_validator_hash_hex,
  confirm_key_version,
  confirm_expires,
  confirmed_at,
  unsubscribe_token_hash,
  UPPER(encode(unsubscribe_token_hash,'hex'))::char(64) AS unsubscribe_token_hash_hex,
  unsubscribe_token_key_version,
  unsubscribed_at,
  origin,
  ip_hash,
  UPPER(encode(ip_hash,'hex'))::char(32) AS ip_hash_hex,
  ip_hash_key_version,
  meta,
  created_at,
  updated_at,
  version,
  UPPER(encode(email_enc,'hex'))::char(64) AS email_enc_hex
FROM newsletter_subscribers;
