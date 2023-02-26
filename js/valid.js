function validate() {
      
         if( document.signUp.ID.value == "" ) {
            alert( "Please provide your ID!" );
            document.signUp.ID.focus() ;
            return false;
         }
         if( document.signUp.fname.value == "" ) {
            alert( "Please provide your first name!" );
            document.signUp.fname.focus() ;
            return false;
         }
          if( document.signUp.Lname.value == "" ) {
            alert( "Please provide your last name!" );
            document.signUp.Lname.focus() ;
            return false;
         }
          if( document.signUp.job.value == "" ) {
            alert( "Please provide your job title!" );
            document.signUp.job.focus() ;
            return false;
         }
         if( document.signUp.pass.value == "" ||  document.signUp.pass.value.length <= 5 ) {   
            alert( "Please provide a password longer than 5" );
            document.signUp.pass.focus() ;
            return false;
         }
          //window.location.href="emHomePage.html";
         
      }
    
function valid2(){

         if( document.loginEmp.ID.value == "" ) {
            alert( "Please provide your ID!" );
            document.loginEmp.ID.focus() ;
            return false;
         }
         if( document.loginEmp.pass.value == "" ||  document.loginEmp.pass.value.length <= 5 ) {   
            alert( "Please provide a password longer than 5" );
            document.loginEmp.pass.focus() ;
            return false;
         }  
          //window.location.href="emHomePage.html";
}
function valid3(){

         if( document.loginMan.userName.value == "" ) {
            alert( "Please provide your username!" );
            document.loginMan.userName.focus() ;
            return false;
         }
         if( document.loginMan.pass.value == "" ||  document.loginMan.pass.value.length <= 5 ) {   
            alert( "Please provide a password longer than 5" );
            document.loginMan.pass.focus() ;
            return false;
         }
         // window.location.href="manHomePage.html";
          
       
}
