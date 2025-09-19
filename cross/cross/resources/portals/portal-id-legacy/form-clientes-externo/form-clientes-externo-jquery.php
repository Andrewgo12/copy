
function scJQGeneralAdd() {
  scLoadScInput('input:text.sc-js-input');
  scLoadScInput('input:password.sc-js-input');
  scLoadScInput('input:checkbox.sc-js-input');
  scLoadScInput('input:radio.sc-js-input');
  scLoadScInput('select.sc-js-input');
  scLoadScInput('textarea.sc-js-input');

} // scJQGeneralAdd

function scFocusField(sField) {
  var $oField = $('#id_sc_field_' + sField);

  if (0 == $oField.length) {
    $oField = $('input[name=' + sField + ']');
  }

  if (0 == $oField.length && document.F1.elements[sField]) {
    $oField = $(document.F1.elements[sField]);
  }

  if ($oField.length > 0) {
    switch ($oField[0].name) {
      case 'cliecodigon':
      case 'tiidcodigos':
      case 'clieidentifs':
      case 'clienombres':
      case 'paiscodigos':
      case 'cliedireccis':
      case 'clietelfijs':
      case 'cliepagwebs':
      case 'cliecontacts':
      case 'cliecelconts':
      case 'cliemailcons':
      case 'esclcodigos':
      case 'ticlcodigos':
      case 'cliefcharegd':
      case 'clieactivos':
        sc_exib_ocult_pag('form_clientes_externo_form0');
        break;
      case 'detalle_publicaciones':
        sc_exib_ocult_pag('form_clientes_externo_form1');
        break;
    }
  }

  if (false == scSetFocusOnField($oField) && $("#id_ac_" + sField).length > 0) {
    if (false == scSetFocusOnField($("#id_ac_" + sField))) {
      setTimeout(function() { scSetFocusOnField($("#id_ac_" + sField)); }, 500);
    }
  }
  else {
    setTimeout(function() { scSetFocusOnField($oField); }, 500);
  }
} // scFocusField

function scSetFocusOnField($oField) {
  if ($oField.length > 0 && $oField[0].offsetHeight > 0 && $oField[0].offsetWidth > 0 && !$oField[0].disabled) {
    $oField[0].focus();
    return true;
  }
  return false;
} // scSetFocusOnField

