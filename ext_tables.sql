#
# Extend TtContent
#
CREATE TABLE tt_content (
	tx_site_wkhtmltopdf_enabled smallint(5) unsigned DEFAULT '0' NOT NULL,
	tx_site_wkhtmltopdf_title varchar(255) NOT NULL DEFAULT ''
);