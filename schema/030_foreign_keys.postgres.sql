-- Auto-generated from schema-map-postgres.yaml (map@sha1:621FDD3D99B768B6A8AD92061FB029414184F4B3)
-- engine: postgres
-- table:  newsletter_subscribers

ALTER TABLE newsletter_subscribers ADD CONSTRAINT fk_ns_user   FOREIGN KEY (user_id)   REFERENCES users(id) ON DELETE SET NULL;

ALTER TABLE newsletter_subscribers ADD CONSTRAINT fk_ns_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id) ON DELETE RESTRICT;
