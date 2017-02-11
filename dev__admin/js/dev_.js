 		function did(id){
			return document.getElementById(id);
		}
		function Goto(url){location=url;}
		function gettpl(){
		  if(document.getElementById('tpl').value==''){
          document.getElementById('pc').style.display='block';
		  }else{
			  document.getElementById('pc').style.display='none';
		  }
		}
		
		function activate(id){
			Form = document.pluginform;			
			document.pluginform.plug_a.value=id;
			Form.submit();
		}
		function de_activate(id){
			Form = document.pluginform;			
			document.pluginform.plug_d.value=id;
			Form.submit();
		}
		//function update(x){	document.getElementById(x).submit(); }
		/// Ajax Begin
		function makeajx(){
			var xml = null;
			if(window.XMLHttpRequest){
				xml = new XMLHttpRequest;
			}else{// code for IE6, IE5
			    xml = new ActiveXObject("Microsoft.XMLHTTP");
			  }
			return xml;
		}
		
		function update_admin_font(id){		 
		 var ajax = makeajx(); 
		 var which=null;	
	    if(id=='fs'){
			which = '?fs='+did(id).value;
			document.body.style.fontSize=did(id).value+'px';
			}
	    if(id=='ff'){
			which = '?fb='+did(id).value; 
			document.body.style.fontFamily=did(id).value;
			}
		 var url = 'change_font.php'+which;		 
		 ajax.open("POST",url,true)
		 ajax.send();
		 
		 ajax.onreadystatechange=function(){
		 if(ajax.readyState){
			 document.getElementById('').innerHTML=ajax.responseText;
		    }
		 }
		}
		
		function login_validate(page,showdiv){
			 var login = document.getElementById('ipt-login');	
			 if(login.value=='')
			 {
				 login.focus();
				 login.style.border='1px #D03E3E solid';
				 login.style.background='#F4B4B4';
				 login.style.color='#333333';
				 return false;
			 }
			 var pass = document.getElementById('ipt-password');	
			 if(pass.value==''){
				 pass.focus();
				 login.style.border='';
				 login.style.background='';
				 login.style.color='';
				 pass.style.border='1px #D03E3E solid';
				 pass.style.background='#F4B4B4';
				 pass.style.color='#333333';
				 return false;
			 }else{
		 var ajax = makeajx();
		 
		 var url = page+'?login='+login.value+'&password='+pass.value;
		 
		 ajax.open("POST",url,true)
		 ajax.send();
		 
		 ajax.onreadystatechange=function(){
		 if(ajax.readyState)
		 {
			 document.getElementById(showdiv).innerHTML=ajax.responseText;
		 }
		 }}
		}
		
		function add_page(page,showdiv,id){
		 var Id = document.getElementById(id).value;
		 var ajax = makeajx();		 
		 var url = page+'?page='+Id;		 
		 ajax.open("POST",url,true)
		 ajax.send();		 
		 ajax.onreadystatechange=function(){
		 if(ajax.readyState){
			 document.getElementById(showdiv).innerHTML=ajax.responseText;
		 }
		 }
		}
		// Delete function wthout load 
		function dev_delete(page,showdiv,Id,which){
		if(confirm('Are you sure want to delete?')){
		setTimeout("location.reload(true);",2000);
		var ajax = makeajx();		 
		 var url = page+'?delete='+Id+'&type='+which;		 
		 ajax.open("POST",url,true)
		 ajax.send();		 
		 ajax.onreadystatechange=function(){
		 if(ajax.readyState)
		 {
			 document.getElementById(showdiv).innerHTML=ajax.responseText;
		 }
		 }}else{
			 return false;
		 }
		}
		