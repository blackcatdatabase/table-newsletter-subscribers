<!-- Auto-generated from schema-map.psd1 @ 1e83bb6 (2025-10-21T10:18:36+02:00) -->
# Definition – newsletter_subscribers

Newsletter subscription registry with double opt-in.

## Columns
| Column | Type | Null | Default | Description | Notes |
|-------:|:-----|:----:|:--------|:------------|:------|
| id | BIGINT UNSIGNED | — | — | Surrogate primary key. |  |
| user_id | BIGINT UNSIGNED | YES | — | Related user (optional). |  |
| email_hash | BINARY(32) | YES | — | Hashed email value. | PII: hashed |
| email_hash_key_version | VARCHAR(64) | YES | — | Key version for email_hash. |  |
| email_enc | LONGBLOB | YES | — | Encrypted email address. | PII: encrypted |
| email_key_version | VARCHAR(64) | YES | — | Key version for email_enc. |  |
| confirm_selector | CHAR(12) | YES | NULL | Public selector for confirmation (unique). |  |
| confirm_validator_hash | BINARY(32) | YES | NULL | Hashed validator token. | PII: hashed |
| confirm_key_version | VARCHAR(64) | YES | NULL | Key version for confirmation hash. |  |
| confirm_expires | DATETIME(6) | YES | NULL | Confirmation expiry (UTC). |  |
| confirmed_at | DATETIME(6) | YES | NULL | Confirmation timestamp (UTC). |  |
| unsubscribe_token_hash | BINARY(32) | YES | NULL | Hashed unsubscribe token. | PII: hashed |
| unsubscribe_token_key_version | VARCHAR(64) | YES | NULL | Key version for unsubscribe hash. |  |
| unsubscribed_at | DATETIME(6) | YES | NULL | Unsubscribe timestamp (UTC). |  |
| origin | VARCHAR(100) | YES | NULL | Acquisition source (e.g., form, import). |  |
| ip_hash | BINARY(32) | YES | NULL | Hashed IP of action. | PII: hashed |
| ip_hash_key_version | VARCHAR(64) | YES | NULL | Key version for ip_hash. |  |
| meta | JSON | YES | NULL | JSON metadata (UTM, tags). |  |
| created_at | DATETIME(6) | NO | CURRENT_TIMESTAMP(6) | Creation timestamp (UTC). |  |
| updated_at | DATETIME(6) | NO | CURRENT_TIMESTAMP(6) | Update timestamp (UTC). |  |