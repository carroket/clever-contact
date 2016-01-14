/*============================================================================*\
	   ________                       ______            __             __
	  / ____/ /__ _   _____  _____   / ____/___  ____  / /_____ ______/ /_
	 / /   / / _ \ | / / _ \/ ___/  / /   / __ \/ __ \/ __/ __ `/ ___/ __/
	/ /___/ /  __/ |/ /  __/ /     / /___/ /_/ / / / / /_/ /_/ / /__/ /_
	\____/_/\___/|___/\___/_/      \____/\____/_/ /_/\__/\__,_/\___/\__/

	JavaScript for Clever Contact
	-----------------------------------------------------------------------
	© 2015 by Carroket, Inc.
	http://www.carroket.com/
	-----------------------------------------------------------------------
	Made by Brian Sexton.
	http://www.briansexton.com/
	-----------------------------------------------------------------------
	MIT License

\*============================================================================*/

(function(window, options) {

	var cleverContact = new CleverContact();

	function CleverContact() {

		if (options instanceof Object && options.resetOnSuccess === true) {

			this.resetOnSuccess = true;
		}
	}

	CleverContact.prototype.submit = function(form, url) {

		if (!(form instanceof HTMLFormElement)) {

			throw new Error("To submit a form, Clever Contact needs a reference to a form element.");
		}

		if (typeof url !== "string" || url.length === 0) {

			throw new Error("To submit a form, Clever Contact needs to know what URL to use.");
		}

		var formData = new FormData(form);

		var instance = this;

		var userInputElements = form.querySelectorAll("input, textarea");

		var request = new XMLHttpRequest();

		[].forEach.call(userInputElements, function (element) {

			element.disabled = true;
		});

		request.open("POST", url);

		request.onreadystatechange = function() {

			if (request.readyState === 4) {

				var event;

				var response = JSON.parse(request.response);

				var summary;

				[].forEach.call(userInputElements, function (element) {

					element.disabled = false;
				});

				if (request.status === 200 && response.accepted === true) {

					// Prepare a CustomEvent object for message-sending success.

					summary = {

						httpStatus: request.status,
						accepted: true,
						submission: response.submission
					};

					event = new CustomEvent("success", { detail: summary });

					// If requested, reset the form.

					if (instance.resetOnSuccess) {

						form.reset();
					}
				}

				else {

					// Prepare a CustomEvent object for message-sending failure.

					summary = {

						httpStatus: request.status,
						accepted: response.accepted,
						submission: response.submission
					};

					event = new CustomEvent("failure", { detail: summary });
				}

				// Dispatch the CustomEvent object created above.

				form.dispatchEvent(event);
			}
		};

		request.send(formData);
	};

	// If a namespace was specified, attach cleverContact to it.

	if (options instanceof Object && options.namespace instanceof Object) {

		options.namespace.cleverContact = cleverContact;
	}

})(window);