
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
  scEventControl_data["publcodigon_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cliecodigon_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["publgrupusrs_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aplicodigon_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["publpuerton_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["meaucodigon_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["publurls_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["publipss_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["publhorarios_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["usuacodigos_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["publfecregd_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["publestados_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["publcodigon_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["publcodigon_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cliecodigon_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cliecodigon_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["publgrupusrs_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["publgrupusrs_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aplicodigon_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aplicodigon_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["publpuerton_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["publpuerton_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["meaucodigon_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["meaucodigon_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["publurls_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["publurls_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["publipss_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["publipss_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["publhorarios_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["publhorarios_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["usuacodigos_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["usuacodigos_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["publfecregd_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["publfecregd_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["publestados_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["publestados_" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_active_all() {
  for (var i = 1; i < iAjaxNewLine; i++) {
    if (scEventControl_active(i)) {
      return true;
    }
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("cliecodigon_" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("aplicodigon_" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("meaucodigon_" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("publestados_" + iSeq == fieldName) {
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
  $('#id_sc_field_publcodigon_' + iSeqRow).bind('blur', function() { sc_form_publicaciones_grid_edit_publcodigon__onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_publicaciones_grid_edit_publcodigon__onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_publicaciones_grid_edit_publcodigon__onfocus(this, iSeqRow) });
  $('#id_sc_field_cliecodigon_' + iSeqRow).bind('blur', function() { sc_form_publicaciones_grid_edit_cliecodigon__onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_publicaciones_grid_edit_cliecodigon__onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_publicaciones_grid_edit_cliecodigon__onfocus(this, iSeqRow) });
  $('#id_sc_field_publgrupusrs_' + iSeqRow).bind('blur', function() { sc_form_publicaciones_grid_edit_publgrupusrs__onblur(this, iSeqRow) })
                                           .bind('change', function() { sc_form_publicaciones_grid_edit_publgrupusrs__onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_publicaciones_grid_edit_publgrupusrs__onfocus(this, iSeqRow) });
  $('#id_sc_field_aplicodigon_' + iSeqRow).bind('blur', function() { sc_form_publicaciones_grid_edit_aplicodigon__onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_publicaciones_grid_edit_aplicodigon__onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_publicaciones_grid_edit_aplicodigon__onfocus(this, iSeqRow) });
  $('#id_sc_field_publpuerton_' + iSeqRow).bind('blur', function() { sc_form_publicaciones_grid_edit_publpuerton__onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_publicaciones_grid_edit_publpuerton__onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_publicaciones_grid_edit_publpuerton__onfocus(this, iSeqRow) });
  $('#id_sc_field_meaucodigon_' + iSeqRow).bind('blur', function() { sc_form_publicaciones_grid_edit_meaucodigon__onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_publicaciones_grid_edit_meaucodigon__onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_publicaciones_grid_edit_meaucodigon__onfocus(this, iSeqRow) });
  $('#id_sc_field_publurls_' + iSeqRow).bind('blur', function() { sc_form_publicaciones_grid_edit_publurls__onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_publicaciones_grid_edit_publurls__onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_publicaciones_grid_edit_publurls__onfocus(this, iSeqRow) });
  $('#id_sc_field_publipss_' + iSeqRow).bind('blur', function() { sc_form_publicaciones_grid_edit_publipss__onblur(this, iSeqRow) })
                                       .bind('change', function() { sc_form_publicaciones_grid_edit_publipss__onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_form_publicaciones_grid_edit_publipss__onfocus(this, iSeqRow) });
  $('#id_sc_field_publhorarios_' + iSeqRow).bind('blur', function() { sc_form_publicaciones_grid_edit_publhorarios__onblur(this, iSeqRow) })
                                           .bind('change', function() { sc_form_publicaciones_grid_edit_publhorarios__onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_publicaciones_grid_edit_publhorarios__onfocus(this, iSeqRow) });
  $('#id_sc_field_usuacodigos_' + iSeqRow).bind('blur', function() { sc_form_publicaciones_grid_edit_usuacodigos__onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_publicaciones_grid_edit_usuacodigos__onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_publicaciones_grid_edit_usuacodigos__onfocus(this, iSeqRow) });
  $('#id_sc_field_publfecregd_' + iSeqRow).bind('blur', function() { sc_form_publicaciones_grid_edit_publfecregd__onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_publicaciones_grid_edit_publfecregd__onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_publicaciones_grid_edit_publfecregd__onfocus(this, iSeqRow) });
  $('#id_sc_field_publfecregd__hora' + iSeqRow).bind('blur', function() { sc_form_publicaciones_grid_edit_publfecregd__hora_onblur(this, iSeqRow) })
                                               .bind('change', function() { sc_form_publicaciones_grid_edit_publfecregd__hora_onchange(this, iSeqRow) })
                                               .bind('focus', function() { sc_form_publicaciones_grid_edit_publfecregd__hora_onfocus(this, iSeqRow) });
  $('#id_sc_field_publestados_' + iSeqRow).bind('blur', function() { sc_form_publicaciones_grid_edit_publestados__onblur(this, iSeqRow) })
                                          .bind('change', function() { sc_form_publicaciones_grid_edit_publestados__onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_publicaciones_grid_edit_publestados__onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_publicaciones_grid_edit_publcodigon__onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_grid_edit_validate_publcodigon_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_publcodigon__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_publicaciones_grid_edit_publcodigon__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_cliecodigon__onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_grid_edit_validate_cliecodigon_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_cliecodigon__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_publicaciones_grid_edit_cliecodigon__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_publgrupusrs__onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_grid_edit_validate_publgrupusrs_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_publgrupusrs__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_publicaciones_grid_edit_publgrupusrs__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_aplicodigon__onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_grid_edit_validate_aplicodigon_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_aplicodigon__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_publicaciones_grid_edit_aplicodigon__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_publpuerton__onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_grid_edit_validate_publpuerton_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_publpuerton__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_publicaciones_grid_edit_publpuerton__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_meaucodigon__onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_grid_edit_validate_meaucodigon_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_meaucodigon__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_publicaciones_grid_edit_meaucodigon__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_publurls__onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_grid_edit_validate_publurls_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_publurls__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_publicaciones_grid_edit_publurls__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_publipss__onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_grid_edit_validate_publipss_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_publipss__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_publicaciones_grid_edit_publipss__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_publhorarios__onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_grid_edit_validate_publhorarios_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_publhorarios__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_publicaciones_grid_edit_publhorarios__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_usuacodigos__onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_grid_edit_validate_usuacodigos_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_usuacodigos__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_publicaciones_grid_edit_usuacodigos__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_publfecregd__onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_grid_edit_validate_publfecregd_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_publfecregd__hora_onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_grid_edit_validate_publfecregd_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_publfecregd__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_publicaciones_grid_edit_publfecregd__hora_onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_publicaciones_grid_edit_publfecregd__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_publfecregd__hora_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_publestados__onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_grid_edit_validate_publestados_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_publicaciones_grid_edit_publestados__onchange(oThis, iSeqRow) {
  nm_check_insert(iSeqRow);
}

function sc_form_publicaciones_grid_edit_publestados__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function displayChange_block(block, status) {
	if ("0" == block) {
		displayChange_block_0(status);
	}
}

function displayChange_block_0(status) {
	displayChange_field("publcodigon_", "", status);
	displayChange_field("cliecodigon_", "", status);
	displayChange_field("publgrupusrs_", "", status);
	displayChange_field("aplicodigon_", "", status);
	displayChange_field("publpuerton_", "", status);
	displayChange_field("meaucodigon_", "", status);
	displayChange_field("publurls_", "", status);
	displayChange_field("publipss_", "", status);
	displayChange_field("publhorarios_", "", status);
	displayChange_field("usuacodigos_", "", status);
	displayChange_field("publfecregd_", "", status);
	displayChange_field("publestados_", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_publcodigon_(row, status);
	displayChange_field_cliecodigon_(row, status);
	displayChange_field_publgrupusrs_(row, status);
	displayChange_field_aplicodigon_(row, status);
	displayChange_field_publpuerton_(row, status);
	displayChange_field_meaucodigon_(row, status);
	displayChange_field_publurls_(row, status);
	displayChange_field_publipss_(row, status);
	displayChange_field_publhorarios_(row, status);
	displayChange_field_usuacodigos_(row, status);
	displayChange_field_publfecregd_(row, status);
	displayChange_field_publestados_(row, status);
}

function displayChange_field(field, row, status) {
	if ("publcodigon_" == field) {
		displayChange_field_publcodigon_(row, status);
	}
	if ("cliecodigon_" == field) {
		displayChange_field_cliecodigon_(row, status);
	}
	if ("publgrupusrs_" == field) {
		displayChange_field_publgrupusrs_(row, status);
	}
	if ("aplicodigon_" == field) {
		displayChange_field_aplicodigon_(row, status);
	}
	if ("publpuerton_" == field) {
		displayChange_field_publpuerton_(row, status);
	}
	if ("meaucodigon_" == field) {
		displayChange_field_meaucodigon_(row, status);
	}
	if ("publurls_" == field) {
		displayChange_field_publurls_(row, status);
	}
	if ("publipss_" == field) {
		displayChange_field_publipss_(row, status);
	}
	if ("publhorarios_" == field) {
		displayChange_field_publhorarios_(row, status);
	}
	if ("usuacodigos_" == field) {
		displayChange_field_usuacodigos_(row, status);
	}
	if ("publfecregd_" == field) {
		displayChange_field_publfecregd_(row, status);
	}
	if ("publestados_" == field) {
		displayChange_field_publestados_(row, status);
	}
}

function displayChange_field_publcodigon_(row, status) {
}

function displayChange_field_cliecodigon_(row, status) {
}

function displayChange_field_publgrupusrs_(row, status) {
}

function displayChange_field_aplicodigon_(row, status) {
}

function displayChange_field_publpuerton_(row, status) {
}

function displayChange_field_meaucodigon_(row, status) {
}

function displayChange_field_publurls_(row, status) {
}

function displayChange_field_publipss_(row, status) {
}

function displayChange_field_publhorarios_(row, status) {
}

function displayChange_field_usuacodigos_(row, status) {
}

function displayChange_field_publfecregd_(row, status) {
}

function displayChange_field_publestados_(row, status) {
}

function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_form_publicaciones_grid_edit_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(36);
		}
	}
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_publfecregd_" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_publfecregd_" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['publfecregd_']['date_format']); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['publfecregd_']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime);
    },
    onClose: function(dateText, inst) {
      do_ajax_form_publicaciones_grid_edit_validate_publfecregd_(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['publfecregd_']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
    buttonImage: "<?php echo $this->jqueryIconFile('calendar'); ?>",
    buttonImageOnly: true,
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  });

} // scJQCalendarAdd

function scJQSpinAdd(iSeqRow) {
  $("#id_sc_field_publpuerton_" + iSeqRow).spinner({
    max: 999999999,
    min: 0,
    step: 1,
    page: 5,
    change: function(event, ui) {
      $(this).trigger("change");
    },
    spin: function(event, ui) {
      $(this).trigger("change");
    }
  });
} // scJQSpinAdd

function scJQUploadAdd(iSeqRow) {
} // scJQUploadAdd

function scJQSelect2Add(seqRow, specificField) {
} // scJQSelect2Add


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQCalendarAdd(iLine);
  scJQSpinAdd(iLine);
  scJQUploadAdd(iLine);
  scJQSelect2Add(iLine);
} // scJQElementsAdd

