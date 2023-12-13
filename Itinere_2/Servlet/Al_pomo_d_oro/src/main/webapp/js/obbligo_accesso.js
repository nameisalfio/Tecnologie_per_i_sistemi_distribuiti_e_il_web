const usernameInput = document.getElementById("username");
const passwordInput = document.getElementById("password");
const submitButton = document.getElementById("submit");
const span = document.getElementById("errore");
const hide = document.getElementById("hide");
let check = false;
submitButton.disabled=true;
usernameInput.addEventListener("input", buttonisDisabled);
passwordInput.addEventListener("input", buttonisDisabled);
function buttonisDisabled() {
  const usernameValue = usernameInput.value;
  const passwordValue = passwordInput.value;
  span.style.display = "none";
  
 
  if (usernameValue.trim() !== "" && passwordValue.trim() !== "") {
    submitButton.disabled = false;
  } else {
    submitButton.disabled = true;
  } 
} 
hide.addEventListener("click", ((e)=>{
	e.stopPropagation();
	check = !check
	if (check){
		password.type = "text";
		hide.setAttribute("name","show");
	}else{
		password.type = "password";
		hide.setAttribute("name","hide");
	}
}))