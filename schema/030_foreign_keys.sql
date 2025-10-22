-- Auto-generated from schema-map.psd1 (map@6cefe8e)
-- table: newsletter_subscribers
ALTER TABLE newsletter_subscribers ADD CONSTRAINT fk_ns_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL;
