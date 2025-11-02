-- Auto-generated from schema-map-postgres.psd1 (map@db2f8b8)
-- engine: postgres
-- table:  newsletter_subscribers
CREATE UNIQUE INDEX IF NOT EXISTS ux_ns_email_hash ON newsletter_subscribers (email_hash);

CREATE UNIQUE INDEX IF NOT EXISTS ux_ns_confirm_selector ON newsletter_subscribers (confirm_selector);

CREATE INDEX IF NOT EXISTS idx_ns_user ON newsletter_subscribers (user_id);

CREATE INDEX IF NOT EXISTS idx_ns_confirm_expires ON newsletter_subscribers (confirm_expires);

CREATE INDEX IF NOT EXISTS idx_ns_unsubscribed_at ON newsletter_subscribers (unsubscribed_at);
