# newsletter_subscribers

Newsletter subscription registry with double opt-in. email_hash is UNIQUE; confirm_selector is UNIQUE.

## Columns
| Column | Type | Null | Default | Description |
| --- | --- | --- | --- | --- |
| confirmed_at | mysql: DATETIME(6) / postgres: TIMESTAMPTZ(6) | YES | NULL | Confirmation timestamp (UTC). |
| confirm_expires | mysql: DATETIME(6) / postgres: TIMESTAMPTZ(6) | YES | NULL | Confirmation expiry (UTC). |
| confirm_key_version | VARCHAR(64) | YES | NULL | Key version for confirmation hash. |
| confirm_selector | CHAR(12) | YES | NULL | Public selector for confirmation (UNIQUE). |
| confirm_validator_hash | mysql: BINARY(32) / postgres: BYTEA | YES | NULL | Hashed validator token. |
| created_at | mysql: DATETIME(6) / postgres: TIMESTAMPTZ(6) | NO | CURRENT_TIMESTAMP(6) | Creation timestamp (UTC). |
| email_enc | mysql: LONGBLOB / postgres: BYTEA | YES |  | Encrypted email address. |
| email_hash | mysql: BINARY(32) / postgres: BYTEA | NO |  | Hashed email value (UNIQUE). |
| email_hash_key_version | VARCHAR(64) | YES |  | Key version for email_hash. |
| email_key_version | VARCHAR(64) | YES |  | Key version for email_enc. |
| id | BIGINT | NO |  | Surrogate primary key. |
| ip_hash | mysql: BINARY(32) / postgres: BYTEA | YES | NULL | Hashed IP of action. |
| ip_hash_key_version | VARCHAR(64) | YES | NULL | Key version for ip_hash. |
| meta | mysql: JSON / postgres: JSONB | YES | NULL | JSON metadata (UTM, tags). |
| origin | VARCHAR(100) | YES | NULL | Acquisition source (e.g., form, import). |
| unsubscribed_at | mysql: DATETIME(6) / postgres: TIMESTAMPTZ(6) | YES | NULL | Unsubscribe timestamp (UTC). |
| unsubscribe_token_hash | mysql: BINARY(32) / postgres: BYTEA | YES | NULL | Hashed unsubscribe token. |
| unsubscribe_token_key_version | VARCHAR(64) | YES | NULL | Key version for unsubscribe hash. |
| updated_at | mysql: DATETIME(6) / postgres: TIMESTAMPTZ(6) | NO | CURRENT_TIMESTAMP(6) | Update timestamp (UTC). |
| user_id | BIGINT | YES |  | Related user (optional). |

## Engine Details

### mysql

Unique keys:
| Name | Columns |
| --- | --- |
| ux_ns_confirm_selector | confirm_selector |
| ux_ns_tenant_email_hash | tenant_id, email_hash |

Indexes:
| Name | Columns | SQL |
| --- | --- | --- |
| idx_ns_confirm_expires | confirm_expires | INDEX idx_ns_confirm_expires (confirm_expires) |
| idx_ns_confirmed_at | confirmed_at | INDEX idx_ns_confirmed_at (confirmed_at) |
| idx_ns_tenant | tenant_id | INDEX idx_ns_tenant (tenant_id) |
| idx_ns_unsubscribed_at | unsubscribed_at | INDEX idx_ns_unsubscribed_at (unsubscribed_at) |
| idx_ns_user | user_id | INDEX idx_ns_user (user_id) |
| ux_ns_confirm_selector | confirm_selector | UNIQUE KEY ux_ns_confirm_selector (confirm_selector) |
| ux_ns_tenant_email_hash | tenant_id,email_hash | UNIQUE KEY ux_ns_tenant_email_hash (tenant_id, email_hash) |

Foreign keys:
| Name | Columns | References | Actions |
| --- | --- | --- | --- |
| fk_ns_tenant | tenant_id | tenants(id) | ON DELETE RESTRICT |
| fk_ns_user | user_id | users(id) | ON DELETE SET |

### postgres

Unique keys:
| Name | Columns |
| --- | --- |
| ux_ns_confirm_selector | confirm_selector |
| ux_ns_tenant_email_hash | tenant_id, email_hash |

Indexes:
| Name | Columns | SQL |
| --- | --- | --- |
| idx_ns_confirm_expires | confirm_expires | CREATE INDEX IF NOT EXISTS idx_ns_confirm_expires ON newsletter_subscribers (confirm_expires) |
| idx_ns_confirmed_at | confirmed_at | CREATE INDEX IF NOT EXISTS idx_ns_confirmed_at ON newsletter_subscribers (confirmed_at) |
| idx_ns_tenant | tenant_id | CREATE INDEX IF NOT EXISTS idx_ns_tenant ON newsletter_subscribers (tenant_id) |
| idx_ns_unsubscribed_at | unsubscribed_at | CREATE INDEX IF NOT EXISTS idx_ns_unsubscribed_at ON newsletter_subscribers (unsubscribed_at) |
| idx_ns_user | user_id | CREATE INDEX IF NOT EXISTS idx_ns_user ON newsletter_subscribers (user_id) |
| ux_ns_confirm_selector | confirm_selector | CREATE UNIQUE INDEX IF NOT EXISTS ux_ns_confirm_selector ON newsletter_subscribers (confirm_selector) |
| ux_ns_tenant_email_hash | tenant_id,email_hash | CREATE UNIQUE INDEX IF NOT EXISTS ux_ns_tenant_email_hash ON newsletter_subscribers (tenant_id, email_hash) |

Foreign keys:
| Name | Columns | References | Actions |
| --- | --- | --- | --- |
| fk_ns_tenant | tenant_id | tenants(id) | ON DELETE RESTRICT |
| fk_ns_user | user_id | users(id) | ON DELETE SET |

## Engine differences

## Views
| View | Engine | Flags | File |
| --- | --- | --- | --- |
| vw_newsletter_subscribers | mysql | algorithm=MERGE, security=INVOKER | [../schema/040_views.mysql.sql](../schema/040_views.mysql.sql) |
| vw_newsletter_subscribers | postgres |  | [../schema/040_views.postgres.sql](../schema/040_views.postgres.sql) |
