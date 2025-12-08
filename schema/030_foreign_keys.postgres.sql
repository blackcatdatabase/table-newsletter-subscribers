-- Auto-generated from schema-map-postgres.yaml (map@sha1:6D9B52237D942B2B3855FD0F5500331B935A7C62)
-- engine: postgres
-- table:  newsletter_subscribers

ALTER TABLE newsletter_subscribers ADD CONSTRAINT fk_ns_user   FOREIGN KEY (user_id)   REFERENCES users(id) ON DELETE SET NULL;

ALTER TABLE newsletter_subscribers ADD CONSTRAINT fk_ns_tenant FOREIGN KEY (tenant_id) REFERENCES tenants(id) ON DELETE RESTRICT;
