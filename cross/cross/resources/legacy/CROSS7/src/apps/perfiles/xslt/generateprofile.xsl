<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!-- El modo al que transformar el XSL --> 
<xsl:output  method="text"/>
<!-- Abre y cierra el documento PHP -->
<xsl:template match="profile">
	<!--<xsl:value-of select="$code"/>-->
	<xsl:apply-templates select="action" mode="array"/>
	<!--<xsl:apply-templates select="action" mode="node"/>-->
</xsl:template>

<!-- Forma el arreglo que contiene los nodos -->
<xsl:template match="action" mode="array">
	<xsl:if test="type = 'node' or type = 'form' or type = 'module' or type = 'button'">
		$rcNode["<xsl:value-of select="name"/>"] = array("path" => "<xsl:apply-templates mode="path" select="(ancestor::action)[last()]"/>/<xsl:value-of select="name"/>","parent"=>"<xsl:value-of select="(ancestor::*/name)[last()]"/>", "tree"=>"<xsl:apply-templates mode="tree" select="(ancestor::action)[last()]"/>|-- ".$rclabels["<xsl:value-of select="name"/>"], "type" => "<xsl:value-of select="type"/>");
		<xsl:apply-templates select="action" mode="array"/>
	</xsl:if>
	<xsl:apply-templates select="action" mode="array"/>
</xsl:template>

<xsl:template match="action" mode="path">
	<xsl:apply-templates mode="path" select="(ancestor::action)[last()]"/>/<xsl:value-of select="name"/>
</xsl:template>

<xsl:template match="action" mode="tree">
	<xsl:apply-templates mode="tree" select="(ancestor::action)[last()]"/>|..</xsl:template>

</xsl:stylesheet>