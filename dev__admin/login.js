function onload(){
	document.getElementById('ipt-login').focus();
}
function login_validate(){
	 var login = document.getElementById('ipt-login');	
	 if(login.value==''){
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
	 }return true;
}
