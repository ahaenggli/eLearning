// globale Instanz von XMLHttpRequest
var xmlHttp = false;
var nun = true;
// XMLHttpRequest-Instanz erstellen
// ... für Internet Explorer
try {
    xmlHttp  = new ActiveXObject("Msxml2.XMLHTTP");
} catch(e) {
    try {
        xmlHttp  = new ActiveXObject("Microsoft.XMLHTTP");
    } catch(e) {
        xmlHttp  = false;
    }
}
// ... für Mozilla, Opera und Safari
if (!xmlHttp  && typeof XMLHttpRequest != 'undefined') {
    xmlHttp = new XMLHttpRequest();
}



function OnHSandLD(){
if (xmlHttp) {
     xmlHttp.open('POST', 'index.html', true);
     xmlHttp.onreadystatechange = function () {
         if (xmlHttp.readyState == 4) {
if(document.asia.moos.value == '1'){
if(document.asia.mool.value == '1'){
OnLD();
}
else{}

         }else{}
     };
   //  xmlHttp.send(null);
 }
}
}


function OnHS(thisv){
if (xmlHttp) {
     xmlHttp.open('POST', 'index.html', true);
     xmlHttp.onreadystatechange = function () {
         if (xmlHttp.readyState == 4) {
        
         i = 1; 
if(document.asia.moos.value == '0'){
document.asia.morom.value = 'Mit Hauptstadt';
document.asia.moos.value = '1';
while(i<60){
var elbid = "hss_"+i;
if(window.document.getElementById(elbid)) window.document.getElementById(elbid).style.display='none';
i=i+1;

}
}else{
document.asia.moos.value = '0';
document.asia.morom.value = 'Ohne Hauptstadt';
while(i<50){
var elbid = "hss_"+i;
if(window.document.getElementById(elbid)) window.document.getElementById(elbid).style.display='block';
i=i+1;
}

}

         }
     };
     xmlHttp.send(null);
 }
//}
}
function OnLD(thisv){


if (xmlHttp) {
     xmlHttp.open('POST', 'index.html', true);
     xmlHttp.onreadystatechange = function () {
         if (xmlHttp.readyState == 4) {
        
         i = 1;
if(document.asia.mool.value == '0'){
document.asia.morol.value = 'Mit Land';
document.asia.mool.value = '1';
while(i<60){
var elbid = "hss2_"+i;
if(window.document.getElementById(elbid)) window.document.getElementById(elbid).style.display='none';
i=i+1;

}
}else{
document.asia.mool.value = '0';
document.asia.morol.value = 'Ohne Land';
while(i<50){
var elbid = "hss2_"+i;
if(window.document.getElementById(elbid)) window.document.getElementById(elbid).style.display='block';
i=i+1;
}

}

         }
     };
     xmlHttp.send(null);
 }
//}
}
function OnHO(thisv){
if (xmlHttp) {
     xmlHttp.open('POST', 'index.html', true);
     xmlHttp.onreadystatechange = function () {
         if (xmlHttp.readyState == 4) {
        
         i = 1; 
if(document.asia.moos.value == '0'){
document.asia.morom.value = 'Mit Hauptort';
document.asia.moos.value = '1';
while(i<60){
var elbid = "hss_"+i;
if(window.document.getElementById(elbid)) window.document.getElementById(elbid).style.display='none';
i=i+1;

}
}else{
document.asia.moos.value = '0';
document.asia.morom.value = 'Ohne Hauptort';
while(i<50){
var elbid = "hss_"+i;
if(window.document.getElementById(elbid)) window.document.getElementById(elbid).style.display='block';
i=i+1;
}

}

         }
     };
     xmlHttp.send(null);
 }
//}
}
function OnKT(thisv){


if (xmlHttp) {
     xmlHttp.open('POST', 'index.html', true);
     xmlHttp.onreadystatechange = function () {
         if (xmlHttp.readyState == 4) {
        
         i = 1;
if(document.asia.mool.value == '0'){
document.asia.morol.value = 'Mit Kanton';
document.asia.mool.value = '1';
while(i<60){
var elbid = "hss2_"+i;
if(window.document.getElementById(elbid)) window.document.getElementById(elbid).style.display='none';
i=i+1;

}
}else{
document.asia.mool.value = '0';
document.asia.morol.value = 'Ohne Kanton';
while(i<50){
var elbid = "hss2_"+i;
if(window.document.getElementById(elbid)) window.document.getElementById(elbid).style.display='block';
i=i+1;
}

}

         }
     };
     xmlHttp.send(null);
 }
//}
}

function OnKZ(thisv){
if (xmlHttp) {
     xmlHttp.open('POST', 'index.html', true);
     xmlHttp.onreadystatechange = function () {
         if (xmlHttp.readyState == 4) {
        
         i = 1; 
if(document.asia.mook.value == '0'){
document.asia.morok.value = 'Mit Kennzeichen';
document.asia.mook.value = '1';
while(i<60){
var elbid = "hsss_"+i;
if(window.document.getElementById(elbid)) window.document.getElementById(elbid).style.display='none';
i=i+1;

}
}else{
document.asia.mook.value = '0';
document.asia.morok.value = 'Ohne Kennzeichen';
while(i<50){
var elbid = "hsss_"+i;
if(window.document.getElementById(elbid)) window.document.getElementById(elbid).style.display='block';
i=i+1;
}

}

         }
     };
     xmlHttp.send(null);
 }
//}
}
function OnWA(thisv){
if (xmlHttp) {
     xmlHttp.open('POST', 'index.html', true);
     xmlHttp.onreadystatechange = function () {
         if (xmlHttp.readyState == 4) {
        
         i = 1; 
if(document.asia.moow.value == '0'){
document.asia.morow.value = 'Mit Wappen';
document.asia.moow.value = '1';
while(i<27){
var elbid = "DragContainer"+i;
if(window.document.getElementById(elbid)) window.document.getElementById(elbid).style.display='none';
i=i+1;

}
}else{
document.asia.moow.value = '0';
document.asia.morow.value = 'Ohne Wappen';
while(i<27){
var elbid = "DragContainer"+i;
if(window.document.getElementById(elbid)) window.document.getElementById(elbid).style.display='block';
i=i+1;
}

}

         }
     };
     xmlHttp.send(null);
 }
//}
}
