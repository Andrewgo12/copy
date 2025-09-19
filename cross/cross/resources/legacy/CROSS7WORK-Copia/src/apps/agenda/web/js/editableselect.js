function SelObj(formname,selname,textname,str) {
		if(document.forms[formname])
        	this.formname = formname;
        if(document.forms[formname].selname)
        	this.selname = selname;
        if(document.forms[formname].textname)
        	this.textname = textname;
        this.select_str = str || '';
        this.selectArr = new Array();
        this.initialize = initialize;
        this.bldInitial = bldInitial;
        this.bldUpdate = bldUpdate;
      }
      
      function initialize()
      {
      	if(!(this.formname && this.selname && this.textname))
      		return;
      	if (this.select_str =='') {
      		for(var i=0;i<document.forms[this.formname][this.selname].options.length;i++) {
      			this.selectArr[i] = document.forms[this.formname][this.selname].options[i];
      			this.select_str += document.forms[this.formname][this.selname].options[i].value+":"+
      			document.forms[this.formname][this.selname].options[i].text+",";
      		}
      	}
      	else
      	{
      		var tempArr = this.select_str.split(',');
      		for(var i=0;i<tempArr.length;i++) {
      			var prop = tempArr[i].split(':');
      			this.selectArr[i] = new Option(prop[1],prop[0]);
      		}
      	}
      	return;
      }
      
      function bldInitial() 
      {
      	if(!(this.formname && this.selname && this.textname))
      		return;
        this.initialize();
        for(var i=0;i<this.selectArr.length;i++)
          document.forms[this.formname][this.selname].options[i] = this.selectArr[i];
        document.forms[this.formname][this.selname].options.length = this.selectArr.length;
        return;
      }
      function bldUpdate() {
      	if(!(this.formname && this.selname && this.textname))
      		return;
        var str = document.forms[this.formname][this.textname].value.replace('^\\s*','');
        // If there is an empty String, don't search (hide list)
        if(str == '') {
          this.bldInitial();
          hideList();
          return;
        }
        this.initialize();
        // Show List as User Types
        showList();
        var j = 0;
        pattern1 = new RegExp("^"+str,"i");
        for(var i=0;i<this.selectArr.length;i++)
          if(pattern1.test(this.selectArr[i].text))
            document.forms[this.formname][this.selname].options[j++] = this.selectArr[i];
        document.forms[this.formname][this.selname].options.length = j;
        // If only one option meets the user's entry, select it, put the text in the field,
        // and close the list.
        if(j==1){
          document.forms[this.formname][this.selname].options[0].selected = true;
          document.forms[this.formname][this.textname].value = document.forms[this.formname][this.selname].options[0].text;
          hideList();
        }
        // If none of the options in the list meet the user's input, close list
        if (j==0) {
          hideList();
        }
      }
      function setUp(sbForm,sbEntry,sbLsit) {
        obj1 = new SelObj(sbForm,sbLsit,sbEntry);
        // menuform is the name of the form you use
        // itemlist is the name of the select pulldown menu you use
        // entry is the name of text box you use for typing in
        obj1.bldInitial(); 
      }
      <!-- Functions Below Added by Steven Luke -->
      function update(sbForm,sbEntry,sbLsit) {
        document.forms[sbForm].elements[sbEntry].value = document.forms[sbForm].elements[sbLsit].options[document.forms[sbForm].elements[sbLsit].selectedIndex].text;
        hideList();
      }
      function showList() {
        document.getElementById("lister").style.display="block";
      }
      function hideList() {
        document.getElementById("lister").style.display="none";
      }
      function changeList() {
        if (document.getElementById("lister").style.display=="none")
          showList();
        else
          hideList();
      }