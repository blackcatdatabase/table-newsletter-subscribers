-- Auto-generated from schema-views-postgres.psd1 (map@c5e4097)
-- engine: postgres
-- table:  newsletter_subscribers
-- Contract view for [newsletter_subscribers]
-- Hides email_enc; adds hex helpers for hashes.
CREATE OR REPLACE VIEW vw_newsletter_subscribers AS
SELECT
  id,
  user_id,
  email_hash,
  encode(email_hash, 'hex') AS email_hash_hex,
  email_hash_key_version,
  confirm_selector,
  confirm_validator_hash,
  encode(confirm_validator_hash, 'hex') AS confirm_validator_hash_hex,
  confirm_key_version,
  confirm_expires,
  confirmed_at,
  unsubscribe_token_hash,
  encode(unsubscribe_token_hash, 'hex') AS unsubscribe_token_hash_hex,
  unsubscribe_token_key_version,
  unsubscribed_at,
  origin,
  ip_hash,
  encode(ip_hash, 'hex') AS ip_hash_hex,
  ip_hash_key_version,
  meta,
  created_at,
  updated_at,
  version,
  encode(email_enc, 'hex') AS email_enc_hex
FROM newsletter_subscribers;
