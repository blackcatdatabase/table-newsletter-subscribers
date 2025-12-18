-- Auto-generated from schema-views-postgres.yaml (map@sha1:3C365C10BD489376A27944AE10F143E1BE4D3BCF)
-- engine: postgres
-- table:  newsletter_subscribers

-- Contract view for [newsletter_subscribers]
-- Hides email_enc; adds hex helpers for hashes.
CREATE OR REPLACE VIEW vw_newsletter_subscribers AS
SELECT
  id,
  tenant_id,
  user_id,
  email_enc,
  UPPER(encode(email_enc,'hex')) AS email_enc_hex,
  email_hash,
  UPPER(encode(email_hash,'hex')) AS email_hash_hex,
  email_hash_key_version,
  confirm_selector,
  UPPER(encode(confirm_validator_hash,'hex')) AS confirm_validator_hash_hex,
  confirm_key_version,
  confirm_expires,
  confirmed_at,
  UPPER(encode(unsubscribe_token_hash,'hex')) AS unsubscribe_token_hash_hex,
  unsubscribe_token_key_version,
  unsubscribed_at,
  origin,
  ip_hash,
  UPPER(encode(ip_hash,'hex')) AS ip_hash_hex,
  ip_hash_key_version,
  meta,
  created_at,
  updated_at,
  version
FROM newsletter_subscribers;
