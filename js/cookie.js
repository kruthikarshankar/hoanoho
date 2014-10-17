
// get a value of a cookie
function getCookie(name) {
   var i=0;  
   var searchstring = name + "=";
   
   while (i < document.cookie.length) {
      if (document.cookie.substring(i, i + searchstring.length) == searchstring) {
         var end = document.cookie.indexOf(";", i + searchstring.length);
         end = (end > -1) ? end : document.cookie.length;
         var cook = document.cookie.substring(i + searchstring.length, end);
         return unescape(cook);
      }
      i++;
   }
   return null;
}

// Cookie setzen
function setCookie(name, value){
   var cook = name + "=" + unescape(value);
   //cook += (domain) ? "; domain=" + domain : "";
   //cook += (expires) ? "; expires=" + expires : "";
   //cook += (path) ? "; path=" + path : "";

   //cook += (secure) ? "; secure" : "";
   document.cookie = cook;
}
