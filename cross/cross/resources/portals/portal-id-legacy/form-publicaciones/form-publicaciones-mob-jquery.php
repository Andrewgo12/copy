
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
  scEventControl_data["publcodigon" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cliecodigon" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["publgrupusrs" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aplicodigon" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["publpuerton" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["meaucodigon" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["publurls" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["publipss" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["publhorarios" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["usuacodigos" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["publfecregd" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["publestados" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["publcodigon" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["publcodigon" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cliecodigon" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cliecodigon" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["publgrupusrs" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["publgrupusrs" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aplicodigon" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aplicodigon" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["publpuerton" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["publpuerton" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["meaucodigon" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["meaucodigon" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["publurls" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["publurls" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["publipss" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["publipss" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["publhorarios" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["publhorarios" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["usuacodigos" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["usuacodigos" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["publfecregd" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["publfecregd" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["publestados" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["publestados" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("cliecodigon" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("aplicodigon" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("meaucodigon" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("publestados" + iSeq == fieldName) {
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
  $('#id_sc_field_publcodigon' + iSeqRow).bind('blur', function() { sc_form_publicaciones_publcodigon_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_publicaciones_publcodigon_onfocus(this, iSeqRow) });
  $('#id_sc_field_cliecodigon' + iSeqRow).bind('blur', function() { sc_form_publicaciones_cliecodigon_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_publicaciones_cliecodigon_onfocus(this, iSeqRow) });
  $('#id_sc_field_publgrupusrs' + iSeqRow).bind('blur', function() { sc_form_publicaciones_publgrupusrs_onblur(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_publicaciones_publgrupusrs_onfocus(this, iSeqRow) });
  $('#id_sc_field_aplicodigon' + iSeqRow).bind('blur', function() { sc_form_publicaciones_aplicodigon_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_publicaciones_aplicodigon_onfocus(this, iSeqRow) });
  $('#id_sc_field_publpuerton' + iSeqRow).bind('blur', function() { sc_form_publicaciones_publpuerton_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_publicaciones_publpuerton_onfocus(this, iSeqRow) });
  $('#id_sc_field_meaucodigon' + iSeqRow).bind('blur', function() { sc_form_publicaciones_meaucodigon_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_publicaciones_meaucodigon_onfocus(this, iSeqRow) });
  $('#id_sc_field_publurls' + iSeqRow).bind('blur', function() { sc_form_publicaciones_publurls_onblur(this, iSeqRow) })
                                      .bind('focus', function() { sc_form_publicaciones_publurls_onfocus(this, iSeqRow) });
  $('#id_sc_field_publipss' + iSeqRow).bind('blur', function() { sc_form_publicaciones_publipss_onblur(this, iSeqRow) })
                                      .bind('focus', function() { sc_form_publicaciones_publipss_onfocus(this, iSeqRow) });
  $('#id_sc_field_publhorarios' + iSeqRow).bind('blur', function() { sc_form_publicaciones_publhorarios_onblur(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_publicaciones_publhorarios_onfocus(this, iSeqRow) });
  $('#id_sc_field_usuacodigos' + iSeqRow).bind('blur', function() { sc_form_publicaciones_usuacodigos_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_publicaciones_usuacodigos_onfocus(this, iSeqRow) });
  $('#id_sc_field_publfecregd' + iSeqRow).bind('blur', function() { sc_form_publicaciones_publfecregd_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_publicaciones_publfecregd_onfocus(this, iSeqRow) });
  $('#id_sc_field_publfecregd_hora' + iSeqRow).bind('blur', function() { sc_form_publicaciones_publfecregd_onblur(this, iSeqRow) })
                                              .bind('focus', function() { sc_form_publicaciones_publfecregd_onfocus(this, iSeqRow) });
  $('#id_sc_field_publestados' + iSeqRow).bind('blur', function() { sc_form_publicaciones_publestados_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_publicaciones_publestados_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_publicaciones_publcodigon_onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_mob_validate_publcodigon();
  scCssBlur(oThis);
}

function sc_form_publicaciones_publcodigon_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_publicaciones_cliecodigon_onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_mob_validate_cliecodigon();
  scCssBlur(oThis);
}

function sc_form_publicaciones_cliecodigon_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_publicaciones_publgrupusrs_onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_mob_validate_publgrupusrs();
  scCssBlur(oThis);
}

function sc_form_publicaciones_publgrupusrs_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_publicaciones_aplicodigon_onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_mob_validate_aplicodigon();
  scCssBlur(oThis);
}

function sc_form_publicaciones_aplicodigon_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_publicaciones_publpuerton_onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_mob_validate_publpuerton();
  scCssBlur(oThis);
}

function sc_form_publicaciones_publpuerton_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_publicaciones_meaucodigon_onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_mob_validate_meaucodigon();
  scCssBlur(oThis);
}

function sc_form_publicaciones_meaucodigon_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_publicaciones_publurls_onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_mob_validate_publurls();
  scCssBlur(oThis);
}

function sc_form_publicaciones_publurls_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_publicaciones_publipss_onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_mob_validate_publipss();
  scCssBlur(oThis);
}

function sc_form_publicaciones_publipss_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_publicaciones_publhorarios_onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_mob_validate_publhorarios();
  scCssBlur(oThis);
}

function sc_form_publicaciones_publhorarios_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_publicaciones_usuacodigos_onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_mob_validate_usuacodigos();
  scCssBlur(oThis);
}

function sc_form_publicaciones_usuacodigos_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_publicaciones_publfecregd_onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_mob_validate_publfecregd();
  scCssBlur(oThis);
}

function sc_form_publicaciones_publfecregd_onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_mob_validate_publfecregd();
  scCssBlur(oThis);
}

function sc_form_publicaciones_publfecregd_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_publicaciones_publfecregd_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_publicaciones_publestados_onblur(oThis, iSeqRow) {
  do_ajax_form_publicaciones_mob_validate_publestados();
  scCssBlur(oThis);
}

function sc_form_publicaciones_publestados_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_block(block, status) {
	if ("0" == block) {
		displayChange_block_0(status);
	}
}

function displayChange_block_0(status) {
	displayChange_field("publcodigon", "", status);
	displayChange_field("cliecodigon", "", status);
	displayChange_field("publgrupusrs", "", status);
	displayChange_field("aplicodigon", "", status);
	displayChange_field("publpuerton", "", status);
	displayChange_field("meaucodigon", "", status);
	displayChange_field("publurls", "", status);
	displayChange_field("publipss", "", status);
	displayChange_field("publhorarios", "", status);
	displayChange_field("usuacodigos", "", status);
	displayChange_field("publfecregd", "", status);
	displayChange_field("publestados", "", status);
}

function displayChange_row(row, status) {
	displayChange_field_publcodigon(row, status);
	displayChange_field_cliecodigon(row, status);
	displayChange_field_publgrupusrs(row, status);
	displayChange_field_aplicodigon(row, status);
	displayChange_field_publpuerton(row, status);
	displayChange_field_meaucodigon(row, status);
	displayChange_field_publurls(row, status);
	displayChange_field_publipss(row, status);
	displayChange_field_publhorarios(row, status);
	displayChange_field_usuacodigos(row, status);
	displayChange_field_publfecregd(row, status);
	displayChange_field_publestados(row, status);
}

function displayChange_field(field, row, status) {
	if ("publcodigon" == field) {
		displayChange_field_publcodigon(row, status);
	}
	if ("cliecodigon" == field) {
		displayChange_field_cliecodigon(row, status);
	}
	if ("publgrupusrs" == field) {
		displayChange_field_publgrupusrs(row, status);
	}
	if ("aplicodigon" == field) {
		displayChange_field_aplicodigon(row, status);
	}
	if ("publpuerton" == field) {
		displayChange_field_publpuerton(row, status);
	}
	if ("meaucodigon" == field) {
		displayChange_field_meaucodigon(row, status);
	}
	if ("publurls" == field) {
		displayChange_field_publurls(row, status);
	}
	if ("publipss" == field) {
		displayChange_field_publipss(row, status);
	}
	if ("publhorarios" == field) {
		displayChange_field_publhorarios(row, status);
	}
	if ("usuacodigos" == field) {
		displayChange_field_usuacodigos(row, status);
	}
	if ("publfecregd" == field) {
		displayChange_field_publfecregd(row, status);
	}
	if ("publestados" == field) {
		displayChange_field_publestados(row, status);
	}
}

function displayChange_field_publcodigon(row, status) {
}

function displayChange_field_cliecodigon(row, status) {
}

function displayChange_field_publgrupusrs(row, status) {
}

function displayChange_field_aplicodigon(row, status) {
}

function displayChange_field_publpuerton(row, status) {
}

function displayChange_field_meaucodigon(row, status) {
}

function displayChange_field_publurls(row, status) {
}

function displayChange_field_publipss(row, status) {
}

function displayChange_field_publhorarios(row, status) {
}

function displayChange_field_usuacodigos(row, status) {
}

function displayChange_field_publfecregd(row, status) {
}

function displayChange_field_publestados(row, status) {
}

function scResetPagesDisplay() {
	$(".sc-form-page").show();
}

function scHidePage(pageNo) {
	$("#id_form_publicaciones_mob_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
	if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
		var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
		if (inactiveTabs.length) {
			var tabNo = $(inactiveTabs[0]).attr("id").substr(30);
		}
	}
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_publfecregd" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_publfecregd" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['publfecregd']['date_format']); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['publfecregd']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime);
    },
    onClose: function(dateText, inst) {
      do_ajax_form_publicaciones_mob_validate_publfecregd(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['publfecregd']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
    buttonImage: "<?php echo $this->jqueryIconFile('calendar'); ?>",
    buttonImageOnly: true,
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  });

} // scJQCalendarAdd

function scJQSpinAdd(iSeqRow) {
  $("#id_sc_field_publpuerton" + iSeqRow).spinner({
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

var scBtnGrpStatus = {};
function scBtnGrpShow(sGroup) {
  if (typeof(scBtnGrpShowMobile) === typeof(function(){})) { return scBtnGrpShowMobile(sGroup); };
  var btnPos = $('#sc_btgp_btn_' + sGroup).offset();
  scBtnGrpStatus[sGroup] = 'open';
  $('#sc_btgp_btn_' + sGroup).mouseout(function() {
    scBtnGrpStatus[sGroup] = '';
    setTimeout(function() {
      scBtnGrpHide(sGroup);
    }, 1000);
  }).mouseover(function() {
    scBtnGrpStatus[sGroup] = 'over';
  });
  $('#sc_btgp_div_' + sGroup + ' span a').click(function() {
    scBtnGrpStatus[sGroup] = 'out';
    scBtnGrpHide(sGroup);
  });
  $('#sc_btgp_div_' + sGroup).css({
    'left': btnPos.left
  })
  .mouseover(function() {
    scBtnGrpStatus[sGroup] = 'over';
  })
  .mouseleave(function() {
    scBtnGrpStatus[sGroup] = 'out';
    setTimeout(function() {
      scBtnGrpHide(sGroup);
    }, 1000);
  })
  .show('fast');
}
function scBtnGrpHide(sGroup) {
  if ('over' != scBtnGrpStatus[sGroup]) {
    $('#sc_btgp_div_' + sGroup).hide('fast');
  }
}
