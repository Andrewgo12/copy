/**
* dhtmlPopWindow v0.1
*	By: me@daantje.nl
*	Mon Jun 26 14:33:04 CEST 2006
*
*	DESCRIPTION:
*		Wrote this script, cause I needed something to fool the popup killers.
*		This script pops a DHTML div with an iframe with the given page.
*		The popped window appears always in the center of the window/frame.
*		But it's draggable across the window/frame. All the layout can be done
*		with a CSS style sheet. This is what I needed till now, but this script
*		could be somewhat better. Check the todo list...
*
*	DONATE:
*		When you like my script, please do a big or smal PayPal donation to me@daantje.nl
*
*	SUPPORT:
*		Check http://www.daantje.nl
*
*	BUGS AND PATCHES:
*		Please mail me any bugs and/or patches!
*
*	TODO LIST:
*		When you fiel the need to help...
*		- Add scale window funtionality.
*		- Make close button configurable.
*		- Add configurable window placement.
*		- Add configurable window target name.
*		- Add multiple window support.
*
*	LICENSE:
*		This script is GPL. (http://www.gnu.org/copyleft/gpl.txt)
*/

//init globals (DON'T TOUCH!)
_movePopWindowTrigger = false;
_popWindowOffsetX = 0;
_popWindowOffsetY = 0;
_lastPopWindowLeft = 0;
_lastPopWindowTop = 0;


/**
* popWindow(STRING mypage [, INT w] [, INT h] [,BOOL gui]);
*	pop a navigator window with my own specs
*		mypage	: STRING	URL to display
*		w		: INT		window width in pixels
*		h		: INT		window heigth in pixels
*		gui		: BOOL		show window title bar, default true
*/
function popWindow(mypage,w,h,gui){
    //set defaults
    w = w ? w : 200;
    h = h ? h : 150;

	//get or create element...
    if(!document.getElementById('popwindiv')){
        //create div
	    popwindiv = document.createElement('DIV');
	    popwindiv.id = 'popwindiv';
    	popwindiv.style.position = document.all ? 'absolute' : 'fixed'; //fixed position for MSIE is patched!
	    popwindiv.style.zIndex = 1000000;
	    popwindiv.style.visibility = 'hidden';
        popwindiv.style.backgroundColor = '#ffffff';
        document.getElementsByTagName('body')[0].appendChild(popwindiv);

		//add gui
		if(gui !== false){
			popwingui = document.createElement('DIV');
			popwingui.id = 'popwingui';
			popwingui.style.textAlign = 'right';
			popwingui.innerHTML = "<a href=\"javascript:void(0);\" onclick=\"javascript:document.getElementById('popwindiv').style.visibility='hidden';\" style=\"text-decoration:none;color:#707070;background-color:#cccccc;border:2px outset #c0c0c0;font-size:10px;font-family:arial;\">X</a>";
			popwindiv.appendChild(popwingui);
		}

	    //add iframe
	    popwiniframe = document.createElement('IFRAME');
		popwiniframe.id = 'popwiniframe';
		popwiniframe.name = 'popwin';
		popwiniframe.frameBorder = 0;
		if(document.all){
		    popwiniframe.onmouseover = function(){_movePopWindowTrigger=false;};
		}else{
			popwiniframe.setAttribute('onmouseover','_movePopWindowTrigger=false;');
		}
		popwindiv.appendChild(popwiniframe);
    }else{
    	//get elements
	    popwindiv = document.getElementById('popwindiv');
	    popwingui = document.getElementById('popwingui');
	    popwiniframe = document.getElementById('popwiniframe');
    }

	//when mypage is an imgage file, kill margins. (this doesn't seem to work on Mozilla based browsers??)
	ext = mypage.substring(mypage.lastIndexOf('.') + 1);
	if(ext == 'gif' || ext == 'png' || ext == 'jpg' || ext == 'jpeg'){
		popwiniframe.setAttribute('marginWidth','0');
		popwiniframe.setAttribute('marginHeight','0');
	}else{
		popwiniframe.setAttribute('marginWidth','10');
		popwiniframe.setAttribute('marginHeight','10');
	}

    //resize element...
    popwindiv.style.width = w + 'px';
    popwindiv.style.height = (h + parseInt(popwingui.offsetHeight)) + 'px';
	popwiniframe.style.width = w + 'px';
	popwiniframe.style.height = h + 'px';

    //position the popup
    if(document.all){
		//patch position for MSIE
		popwindiv.style.top = _lastPopWindowTop = (parseInt((document.body.clientHeight / 2) - (parseInt(popwindiv.style.height) / 2)) + document.body.scrollTop) + 'px';
		popwindiv.style.left = _lastPopWindowLeft = (parseInt((document.body.clientWidth / 2) - (parseInt(popwindiv.style.width) / 2)) + document.body.scrollLeft) + 'px';
    	//emulate fixed position.
        //window.onscroll = window.onresize = _MSIEpositionPopWindow;
    }else{
		//set position other browsers
		popwindiv.style.top = ((window.innerHeight / 2) - (h / 2)) + 'px';
		popwindiv.style.left = ((window.innerWidth / 2) - (w / 2)) + 'px';
    }

	//get page
	popwiniframe.src = mypage;

	//add drag and drop functionality.
	document.onmousedown = _movePopWindow;
	document.onmouseup = new Function('_movePopWindowTrigger=false;');

	//show popup
	popwindiv.style.visibility = '';
}

/**
* _MSIEpositionPopWindow()
*	nasty patch for fixed position for MSIE
*	(This can be done better, only not without a CSS style. And because I want this script to be fool proof...)
*/
function _MSIEpositionPopWindow(){
	popwindiv = document.getElementById('popwindiv');
	popwindiv.style.top = (parseInt(_lastPopWindowTop) + document.body.scrollTop) + 'px';
	popwindiv.style.left = (parseInt(_lastPopWindowLeft) + document.body.scrollLeft) + 'px';
}

/**
* _movePopWindow()
*	Init the drag of the popup window...
*/
function _movePopWindow(e){
	bar = document.all ? event.srcElement.id : e.target.id;
	if(bar == 'popwingui'){
		//get start mouse position
		_popWindowOffsetX = document.all ? event.clientX : e.clientX;
		_popWindowOffsetY = document.all ? event.clientY : e.clientY;

		//get window position
		popwindiv = document.getElementById('popwindiv');
		tempx = parseInt(popwindiv.style.left);
		tempy = parseInt(popwindiv.style.top);

		//do movement
		_movePopWindowTrigger = true;
		document.onmousemove = _dragPopWindow;
	}
}

/**
* _dragPopWindow()
*	Do movement of window....
*/
function _dragPopWindow(e){
	if(_movePopWindowTrigger == true){
		//push to new position
		popwindiv = document.getElementById('popwindiv');
		if(document.all){
			popwindiv.style.left = _lastPopWindowLeft = (tempx + (event.clientX - _popWindowOffsetX)) + 'px';
			popwindiv.style.top = _lastPopWindowTop = (tempy + (event.clientY - _popWindowOffsetY)) + 'px';
		}else{
			popwindiv.style.left = _lastPopWindowLeft = (tempx + (e.clientX - _popWindowOffsetX)) + 'px';
			popwindiv.style.top = _lastPopWindowTop = (tempy + (e.clientY - _popWindowOffsetY)) + 'px';
		}
	}
	return false;
}

