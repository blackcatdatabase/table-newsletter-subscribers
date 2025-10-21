# 📦 Newsletter Subscribers

![SQL](https://img.shields.io/badge/SQL-MySQL%208.0%2B-4479A1?logo=mysql&logoColor=white) ![License](https://img.shields.io/badge/license-BlackCat%20Proprietary-red) ![Status](https://img.shields.io/badge/status-stable-informational) ![Generated](https://img.shields.io/badge/generated-from%20schema--map-blue)

<!-- Auto-generated from schema-map.psd1 @ 1e83bb6 (2025-10-21T10:18:36+02:00) -->

> Schema package for table **newsletter_subscribers** (repo: `newsletter-subscribers`).

## Files
```
schema/
  001_table.sql
  # (no deferred indexes declared in map)
  030_foreign_keys.sql
```

## Quick apply
```bash
# Apply schema (Linux/macOS):
mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < schema/001_table.sql
mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < schema/030_foreign_keys.sql
```

```powershell
# Apply schema (Windows PowerShell):
mysql -h $env:DB_HOST -u $env:DB_USER -p$env:DB_PASS $env:DB_NAME < schema/001_table.sql
mysql -h $env:DB_HOST -u $env:DB_USER -p$env:DB_PASS $env:DB_NAME < schema/030_foreign_keys.sql
```

## Docker quickstart
```bash
# Spin up a throwaway MySQL and apply just this package:
docker run --rm -e MYSQL_ROOT_PASSWORD=root -e MYSQL_DATABASE=app -p 3307:3306 -d mysql:8
sleep 15
mysql -h 127.0.0.1 -P 3307 -u root -proot app < schema/001_table.sql
mysql -h 127.0.0.1 -P 3307 -u root -proot app < schema/030_foreign_keys.sql
```

## Columns
| Column | Type | Null | Default | Extra |
|-------:|:-----|:----:|:--------|:------|
| id | BIGINT UNSIGNED | — | — | AUTO_INCREMENT, PK |
| user_id | BIGINT UNSIGNED | YES | — |  |
| email_hash | BINARY(32) | YES | — |  |
| email_hash_key_version | VARCHAR(64) | YES | — |  |
| email_enc | LONGBLOB | YES | — |  |
| email_key_version | VARCHAR(64) | YES | — |  |
| confirm_selector | CHAR(12) | YES | NULL |  |
| confirm_validator_hash | BINARY(32) | YES | NULL |  |
| confirm_key_version | VARCHAR(64) | YES | NULL |  |
| confirm_expires | DATETIME(6) | YES | NULL |  |
| confirmed_at | DATETIME(6) | YES | NULL |  |
| unsubscribe_token_hash | BINARY(32) | YES | NULL |  |
| unsubscribe_token_key_version | VARCHAR(64) | YES | NULL |  |
| unsubscribed_at | DATETIME(6) | YES | NULL |  |
| origin | VARCHAR(100) | YES | NULL |  |
| ip_hash | BINARY(32) | YES | NULL |  |
| ip_hash_key_version | VARCHAR(64) | YES | NULL |  |
| meta | JSON | YES | NULL |  |
| created_at | DATETIME(6) | NO | CURRENT_TIMESTAMP(6) |  |
| updated_at | DATETIME(6) | NO | CURRENT_TIMESTAMP(6) |  |

## Relationships
- FK → **users** via (user_id) (ON DELETE SET NULL).

```mermaid
erDiagram
  NEWSLETTER_SUBSCRIBERS {
    INT id PK
    INT user_id
    BLOB email_hash
    VARCHAR email_hash_key_version
    BLOB email_enc
    VARCHAR email_key_version
    VARCHAR confirm_selector
    BLOB confirm_validator_hash
    VARCHAR confirm_key_version
    DATETIME confirm_expires
    DATETIME confirmed_at
    BLOB unsubscribe_token_hash
    VARCHAR unsubscribe_token_key_version
    DATETIME unsubscribed_at
    VARCHAR origin
    BLOB ip_hash
    VARCHAR ip_hash_key_version
    JSON meta
    DATETIME created_at
    DATETIME updated_at
  }
  NEWSLETTER_SUBSCRIBERS }o--|| USERS : "user_id"
```

## Indexes
- No deferred indexes declared for this table.

## Notes
- Generated from the umbrella repository **blackcat-database** using `scripts/schema-map.psd1`.
- To change the schema, update the map and re-run the generators.

## License
Distributed under the **BlackCat Store Proprietary License v1.0**. See `LICENSE`.

