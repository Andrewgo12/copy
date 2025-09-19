CREATE OR REPLACE FUNCTION fndeleteorden(character varying)
  RETURNS boolean AS
$BODY$ 
DECLARE 
sbSql varchar; 
BEGIN
 
	sbSql := 'DELETE FROM activiacta WHERE actacodigos IN (SELECT actacodigos FROM acta WHERE ordenumeros =''' || $1 || ''' )';
	EXECUTE sbSql; 
	
	sbSql := 'DELETE FROM actaestorden WHERE actacodigos IN (SELECT actacodigos FROM acta WHERE ordenumeros =''' || $1 || ''' )';
	EXECUTE sbSql; 
	
	sbSql := 'DELETE FROM actaempresa WHERE actacodigos IN (SELECT actacodigos FROM acta WHERE ordenumeros =''' || $1 || ''' )';
	EXECUTE sbSql; 
	
	sbSql := 'DELETE FROM recorrido WHERE ordenumeros =''' || $1 || ''' ';
	EXECUTE sbSql; 
	
	sbSql := 'DELETE FROM acta WHERE ordenumeros =''' || $1 || ''' ';
	EXECUTE sbSql; 
	
	sbSql := 'DELETE FROM ordenempresa_log WHERE ordenumeros =''' || $1 || ''' ';
	EXECUTE sbSql; 
	
	sbSql := 'DELETE FROM valordimension WHERE vadidomivals =''' || $1 || ''' ';
	EXECUTE sbSql; 
	
	sbSql := 'DELETE FROM orden_log WHERE ordenumeros =''' || $1 || ''' ';
	EXECUTE sbSql; 
	
	sbSql := 'DELETE FROM ordenempresa WHERE ordenumeros =''' || $1 || ''' ';
	EXECUTE sbSql; 
	
	sbSql := 'DELETE FROM orden WHERE ordenumeros =''' || $1 || ''' ';
	EXECUTE sbSql; 
	
	RETURN true; 
END; 
$BODY$
  LANGUAGE 'plpgsql' VOLATILE;
ALTER FUNCTION fndeleteorden(character varying) OWNER TO postgres;