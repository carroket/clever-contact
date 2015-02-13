/*============================================================================*\
	   ________                       ______            __             __
	  / ____/ /__ _   _____  _____   / ____/___  ____  / /_____ ______/ /_
	 / /   / / _ \ | / / _ \/ ___/  / /   / __ \/ __ \/ __/ __ `/ ___/ __/
	/ /___/ /  __/ |/ /  __/ /     / /___/ /_/ / / / / /_/ /_/ / /__/ /_
	\____/_/\___/|___/\___/_/      \____/\____/_/ /_/\__/\__,_/\___/\__/

	Optional Deployment-Specific JavaScript for Clever Contact
	-----------------------------------------------------------------------
	© 2015 by Carroket, Inc.
	http://www.carroket.com/
	-----------------------------------------------------------------------
	Made by Brian Sexton.
	http://www.briansexton.com/
	-----------------------------------------------------------------------
	MIT License

\*============================================================================*/


window.addEventListener("load", function() {

	var form = document.querySelector("form");

	form.addEventListener("success", function(event) {

		console.info("Success! %o", event);

		this.reset();

		window.alert("Success!");
	});

	form.addEventListener("failure", function(event) {

		console.info("Failure! %o", event);

		window.alert("Success!");
	});

});