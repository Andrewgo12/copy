<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output  method="text"/>
<xsl:template match="manager">
    <xsl:apply-templates select="format"/>
    <xsl:apply-templates select="transform"/>
    <xsl:apply-templates select="rule"/>
</xsl:template>

<xsl:template match="format">
	$sbResult = $this->_validateFormat('<xsl:value-of select="object"/>','<xsl:value-of select="method"/>',
	$this->rcData[$this->rcDetalleDimension[$this->SbIndexField]["dedinombres"]]);
	if(!$sbResult){
		$this->_rcError["type_error"]="format";
		$this->_rcError["field"]=$this->rcDetalleDimension[$this->SbIndexField]["dedinombres"];
		$sbResult = false;
		return;
	}
</xsl:template>
<xsl:template match="rule">
	if(!($this->rcData[$this->rcDetalleDimension[$this->SbIndexField]["dedinombres"]] <xsl:value-of select="operator"/>
	  <xsl:apply-templates select="value"/>)){
	  	$this->_rcError["type_error"]="rule";
		$this->_rcError["field"]=$this->rcDetalleDimension[$this->SbIndexField]["dedinombres"];
		$sbResult = false;
		return;
	}
</xsl:template>
<xsl:template match="value">
        <xsl:if test="type = 'integer'"><xsl:value-of select="data"/></xsl:if>    
        <xsl:if test="type = 'string'">"<xsl:value-of select="data"/>"</xsl:if>
</xsl:template>
<xsl:template match="transform">
	$this->rcData[$this->rcDetalleDimension[$this->SbIndexField]["dedinombres"]] = $this->_transformData('<xsl:value-of select="object"/>','<xsl:value-of select="method"/>',
	$this->rcData[$this->rcDetalleDimension[$this->SbIndexField]["dedinombres"]]);
	return;
</xsl:template>
</xsl:stylesheet>