# 📦 Newsletter Subscribers

![SQL](https://img.shields.io/badge/SQL-MySQL%208.0%2B-4479A1?logo=mysql&logoColor=white) ![License](https://img.shields.io/badge/license-BlackCat%20Proprietary-red) ![Status](https://img.shields.io/badge/status-stable-informational) ![Generated](https://img.shields.io/badge/generated-from%20schema--map-blue)

<!-- Auto-generated from schema-map-postgres.psd1 @ 62c9c93 (2025-11-20T21:38:11+01:00) -->

> Schema package for table **newsletter_subscribers** (repo: `newsletter-subscribers`).

## Files
```
schema/
  001_table.sql
  020_indexes.sql
  030_foreign_keys.sql
```

## Quick apply
```bash
# Apply schema (Linux/macOS):
mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < schema/001_table.sql
mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < schema/020_indexes.sql
mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < schema/030_foreign_keys.sql
```

```powershell
# Apply schema (Windows PowerShell):
mysql -h $env:DB_HOST -u $env:DB_USER -p$env:DB_PASS $env:DB_NAME < schema/001_table.sql
mysql -h $env:DB_HOST -u $env:DB_USER -p$env:DB_PASS $env:DB_NAME < schema/020_indexes.sql
mysql -h $env:DB_HOST -u $env:DB_USER -p$env:DB_PASS $env:DB_NAME < schema/030_foreign_keys.sql
```

## Docker quickstart
```bash
# Spin up a throwaway MySQL and apply just this package:
docker run --rm -e MYSQL_ROOT_PASSWORD=root -e MYSQL_DATABASE=app -p 3307:3306 -d mysql:8
sleep 15
mysql -h 127.0.0.1 -P 3307 -u root -proot app < schema/001_table.sql
mysql -h 127.0.0.1 -P 3307 -u root -proot app < schema/020_indexes.sql
mysql -h 127.0.0.1 -P 3307 -u root -proot app < schema/030_foreign_keys.sql
```

## Columns
| Column | Type | Null | Default | Extra |
|-------:|:-----|:----:|:--------|:------|
| id | BIGINT | — | AS | PK |
| tenant_id | BIGINT | NO | — |  |
| user_id | BIGINT | YES | — |  |
| email_hash | BYTEA | NO | — |  |
| email_hash_key_version | VARCHAR(64) | YES | — |  |
| email_enc | BYTEA | YES | — |  |
| email_key_version | VARCHAR(64) | YES | — |  |
| confirm_selector | CHAR(12) | YES | NULL |  |
| confirm_validator_hash | BYTEA | YES | NULL |  |
| confirm_key_version | VARCHAR(64) | YES | NULL |  |
| confirm_expires | TIMESTAMPTZ(6) | YES | NULL |  |
| confirmed_at | TIMESTAMPTZ(6) | YES | NULL |  |
| unsubscribe_token_hash | BYTEA | YES | NULL |  |
| unsubscribe_token_key_version | VARCHAR(64) | YES | NULL |  |
| unsubscribed_at | TIMESTAMPTZ(6) | YES | NULL |  |
| origin | VARCHAR(100) | YES | NULL |  |
| ip_hash | BYTEA | YES | NULL |  |
| ip_hash_key_version | VARCHAR(64) | YES | NULL |  |
| meta | JSONB | YES | NULL |  |
| created_at | TIMESTAMPTZ(6) | NO | CURRENT_TIMESTAMP(6) |  |
| updated_at | TIMESTAMPTZ(6) | NO | CURRENT_TIMESTAMP(6) |  |
| version | INTEGER | NO | 0 |  |

## Relationships
- FK → **tenants** via (tenant_id) (ON DELETE RESTRICT).
- FK → **users** via (user_id) (ON DELETE SET NULL).

```mermaid
erDiagram
  NEWSLETTER_SUBSCRIBERS {
    INT id PK
    INT tenant_id
    INT user_id
    BYTEA email_hash
    VARCHAR email_hash_key_version
    BYTEA email_enc
    VARCHAR email_key_version
    VARCHAR confirm_selector
    BYTEA confirm_validator_hash
    VARCHAR confirm_key_version
    TIMESTAMPTZ confirm_expires
    TIMESTAMPTZ confirmed_at
    BYTEA unsubscribe_token_hash
    VARCHAR unsubscribe_token_key_version
    TIMESTAMPTZ unsubscribed_at
    VARCHAR origin
    BYTEA ip_hash
    VARCHAR ip_hash_key_version
    JSONB meta
    TIMESTAMPTZ created_at
    TIMESTAMPTZ updated_at
    INTEGER version
  }
  NEWSLETTER_SUBSCRIBERS }o--|| TENANTS : "tenant_id"
  NEWSLETTER_SUBSCRIBERS }o--|| USERS : "user_id"
```

## Indexes
- 7 deferred index statement(s) in schema/020_indexes.sql.

## Notes
- Generated from the umbrella repository **blackcat-database** using `scripts/schema-map.psd1`.
- To change the schema, update the map and re-run the generators.

## License
Distributed under the **BlackCat Store Proprietary License v1.0**. See `LICENSE`.