function scEventControl_init(iSeqRow) {
  scEventControl_data["cliecodigon" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tiidcodigos" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["clieidentifs" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["clienombres" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["paiscodigos" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cliedireccis" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["clietelfijs" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cliepagwebs" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cliecontacts" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cliecelconts" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cliemailcons" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["esclcodigos" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["ticlcodigos" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cliefcharegd" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["clieactivos" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["detalle_publicaciones" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["cliecodigon" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cliecodigon" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tiidcodigos" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tiidcodigos" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["clieidentifs" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["clieidentifs" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["clienombres" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["clienombres" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["paiscodigos" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["paiscodigos" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cliedireccis" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cliedireccis" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["clietelfijs" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["clietelfijs" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cliepagwebs" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cliepagwebs" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cliecontacts" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cliecontacts" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cliecelconts" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cliecelconts" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cliemailcons" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cliemailcons" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["esclcodigos" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["esclcodigos" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["ticlcodigos" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["ticlcodigos" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cliefcharegd" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cliefcharegd" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["clieactivos" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["clieactivos" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["detalle_publicaciones" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["detalle_publicaciones" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("tiidcodigos" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("paiscodigos" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("esclcodigos" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("ticlcodigos" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("clieactivos" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  scEventControl_data[fieldName]["change"] = false;
} // scEventControl_onFocus

function scEventControl_onBlur(sFieldName) {
  scEventControl_data[sFieldName]["blur"] = false;
  if (scEventControl_data[sFieldName]["change"]) {
        if (scEventControl_data[sFieldName]["original"] == $("#id_sc_field_" + sFieldName).val() || scEventControl_data[sFieldName]["calculated"] == $("#id_sc_field_" + sFieldName).val()) {
          scEventControl_data[sFieldName]["change"] = false;
        }
  }
} // scEventControl_onBlur

function scEventControl_onChange(sFieldName) {
  scEventControl_data[sFieldName]["change"] = false;
} // scEventControl_onChange

function scEventControl_onAutocomp(sFieldName) {
  scEventControl_data[sFieldName]["autocomp"] = false;
} // scEventControl_onChange

var scEventControl_data = {};

function scJQEventsAdd(iSeqRow) {
  $('#id_sc_field_cliecodigon' + iSeqRow).bind('blur', function() { sc_form_clientes_externo_cliecodigon_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_clientes_externo_cliecodigon_onfocus(this, iSeqRow) });
  $('#id_sc_field_tiidcodigos' + iSeqRow).bind('blur', function() { sc_form_clientes_externo_tiidcodigos_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_clientes_externo_tiidcodigos_onfocus(this, iSeqRow) });
  $('#id_sc_field_clieidentifs' + iSeqRow).bind('blur', function() { sc_form_clientes_externo_clieidentifs_onblur(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_clientes_externo_clieidentifs_onfocus(this, iSeqRow) });
  $('#id_sc_field_clienombres' + iSeqRow).bind('blur', function() { sc_form_clientes_externo_clienombres_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_clientes_externo_clienombres_onfocus(this, iSeqRow) });
  $('#id_sc_field_paiscodigos' + iSeqRow).bind('blur', function() { sc_form_clientes_externo_paiscodigos_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_clientes_externo_paiscodigos_onfocus(this, iSeqRow) });
  $('#id_sc_field_cliedireccis' + iSeqRow).bind('blur', function() { sc_form_clientes_externo_cliedireccis_onblur(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_clientes_externo_cliedireccis_onfocus(this, iSeqRow) });
  $('#id_sc_field_clietelfijs' + iSeqRow).bind('blur', function() { sc_form_clientes_externo_clietelfijs_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_clientes_externo_clietelfijs_onfocus(this, iSeqRow) });
  $('#id_sc_field_cliepagwebs' + iSeqRow).bind('blur', function() { sc_form_clientes_externo_cliepagwebs_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_clientes_externo_cliepagwebs_onfocus(this, iSeqRow) });
  $('#id_sc_field_cliecontacts' + iSeqRow).bind('blur', function() { sc_form_clientes_externo_cliecontacts_onblur(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_clientes_externo_cliecontacts_onfocus(this, iSeqRow) });
  $('#id_sc_field_cliecelconts' + iSeqRow).bind('blur', function() { sc_form_clientes_externo_cliecelconts_onblur(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_clientes_externo_cliecelconts_onfocus(this, iSeqRow) });
  $('#id_sc_field_cliemailcons' + iSeqRow).bind('blur', function() { sc_form_clientes_externo_cliemailcons_onblur(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_clientes_externo_cliemailcons_onfocus(this, iSeqRow) });
  $('#id_sc_field_esclcodigos' + iSeqRow).bind('blur', function() { sc_form_clientes_externo_esclcodigos_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_clientes_externo_esclcodigos_onfocus(this, iSeqRow) });
  $('#id_sc_field_ticlcodigos' + iSeqRow).bind('blur', function() { sc_form_clientes_externo_ticlcodigos_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_clientes_externo_ticlcodigos_onfocus(this, iSeqRow) });
  $('#id_sc_field_cliefcharegd' + iSeqRow).bind('blur', function() { sc_form_clientes_externo_cliefcharegd_onblur(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_clientes_externo_cliefcharegd_onfocus(this, iSeqRow) });
  $('#id_sc_field_cliefcharegd_hora' + iSeqRow).bind('blur', function() { sc_form_clientes_externo_cliefcharegd_hora_onblur(this, iSeqRow) })
                                               .bind('focus', function() { sc_form_clientes_externo_cliefcharegd_hora_onfocus(this, iSeqRow) });
  $('#id_sc_field_clieactivos' + iSeqRow).bind('blur', function() { sc_form_clientes_externo_clieactivos_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_clientes_externo_clieactivos_onfocus(this, iSeqRow) });
  $('#id_sc_field_detalle_publicaciones' + iSeqRow).bind('blur', function() { sc_form_clientes_externo_detalle_publicaciones_onblur(this, iSeqRow) })
                                                   .bind('focus', function() { sc_form_clientes_externo_detalle_publicaciones_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_clientes_externo_cliecodigon_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_externo_validate_cliecodigon();
  scCssBlur(oThis);
}

function sc_form_clientes_externo_cliecodigon_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_externo_tiidcodigos_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_externo_validate_tiidcodigos();
  scCssBlur(oThis);
}

function sc_form_clientes_externo_tiidcodigos_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_externo_clieidentifs_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_externo_validate_clieidentifs();
  scCssBlur(oThis);
}

function sc_form_clientes_externo_clieidentifs_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_externo_clienombres_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_externo_validate_clienombres();
  scCssBlur(oThis);
}

function sc_form_clientes_externo_clienombres_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_externo_paiscodigos_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_externo_validate_paiscodigos();
  scCssBlur(oThis);
}

function sc_form_clientes_externo_paiscodigos_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_externo_cliedireccis_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_externo_validate_cliedireccis();
  scCssBlur(oThis);
}

function sc_form_clientes_externo_cliedireccis_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_externo_clietelfijs_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_externo_validate_clietelfijs();
  scCssBlur(oThis);
}

function sc_form_clientes_externo_clietelfijs_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_externo_cliepagwebs_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_externo_validate_cliepagwebs();
  scCssBlur(oThis);
}

function sc_form_clientes_externo_cliepagwebs_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_externo_cliecontacts_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_externo_validate_cliecontacts();
  scCssBlur(oThis);
}

function sc_form_clientes_externo_cliecontacts_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_externo_cliecelconts_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_externo_validate_cliecelconts();
  scCssBlur(oThis);
}

function sc_form_clientes_externo_cliecelconts_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_externo_cliemailcons_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_externo_validate_cliemailcons();
  scCssBlur(oThis);
}

function sc_form_clientes_externo_cliemailcons_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_externo_esclcodigos_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_externo_validate_esclcodigos();
  scCssBlur(oThis);
}

function sc_form_clientes_externo_esclcodigos_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_externo_ticlcodigos_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_externo_validate_ticlcodigos();
  scCssBlur(oThis);
}

function sc_form_clientes_externo_ticlcodigos_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_externo_cliefcharegd_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_externo_validate_cliefcharegd();
  scCssBlur(oThis);
}

function sc_form_clientes_externo_cliefcharegd_hora_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_externo_validate_cliefcharegd();
  scCssBlur(oThis);
}

function sc_form_clientes_externo_cliefcharegd_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_externo_cliefcharegd_hora_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_externo_clieactivos_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_externo_validate_clieactivos();
  scCssBlur(oThis);
}

function sc_form_clientes_externo_clieactivos_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_clientes_externo_detalle_publicaciones_onblur(oThis, iSeqRow) {
  do_ajax_form_clientes_externo_validate_detalle_publicaciones();
  scCssBlur(oThis);
}

function sc_form_clientes_externo_detalle_publicaciones_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_page(page, status) {
	if ("0" == page) {
		displayChange_page_0(status);
	}
	if ("1" == page) {
		displayChange_page_1(status);
	}
}

function displayChange_page_0(status) {
	displayChange_block("0", status);
	displayChange_block("1", status);
	displayChange_block("2", status);
	displayChange_block("3", status);
	displayChange_block("4", status);
}

function displayChange_page_1(status) {
	displayChange_block("5", status);
}

function displayChange_block(block, status) {
	if ("0" == block) {
		displayChange_block_0(status);
	}
	if ("1" == block) {
		displayChange_block_1(status);
	}
	if ("2" == block) {
		displayChange_block_2(status);
	}
	if ("3" == block) {
		displayChange_block_3(status);
	}
	if ("4" == block) {
		displayChange_block_4(status);
	}
	if ("5" == block) {
		displayChange_block_5(status);
	}
}

function displayChange_block_0(status) {
	displayChange_field("cliecodigon", "", status);
	displayChange_field("tiidcodigos", "", status);
	displayChange_field("clieidentifs", "", status);
	displayChange_field("clienombres", "", status);
}

function displayChange_block_1(status) {
	displayChange_field("paiscodigos", "", status);
	displayChange_field("cliedireccis", "", status);
	displayChange_field("clietelfijs", "", status);
	displayChange_field("cliepagwebs", "", status);
}

function displayChange_block_2(status) {
	displayChange_field("cliecontacts", "", status);
	displayChange_field("cliecelconts", "", status);
	displayChange_field("cliemailcons", "", status);
}

function displayChange_block_3(status) {
	displayChange_field("esclcodigos", "", status);
	displayChange_field("ticlcodigos", "", status);
}

function displayChange_block_4(status) {
	displayChange_field("cliefcharegd", "", status);
	displayChange_field("clieactivos", "", status);
}

function displayChange_block_5(status) {
	displayChange_field("detalle_publicaciones", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_cliecodigon(row, status);
	displayChange_field_tiidcodigos(row, status);
	displayChange_field_clieidentifs(row, status);
	displayChange_field_clienombres(row, status);
	displayChange_field_paiscodigos(row, status);
	displayChange_field_cliedireccis(row, status);
	displayChange_field_clietelfijs(row, status);
	displayChange_field_cliepagwebs(row, status);
	displayChange_field_cliecontacts(row, status);
	displayChange_field_cliecelconts(row, status);
	displayChange_field_cliemailcons(row, status);
	displayChange_field_esclcodigos(row, status);
	displayChange_field_ticlcodigos(row, status);
	displayChange_field_cliefcharegd(row, status);
	displayChange_field_clieactivos(row, status);
	displayChange_field_detalle_publicaciones(row, status);
}

function displayChange_field(field, row, status) {
	if ("cliecodigon" == field) {
		displayChange_field_cliecodigon(row, status);
	}
	if ("tiidcodigos" == field) {
		displayChange_field_tiidcodigos(row, status);
	}
	if ("clieidentifs" == field) {
		displayChange_field_clieidentifs(row, status);
	}
	if ("clienombres" == field) {
		displayChange_field_clienombres(row, status);
	}
	if ("paiscodigos" == field) {
		displayChange_field_paiscodigos(row, status);
	}
	if ("cliedireccis" == field) {
		displayChange_field_cliedireccis(row, status);
	}
	if ("clietelfijs" == field) {
		displayChange_field_clietelfijs(row, status);
	}
	if ("cliepagwebs" == field) {
		displayChange_field_cliepagwebs(row, status);
	}
	if ("cliecontacts" == field) {
		displayChange_field_cliecontacts(row, status);
	}
	if ("cliecelconts" == field) {
		displayChange_field_cliecelconts(row, status);
	}
	if ("cliemailcons" == field) {
		displayChange_field_cliemailcons(row, status);
	}
	if ("esclcodigos" == field) {
		displayChange_field_esclcodigos(row, status);
	}
	if ("ticlcodigos" == field) {
		displayChange_field_ticlcodigos(row, status);
	}
	if ("cliefcharegd" == field) {
		displayChange_field_cliefcharegd(row, status);
	}
	if ("clieactivos" == field) {
		displayChange_field_clieactivos(row, status);
	}
	if ("detalle_publicaciones" == field) {
		displayChange_field_detalle_publicaciones(row, status);
	}
}

function displayChange_field_cliecodigon(row, status) {
}

function displayChange_field_tiidcodigos(row, status) {
}

function displayChange_field_clieidentifs(row, status) {
}

function displayChange_field_clienombres(row, status) {
}

function displayChange_field_paiscodigos(row, status) {
}

function displayChange_field_cliedireccis(row, status) {
}

function displayChange_field_clietelfijs(row, status) {
}

function displayChange_field_cliepagwebs(row, status) {
}

function displayChange_field_cliecontacts(row, status) {
}

function displayChange_field_cliecelconts(row, status) {
}

function displayChange_field_cliemailcons(row, status) {
}

function displayChange_field_esclcodigos(row, status) {
}

function displayChange_field_ticlcodigos(row, status) {
}

function displayChange_field_cliefcharegd(row, status) {
}

function displayChange_field_clieactivos(row, status) {
}

function displayChange_field_detalle_publicaciones(row, status) {
}

function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_form_clientes_externo_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(29);
		}
	}
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_cliefcharegd" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_cliefcharegd" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['cliefcharegd']['date_format']); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['cliefcharegd']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime);
    },
    onClose: function(dateText, inst) {
      do_ajax_form_clientes_externo_validate_cliefcharegd(iSeqRow);
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNames: ["<?php      echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['cliefcharegd']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
    buttonImage: "<?php echo $this->jqueryIconFile('calendar'); ?>",
    buttonImageOnly: true,
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  });

} // scJQCalendarAdd

function scJQUploadAdd(iSeqRow) {
} // scJQUploadAdd

function scJQSelect2Add(seqRow, specificField) {
} // scJQSelect2Add


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQCalendarAdd(iLine);
  scJQUploadAdd(iLine);
  scJQSelect2Add(iLine);
} // scJQElementsAdd

