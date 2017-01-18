function formatNumber (val, decimal) {
	   anynum=eval(val);
	   divider =10;
	   switch(decimal){
			case 0:
				divider =1;
				break;
			case 1:
				divider =10;
				break;
			case 2:
				divider =100;
				break;
			default:  	 //for 3 decimal places
				divider =1000;
		}

	   workNum=Math.abs((Math.round(anynum*divider)/divider));

	   workStr=""+workNum

	   if (workStr.indexOf(".")==-1){workStr+="."}

	   dStr=workStr.substr(0,workStr.indexOf("."));dNum=dStr-0
	   pStr=workStr.substr(workStr.indexOf("."))

	   while (pStr.length-1< decimal){pStr+="0"}

	   if(pStr =='.') pStr ='';

	   //--- Adds a comma in the thousands place.    
	   if (dNum>=1000) {
		  dLen=dStr.length
		  dStr=parseInt(""+(dNum/1000))+","+dStr.substring(dLen-3,dLen)
	   }

	   //-- Adds a comma in the millions place.
	   if (dNum>=1000000) {
		  dLen=dStr.length
		  dStr=parseInt(""+(dNum/1000000))+","+dStr.substring(dLen-7,dLen)
	   }
	   retval = dStr + pStr
	   //-- Put numbers in parentheses if negative.
	   if (anynum<0) {retval="("+retval+")";}

	  
	//You could include a dollar sign in the return value.
	  //retval =  "$"+retval
	  
	  return retval;
 }

function trim (inputString) {
	removeChar = ' ';
	var returnString = inputString;
	if (removeChar.length) {
		while(''+returnString.charAt(0)==removeChar) {
			returnString=returnString.substring(1,returnString.length);
		}
		while(''+returnString.charAt(returnString.length-1)==removeChar) {
			returnString=returnString.substring(0,returnString.length-1);
		}
	}
	return returnString;
}

function isLeapYear(yr) {
	return new Date(yr,2-1,29).getDate()==29;
}

function checkUsername(s) {
	//accept username at least chars
	var pattern = /^\w{5,}$/;
	return pattern.test(s);
}

// only accept numerals and return character.
function inNumOnly(e) {
	if(window.event) {
		key = e.keyCode; 
	}
	else if(e.which) {
		key = e.which; 
	}
	return ((key >= 48) && (key <= 57) || (key == 13) || (key == 8)) ? key : false;
}

function IsNumeric(sText)
{
   var ValidChars = "0123456789.,";
   var IsNumber=true;
   var Char;

 
   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
   return IsNumber;
   
   }


function isValidEmail(s) {
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return filter.test(s);
}

function genPass() {
	var charset = 'abcdefghijklmnopqrstuvwxyz0123456789';
	var passLength = 7;
	var str = '';
	for (i=1; i<=passLength; i++) {
		str += charset.charAt(Math.round(Math.random()*charset.length));
	}
	return str;
}
function popWin(u,param){
	window.open(u,'newWin',param);
	return
}