-- Auto-generated from schema-map-postgres.psd1 (map@mtime:2025-10-24T09:46:38Z)
-- engine: postgres
-- table:  newsletter_subscribers
CREATE UNIQUE INDEX ux_ns_email_hash ON newsletter_subscribers (email_hash);

CREATE UNIQUE INDEX ux_ns_confirm_selector ON newsletter_subscribers (confirm_selector);

CREATE INDEX idx_ns_user ON newsletter_subscribers (user_id);

CREATE INDEX idx_ns_confirm_expires ON newsletter_subscribers (confirm_expires);

CREATE INDEX idx_ns_unsubscribed_at ON newsletter_subscribers (unsubscribed_at);
