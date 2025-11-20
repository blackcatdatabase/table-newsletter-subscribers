<!-- Auto-generated from schema-map-postgres.psd1 @ 62c9c93 (2025-11-20T21:38:11+01:00) -->
# Definition – newsletter_subscribers

Newsletter subscription registry with double opt-in. email_hash is UNIQUE; confirm_selector is UNIQUE.

## Columns
| Column | Type | Null | Default | Description | Notes |
|-------:|:-----|:----:|:--------|:------------|:------|
| id | BIGINT | — | AS | Surrogate primary key. |  |
| tenant_id | BIGINT | NO | — |  |  |
| user_id | BIGINT | YES | — | Related user (optional). |  |
| email_hash | BYTEA | NO | — | Hashed email value (UNIQUE). | PII: hashed |
| email_hash_key_version | VARCHAR(64) | YES | — | Key version for email_hash. |  |
| email_enc | BYTEA | YES | — | Encrypted email address. | PII: encrypted |
| email_key_version | VARCHAR(64) | YES | — | Key version for email_enc. |  |
| confirm_selector | CHAR(12) | YES | NULL | Public selector for confirmation (UNIQUE). |  |
| confirm_validator_hash | BYTEA | YES | NULL | Hashed validator token. | PII: hashed |
| confirm_key_version | VARCHAR(64) | YES | NULL | Key version for confirmation hash. |  |
| confirm_expires | TIMESTAMPTZ(6) | YES | NULL | Confirmation expiry (UTC). |  |
| confirmed_at | TIMESTAMPTZ(6) | YES | NULL | Confirmation timestamp (UTC). |  |
| unsubscribe_token_hash | BYTEA | YES | NULL | Hashed unsubscribe token. | PII: hashed |
| unsubscribe_token_key_version | VARCHAR(64) | YES | NULL | Key version for unsubscribe hash. |  |
| unsubscribed_at | TIMESTAMPTZ(6) | YES | NULL | Unsubscribe timestamp (UTC). |  |
| origin | VARCHAR(100) | YES | NULL | Acquisition source (e.g., form, import). |  |
| ip_hash | BYTEA | YES | NULL | Hashed IP of action. | PII: hashed |
| ip_hash_key_version | VARCHAR(64) | YES | NULL | Key version for ip_hash. |  |
| meta | JSONB | YES | NULL | JSON metadata (UTM, tags). |  |
| created_at | TIMESTAMPTZ(6) | NO | CURRENT_TIMESTAMP(6) | Creation timestamp (UTC). |  |
| updated_at | TIMESTAMPTZ(6) | NO | CURRENT_TIMESTAMP(6) | Update timestamp (UTC). |  |
| version | INTEGER | NO | 0 |  |  |