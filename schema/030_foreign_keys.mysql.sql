-- Auto-generated from schema-map-mysql.psd1 (map@db2f8b8)
-- engine: mysql
-- table:  newsletter_subscribers
ALTER TABLE newsletter_subscribers ADD CONSTRAINT fk_ns_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL;
