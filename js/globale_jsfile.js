function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
   document.getElementById("aref").href = x.src;
}
var loadedobjects=""
var rootdomain="http://"+window.location.hostname

function ajaxpage(url, containerid,accommodation_id,tpy){
var page_request = false
if (window.XMLHttpRequest) // if Mozilla, Safari etc
page_request = new XMLHttpRequest()
else if (window.ActiveXObject){ // if IE
try {
page_request = new ActiveXObject("Msxml2.XMLHTTP")
} 
catch (e){
try{
page_request = new ActiveXObject("Microsoft.XMLHTTP")
}
catch (e){}
}
}
else
return false
page_request.onreadystatechange=function(){
loadpage(page_request, containerid)
}
//alert(url);
page_request.open('GET', url, true)
page_request.send(null)
}

function loadpage(page_request, containerid){
if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1))
document.getElementById(containerid).innerHTML=page_request.responseText
}

function loadobjs(){
if (!document.getElementById)
return
for (i=0; i<arguments.length; i++){
var file=arguments[i]
var fileref=""
if (loadedobjects.indexOf(file)==-1){ //Check to see if this object has not already been added to page before proceeding
if (file.indexOf(".js")!=-1){ //If object is a js file
fileref=document.createElement('script')
fileref.setAttribute("type","text/javascript");
fileref.setAttribute("src", file);
}
else if (file.indexOf(".css")!=-1){ //If object is a css file
fileref=document.createElement("link")
fileref.setAttribute("rel", "stylesheet");
fileref.setAttribute("type", "text/css");
fileref.setAttribute("href", file);
}
}
if (fileref!=""){
document.getElementsByTagName("head").item(0).appendChild(fileref)
loadedobjects+=file+" " //Remember this object as being already added to page
}
}
}

function chk_form()
{
	if(document.contactus.subject.value == "")
	{
		alert("please enter your subject");
		document.contactus.subject.focus();
		return false;
		}
	if(document.contactus.name.value == "")
	{
		alert("please enter your name");
		document.contactus.name.focus();
		return false;
		}
	if(document.contactus.email.value == "")
	{
		alert("please enter your email address");
		document.contactus.email.focus();
		return false;
		}
	if(!validateEmail(document.contactus.email.value))
	{
		alert("please enter your valid email address");
		document.contactus.email.focus();
		return false;
		}
}
function chk_newsletter_signup()
{
	if(document.newsletter_signup.newsletter_signup_email.value == "")
	{
		alert("please enter your email address");
		document.newsletter_signup.newsletter_signup_email.focus();
		return false;
		}
	if(!validateEmail(document.newsletter_signup.newsletter_signup_email.value))
	{
		alert("please enter your valid email address");
		document.newsletter_signup.newsletter_signup_email.focus();
		return false;
		}
	}
function chk_clientarea_signin()
{
	if(document.client_area_form.client_username.value == "")
	{
		alert("please enter your username");
		document.client_area_form.client_username.focus();
		return false;
		}
	if(document.client_area_form.client_password.value == "")
	{
		alert("please enter your Password");
		document.client_area_form.client_password.focus();
		return false;
		}
	}
function chk_clientarea_signin_main()
{
	if(document.client_area_form_main.client_username_main.value == "")
	{
		alert("please enter your username");
		document.client_area_form_main.client_username_main.focus();
		return false;
		}
	if(document.client_area_form_main.client_password_main.value == "")
	{
		alert("please enter your Password");
		document.client_area_form_main.client_password_main.focus();
		return false;
		}
	}
function checkregisterform()
{
	if(document.registerform.customerName.value == "")
	{
		alert("please enter your firstname");
		document.registerform.customerName.focus();
		return false;
		}
	if(document.registerform.lastName.value == "")
	{
		alert("please enter your lastname");
		ocument.registerform.lastName.focus();
		return false;
		}
	if(document.registerform.phone.value == "")
	{
		alert("please enter your phone");
		document.registerform.phone.focus();
		return false;
		}
	if(document.registerform.email.value == "")
	{
		alert("please enter your phone");
		document.registerform.email.focus();
		return false;
		}
	if(!validateEmail(document.registerform.email.value))
	{
		alert("please enter your valid email address");
		document.registerform.email.focus();
		return false;
		}
	if(document.registerform.password.value == "")
	{
		alert("please enter your password");
		document.registerform.password.focus();
		return false;
		}
	if(document.registerform.address.value == "")
	{
		alert("please enter your address");
		document.registerform.address.focus();
		return false;
		}
	if(document.registerform.zip.value == "")
	{
		alert("please enter your zipcode");
		document.registerform.zip.focus();
		return false;
		}
	/*if(document.registerform.stateCode.value == "")
	{
		alert("please enter your state");
		document.registerform.stateCode.focus();
		return false;
		}*/
	if(document.registerform.stateCode.value == "" && document.registerform.state.value == "")
	{
		alert("please enter your state");
		document.registerform.stateCode.focus();
		return false;
		}
	if(document.registerform.city.value == "")
	{
		alert("please enter your city");
		document.registerform.city.focus();
		return false;
		}
	if(document.registerform.CountryCode.value == "")
	{
		alert("please enter your country");
		document.registerform.CountryCode.focus();
		return false;
		}
	if(document.registerform.security_code.value == "")
	{
		alert("please enter security code");
		document.registerform.security_code.focus();
		return false;
		}
	}
function validateEmail(elementValue)
{
	var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
 	return emailPattern.test(elementValue); 
} 
function openWindow_32041(URL){
var wint = (screen.availHeight - 455) / 2; 
var winl = (screen.availWidth - 915) / 2; 
var args = 'scrollbars=1,height=506,width=900,top='+wint+',left='+winl+''
winpops=window.open(URL, '', args);
if (parseInt(navigator.appVersion) >= 4) { winpops.window.focus(); }}

function openWindow_virtualTour(URL){
var wint = (screen.availHeight - 455) / 2; 
var winl = (screen.availWidth - 915) / 2; 
var args = 'scrollbars=1,height=506,width=900,top='+wint+',left='+winl+''
winpops=window.open(URL, '', args);
if (parseInt(navigator.appVersion) >= 4) { winpops.window.focus(); }}
