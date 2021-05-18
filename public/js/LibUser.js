
//
var LibUser =  {
  valid_form : function(){
    try{
      var ret = false
      var elem = document.getElementById('name');
      var email = document.getElementById('email');
      var password = document.getElementById('password');
      if(elem.value==''){
        alert("Error, name is required")
        return ret; 
      }
      if(email.value==''){
        alert("Error, email is required")
        return ret; 
      }
      if(password.value==''){
        alert("Error, password is required")
        return ret; 
      }
      ret = true
      return ret;  
    } catch (e) {
      console.log(e);
      throw new Error('Error , valid_form');
    } 
  },
  
}
