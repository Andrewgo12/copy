CREATE FUNCTION plpgsql_call_handler () RETURNS language_handler  AS '$libdir/plpgsql.so' LANGUAGE 'C';
CREATE TRUSTED PROCEDURAL LANGUAGE 'plpgsql' HANDLER plpgsql_call_handler;
