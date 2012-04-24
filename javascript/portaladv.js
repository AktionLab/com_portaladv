// handles checkbox functionality

function showAreas(div) {
	var list = document.getElementById(div);
	if (list.className == 'hidden') {
		list.className = 'visible';
	} else {
		list.className = 'hidden';
	}
}

function showAreaVideo(src) {
	var box = document.getElementById('extra_info_container');
	box.innerHTML = src;
} 

function showVirtualTour(link) {
	var box = document.getElementById('extra_info_container');
	box.innerHTML = '<iframe src="' + link + '" width="100%" height="600" border="0" scrolling="no" style="border:0px solid #ffffff;"></iframe>';
} 

function showBrochure(src) {
	var box = document.getElementById('extra_info_container');
	box.innerHTML = src;
} 

function showFloorPlan(src) {
	var box = document.getElementById('extra_info_container');
	box.innerHTML = src;
}

function showVideo(src) {
	var box = document.getElementById('extra_info_container');
	box.innerHTML = src;
} 

function checkInput(el) {
	var inputName = el.name;
	var formName = el.form.name;
	if (el.value == 0 && el.checked == true) {
		for(i=0;i<document.forms[formName][inputName].length;i++) {
			if (document.forms[formName][inputName][i].value != 0) {
				document.forms[formName][inputName][i].checked = false;
			}
		}
		return;
	} 
	if (el.value != 0 && el.checked == true) {
		for(i=0;i<document.forms[formName][inputName].length;i++) {
			if (document.forms[formName][inputName][i].value == 0) {
				document.forms[formName][inputName][i].checked = false;
				return;
			}
		}
	}
}

function clearAll() {
     var boxes = document.getElementsByTagName('input'); 

     for (i = 0; i < boxes.length; i++) {
          if (boxes[i].type == 'checkbox')
                boxes[i].checked = false;
                //document.getElementById('check_'+ boxes[i].value).style.background = '';
     }
}

function popUp(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=700,height=500,left = 200,top = 200');");
}

function clickclear(thisfield, defaulttext) {
	if (thisfield.value == defaulttext) {
	thisfield.value = "";
	}
}

function clickrecall(thisfield, defaulttext) {
	if (thisfield.value == "") {
	thisfield.value = defaulttext;
	}
}

function Comma(number) {
	number = '' + number;
	if (number.length > 3) {
		var mod = number.length % 3;
		var output = (mod > 0 ? (number.substring(0,mod)) : '');
		for (i=0 ; i < Math.floor(number.length / 3); i++) {
			if ((mod == 0) && (i == 0))
				output += number.substring(mod+ 3 * i, mod + 3 * i + 3);
			else
				output+= ',' + number.substring(mod + 3 * i, mod + 3 * i + 3);
		}
		return (output);
	}
	else return number;
}

function hide_overlib() {
	document.getElementById('overlib_save_search').style.display = 'none';
}
