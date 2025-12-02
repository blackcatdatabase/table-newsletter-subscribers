-- Auto-generated from schema-map-postgres.yaml (map@94ebe6c)
-- engine: postgres
-- table:  newsletter_subscribers

ALTER TABLE newsletter_subscribers ADD CONSTRAINT fk_ns_user   FOREIGN KEY (user_id)   REFERENCES users(id) ON DELETE SET NULL;

ALTER TABLE newsletter_subscribers ADD CONSTRAINT fk_ns_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id) ON DELETE RESTRICT;
