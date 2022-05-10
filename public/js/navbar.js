function myFunction() {
	var x = document.getElementById("menu");
	// console.log(x);
	if (x.className==="menu") {
	  x.className+=" responsive";
	} else {
	  x.className = "menu";
	}
  }