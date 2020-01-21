document.getElementsByName('total')[0].setAttribute("value","5.99");//sets total box to 5.99, the default delivery price.


checkboxesRecord(); //runs functions
radioButtons();
customerType();
checkForm();
function checkboxesRecord() {
	var checkboxRecord = document.getElementsByName('record[]'); //sets via name attribute record[].
	var	output = document.getElementsByName('total')[0]; // 1 instance of total, so it's in index 0.
	for (var i=0; i < checkboxRecord.length; i++) {
     checkboxRecord[i].onchange = function recordPrice() { //function is a constructor it assigns a function to the object.
         var add = this.dataset.price * (this.checked ? 1 : -1); //if statement, if true then multiply price by 1, if unticked multiply by -1.
         total = parseFloat(document.getElementsByName('total')[0].value);
         total += add;
 				 total = parseFloat(total.toFixed(3)); //rounds total to 2 decimal places, this prevents floating point approximations.
 				 output.value = total; //puts the total value into the total box on the form.
     		}

 			}

		}
	function radioButtons() {
		var	radioButton = document.getElementsByName('deliveryType'); //sets via name attribute deliveryType.
		var	output = document.getElementsByName('total')[0]; // 1 instance of total, so it's in index 0.
	     radioButton[0].onchange = function delivery() { //adds delivery price from total
	         var add = this.dataset.price * 1;
					 total = parseFloat(document.getElementsByName('total')[0].value);
					 total += add;
					 total = parseFloat(total.toFixed(3));
					 output.value = total; //puts the total value into the total box on the form.
	     		}
					radioButton[1].onchange = function delivery() { //takesaway delivery price from total
							var add = radioButton[0].dataset.price * -1;
							total = parseFloat(document.getElementsByName('total')[0].value);
							if (total == 0) {
								output.value = total; //prevents negative number displaying
							} else {
								total += add;
								total = parseFloat(total.toFixed(3));
								output.value = total; //puts the total value into the total box on the form.
							}
						 }

	}
	function customerType() {
		var	customerSelect = document.getElementsByName('customerType');//sets via name attribute customerType.
		for (var i=0; i < customerSelect.length; i++) {
	     customerSelect[i].onchange = function type() { //function is activated when the checkbox state changes.
				 console.log(this.value);
				 if (this.value == "ret") {
					 document.getElementById('retCustDetails').style.visibility = "visible";
					 document.getElementById('tradeCustDetails').style.visibility = "hidden";
				 }
				 else if (this.value == "trd") {
					 document.getElementById('tradeCustDetails').style.visibility = "visible";
					 document.getElementById('retCustDetails').style.visibility = "hidden";

				 } else {
					 alert('Please choose a customer type');
					 document.getElementById('retCustDetails').style.visibility = "hidden";
					 document.getElementById('tradeCustDetails').style.visibility = "hidden";
				 }
			 }
		 }
	 }

	 function checkForm() {
		 var termsCheckbox = document.getElementsByName('termsChkbx');//sets via name attribute termsChkbx.
		 termsCheckbox[0].onchange = function submitChecks() { //checks when the terms box is ticked
			 	var checkboxRecord = document.getElementsByName('record[]'); //sets via name attribute record[].
				    hasChecked = false;
						hasSelected = false;
						input_firstName = document.getElementsByName('forename');
						input_secondName = document.getElementsByName('surname');
						input_coporate = document.getElementsByName('companyName');
						customerSelect = document.getElementsByName('customerType');//sets via name attribute customerType.
				for (var i = 0; i < checkboxRecord.length; i++) {
					if (checkboxRecord[i].checked) {     //checks if a record has be checked
						hasChecked = true;
						break;
						}
					}
				if (hasChecked == false) {
					alert("Please select a record to order!"); //alerts the user to select a record
					document.getElementsByName('submit')[0].disabled = true;
					this.checked = false; //resets the terms checkbox
				} else {
					//
				}
				for (var i = 0; i < customerSelect.length; i++) {
					if (customerSelect[i].value == "ret") { //checks if the customer type has been selected via the value attribute
 					 hasSelected = true;
					 if (input_firstName[0].value == "") { //checks for text in forename.
					 	alert("Please enter a valid forename!");
						this.checked = false; //resets the terms checkbox
					 }
					 if (input_secondName[0].value == "") { //checks for text in surname.
						 alert("Please enter a valid surname");
						 this.checked = false; //resets the terms checkbox
					 }
					 break;
 				 }
 				 else if (customerSelect[i].value == "trd") {
					 hasSelected = true;
					 if (input_coporate[0].value == "") { //checks for text in company name.
					 	alert("Please enter a company name!");
						this.checked = false; //resets the terms checkbox
					 }
					 break;
 				 } else { //if values entered are not valid
 					 hasSelected = false;
					 break;
 				 }
				}
				if (hasSelected == false) {
					alert("Please select a customer type!"); //alert the user to select a customer type.
					document.getElementsByName('submit')[0].disabled = true;
					this.checked = false; //resets the terms checkbox
				} else {
					//
				}
				if (this.checked) { //changes the styling of the terms when checked
					document.getElementById('termsText').style.color = "black";
					document.getElementById('termsText').style.fontWeight = "normal";
					document.getElementsByName('submit')[0].disabled = false; //enables the button
				} else { //changes the styling of the terms when unchecked
					document.getElementById('termsText').style.color = "red";
					document.getElementById('termsText').style.fontWeight = "bold";
					document.getElementsByName('submit')[0].disabled = true; //disables the button
				}
		 }
	 }
