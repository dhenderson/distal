ALTER TABLE organizations ADD COLUMN is_active BOOLEAN DEFAULT TRUE;
ALTER TABLE organizations ADD COLUMN deactivation_date datetime;