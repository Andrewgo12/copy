<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!-- El modo al que transformarÃ¡ el XSL --> 
<xsl:output  method="text"/>

<xsl:template match="validation">
    if(<xsl:apply-templates select="rule"/>
    ){
        $sbResult = true;
    } else {
        $sbResult = false;
    }   
</xsl:template>

<xsl:template match="rule">
    <xsl:apply-templates select="value"/>
    <xsl:apply-templates select="param"/>
    <xsl:apply-templates select="var"/>
    <xsl:apply-templates select="constant"/>
</xsl:template>


<xsl:template match="value">
        <xsl:value-of select="(ancestor::*/rule_operator)"/>($this->rcParams['<xsl:value-of select="(ancestor::*/field)[last()]" />'] <xsl:value-of select="(ancestor::*/operator)[last()]" />
        <xsl:if test="type = 'integer'"><xsl:value-of select="data"/></xsl:if>    
        <xsl:if test="type = 'string'">"<xsl:value-of select="data"/>"</xsl:if>)
</xsl:template>

<xsl:template match="param"><xsl:value-of select="(ancestor::*/rule_operator)"/>
        ($this->rcParams['<xsl:value-of select="(ancestor::*/field)[last()]" />'] <xsl:value-of select="(ancestor::*/operator)[last()]" /> ($this->getParam('<xsl:value-of select="module"/>','<xsl:value-of select="variable"/>','<xsl:value-of select="index"/>')))
</xsl:template>
    
<xsl:template match="constant"><xsl:value-of select="(ancestor::*/rule_operator)"/>
        ($this->rcParams['<xsl:value-of select="(ancestor::*/field)[last()]" />'] <xsl:value-of select="(ancestor::*/operator)[last()]" /> ($this->getConstant('<xsl:value-of select="name"/>','<xsl:value-of select="index"/>')))
</xsl:template>

<xsl:template match="var"><xsl:value-of select="(ancestor::*/rule_operator)"/>
        ($this->rcParams['<xsl:value-of select="(ancestor::*/field)[last()]" />']<xsl:value-of select="(ancestor::*/operator)[last()]" />$<xsl:value-of select="varname"/>)
</xsl:template>
</xsl:stylesheet> 
