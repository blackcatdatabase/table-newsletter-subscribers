-- Auto-generated from schema-map-postgres.psd1 (map@9d3471b)
-- engine: postgres
-- table:  newsletter_subscribers
ALTER TABLE newsletter_subscribers ADD CONSTRAINT fk_ns_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL;
