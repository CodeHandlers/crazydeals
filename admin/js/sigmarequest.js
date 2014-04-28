/*****************************************************************

	SigmaWidgets 1.6  (developer version)
	Copyright (C) 2005-2007 Sigma Soft Ltd. All Rights Reserved. 
	http://www.sigmawidgets.com/

	WARNING: This software program is protected by copyright law 
	and international treaties. Unauthorized reproduction or
	distribution of this program, or any portion of it, may result
	in severe civil and criminal penalties, and will be prosecuted
	to the maximum extent possible under the law.

	FOR DEVELOPMENT ONLY WITH TWO CONNECTIONS LIMITED:
	This software is not free and is licensed to you for development 
	and evaluation only. You are not allowed to distribute 
	or use any parts of this software for any commercial purposes.
   
       Compressed by JSA(www.xidea.org)

*****************************************************************/

function showWaitingLayer(){var A=document.all("_waiting");if(A==null){A=document.createElement("div");A.id="_waiting";with(A.style){position="absolute";left=0;top=0;width=document.body.clientWidth;height=document.body.clientHeight;zIndex=1000;backgroundColor="rgb(200,220,250)"}var B=[];B.push("<table border=1 style=\"width:100%;height:100%\"><tr><td align=center valign=center >");B.push("<div class=\"loading\"></div></td></tr></table>");A.innerHTML=B.join("");document.body.appendChild(A)}else A.style.display="";A.style.cursor="wait"}function hideWaitingLayer(){var A=document.all("_waiting");if(A!=null){A.style.cursor="default";A.style.display="none"}}function SigmaRequest(){var oThis=this,value=null,text=null,xml=null,xmlhttp=null;this.parameters=new Object();try{xmlhttp=new ActiveXObject("Msxml2.XMLHTTP")}catch(e1){try{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP")}catch(e2){try{xmlhttp=new XMLHttpRequest()}catch(e3){}}}if(xmlhttp==null)alert("Not able to create an XMLHttpRequest.");this.open=function(C,B,A){showWaitingLayer();xml=null;value=null;text=null;xmlhttp.open(C,B,A);xmlhttp.setRequestHeader("CONTENT-TYPE","application/x-www-form-urlencoded");xmlhttp.onreadystatechange=function(){if(xmlhttp.readyState==4)if(xmlhttp.status==200||xmlhttp.status==0){oThis.onresult();hideWaitingLayer()}else if(xmlhttp.status==404)alert("URL: ("+B+") NOT found.");else alert("Status - "+xmlhttp.status)}};this.getXMLDoc=function(){if(xml==null)xml=xmlhttp.responseXML;return xml};this.setParameter=function(A,B){oThis.parameters[A]=B};this.clearParameters=function(){oThis.parameters=new Object()};this.send=function(){window._ajaxReq=oThis;setTimeout("window._ajaxReq.trueSend()",1)};this.trueSend=function(){var D=[],C=null,B=/&/g;for(key in oThis.parameters){C=oThis.parameters[key];if(C.constructor==Function)continue;if(C==null)continue;if(C.constructor==String)C=C.replace(B,"%26");D.push(key+"="+C)}var A=D.join("&");xmlhttp.send(A);oThis.clearParameters()};this.getValue=function(){if(value==null){try{var r="obj="+oThis.getText();value=eval(r)}catch(e){alert("Exception caught when trying to eval:\n"+text);value=null}}return value};this.getText=function(){if(text==null)text=xmlhttp.responseText;return text};this.onresult=function(){}}