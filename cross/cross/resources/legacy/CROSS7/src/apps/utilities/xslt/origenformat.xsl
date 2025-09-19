<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!-- El modo al que transformara el XSL --> 
<xsl:output  method="text"/>

<xsl:template match="from">
    <xsl:apply-templates select="db"/>
    <xsl:apply-templates select="dbi"/>
    <xsl:apply-templates select="param"/>
</xsl:template>

<xsl:template match="db">
        $this->_rcFrom = $this->_getFromDb('<xsl:value-of select="table"/>','<xsl:value-of select="value_field"/>','<xsl:value-of select="label_field"/>');
        return true;
</xsl:template>

<xsl:template match="dbi">
        $this->_rcFrom = $this->_getFromSqlId('<xsl:value-of select="sqlid"/>','<xsl:value-of select="value_field"/>','<xsl:value-of select="label_field"/>');
        return true;
</xsl:template>

<xsl:template match="param">
        $this->_rcFrom = $this->_getFromParam('<xsl:value-of select="module"/>','<xsl:value-of select="variable"/>');
        return true;
</xsl:template>

</xsl:stylesheet> 