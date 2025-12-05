-- Auto-generated from schema-map-postgres.yaml (map@sha1:F0EE237771FBA8DD7C4E886FF276F91A862C3718)
-- engine: postgres
-- table:  newsletter_subscribers

CREATE UNIQUE INDEX IF NOT EXISTS ux_ns_tenant_email_hash ON newsletter_subscribers (tenant_id, email_hash);

CREATE INDEX IF NOT EXISTS idx_ns_tenant ON newsletter_subscribers (tenant_id);

CREATE UNIQUE INDEX IF NOT EXISTS ux_ns_confirm_selector ON newsletter_subscribers (confirm_selector);

CREATE INDEX IF NOT EXISTS idx_ns_user ON newsletter_subscribers (user_id);

CREATE INDEX IF NOT EXISTS idx_ns_confirm_expires ON newsletter_subscribers (confirm_expires);

CREATE INDEX IF NOT EXISTS idx_ns_unsubscribed_at ON newsletter_subscribers (unsubscribed_at);

CREATE INDEX IF NOT EXISTS idx_ns_confirmed_at ON newsletter_subscribers (confirmed_at);
