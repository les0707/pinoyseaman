//titi
document.addEventListener("DOMContentLoaded", function () {
    const nextButton = document.getElementById("next-button");
    const backButton = document.querySelector(".formbold-back-btn");
    const steps = document.querySelectorAll(".formbold-form-step-1, .formbold-form-step-2, .formbold-form-step-3");
    const stepMenuItems = document.querySelectorAll(".formbold-step-menu1, .formbold-step-menu2, .formbold-step-menu3"); // Selecting step menu items
    const submitButton = document.getElementById("submit-button"); // Submit button
    let currentStep = 0;
  
    // Step navigation function
    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            step.classList.toggle("active", index === stepIndex); // Show active step
        });
  
        // Update step menu highlighting
        stepMenuItems.forEach((item, index) => {
            item.classList.toggle("active", index === stepIndex); // Highlight the active step in the menu
        });
  
        // Show or hide the "Back" button
        if (currentStep > 0) {
            backButton.style.display = "inline-block"; // Show the Back button on Step 2 and 3~
        } else {
            backButton.style.display = "none"; // Hide the Back button on Step 1
        }
  
        // Hide the Next button on Step 3 and show the Submit button
        if (currentStep === 2) {
            nextButton.style.display = "none"; // Hide Next button on Step 3
            submitButton.style.display = "inline-block"; // Show Submit button on Step 3
        } else {
            nextButton.style.display = "inline-block"; // Show Next button for Step 1 and 2
            submitButton.style.display = "none"; // Hide Submit button on Step 1 and 2
        }
    }
  
    // Step 1 Validation
    function validateStep1() {
        const firstName = document.getElementById("first_name").value.trim();
        const middleName = document.getElementById("middle_name").value.trim();
        const lastName = document.getElementById("last_name").value.trim();
        const dob = document.getElementById("date").value;
        const sex = document.getElementById("sex").value;
        const email = document.getElementById("email").value.trim();
        const cellphone = document.getElementById("cellphone").value.trim();
        const city = document.getElementById("city").value.trim();
        const email2 = document.getElementById("email2").value.trim();
  
        // Clear previous error messages
        document.getElementById("dob-error").style.display = "none";
  
        // Check if all required fields are filled
        if (!firstName || !middleName || !lastName || !dob || !sex || !email || !cellphone || !city || !email2) {
            alert("Please fill out all the fields in Step 1.");
            return false;
        }
  
        // Validate DOB (check if year is 4 digits)
        if (dob.length !== 10 || !/^\d{4}-\d{2}-\d{2}$/.test(dob)) {
            document.getElementById("dob-error").style.display = "block";
            return false;
        }
  
        // Check if email addresses match
        if (email !== email2) {
            alert("The emails do not match.");
            return false;
        }
  
        return true;
    }
  
    // Step 2 Validation (Passport & Seaman's Book)
    function validateStep2() {
        const passportCountry = document.getElementById("passport_country").value.trim();
        const passportNo = document.getElementById("passport_no").value.trim();
        const passportIssued = document.getElementById("passport_issued").value.trim();
        const passportValid = document.getElementById("passport_valid").value.trim();
        const sbookCountry = document.getElementById("sbook_country").value.trim();
        const sbookNo = document.getElementById("sbook_no").value.trim();
        const sbookIssued = document.getElementById("sbook_issued").value.trim();
        const sbookValid = document.getElementById("sbook_valid").value.trim();
  
        if (!passportCountry || !passportNo || !passportIssued || !passportValid || !sbookCountry || !sbookNo || !sbookIssued || !sbookValid) {
            alert("Please fill out all passport and seaman's book fields.");
            return false;
        }
  
        return true;
    }
  
    // Step 3 Validation (Work Experiences and File Uploads)
    function validateStep3() {
        const seagoingWork = document.getElementById("seagoing_work").value.trim();
        const nonSeagoingWork = document.getElementById("non_seagoing_work").value.trim();
        const educTraining = document.getElementById("educ_training").value.trim();
        const merits = document.getElementById("merits").value.trim();
        const competence = document.getElementById("competence").files.length;
        const certificates = document.getElementById("certificates").files.length;
        const termsChecked = document.getElementById("view").checked && document.getElementById("ab").checked;
  
        if (!seagoingWork || !nonSeagoingWork || !educTraining || !merits || competence === 0 || certificates === 0) {
            alert("Please fill out all work experience and upload necessary files.");
            return false;
        }
  
        if (!termsChecked) {
            alert("You must agree to the terms and conditions.");
            return false;
        }
  
        return true;
    }
  
    // Submit form via AJAX
    function submitForm() {
        const formData = new FormData(document.getElementById("register_seaman")); // FormData for uploading files
  
        fetch('includes/add_seaman_now.inc.php', { // Change this to the PHP script that handles form submission
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Expecting JSON response
        .then(data => {
            if (data.success) {
                alert("Form submitted successfully!");
                // Optionally redirect or clear form
            } else {
                alert("Error: " + data.message);
            }
        })
        .catch(error => {
            alert("Error submitting form: " + error);
        });
    }
  
    // Next Button Event
    nextButton.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent default form submission
  
        // Validate based on the current step
        if (currentStep === 0) {
            if (validateStep1()) {
                currentStep++;
                showStep(currentStep); // Proceed to Step 2
            }
        } else if (currentStep === 1) {
            if (validateStep2()) {
                currentStep++;
                showStep(currentStep); // Proceed to Step 3
            }
        }
    });
  
    // Submit Button Event (Step 3)
    submitButton.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent default form submission
  
        // Validate Step 3 before submitting
        if (validateStep3()) {
            submitForm(); // Submit form via AJAX
        }
    });
  
    // Back Button Event
    backButton.addEventListener("click", function (event) {
        event.preventDefault();
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep); // Go back to the previous step
        }
    });
  
    // Initial display
    showStep(currentStep);

    var x, i, j, l, ll, selElmnt, a, b, c;
        /*look for any elements with the class "custom-select":*/
        x = document.getElementsByClassName("custom-select");
        l = x.length;
        for (i = 0; i < l; i++) {
          selElmnt = x[i].getElementsByTagName("select")[0];
          ll = selElmnt.length;
          /*for each element, create a new DIV that will act as the selected item:*/
          a = document.createElement("DIV");
          a.setAttribute("class", "select-selected");
          a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
          x[i].appendChild(a);
          /*for each element, create a new DIV that will contain the option list:*/
          b = document.createElement("DIV");
          b.setAttribute("class", "select-items select-hide");
          for (j = 1; j < ll; j++) {
            /*for each option in the original select element,
            create a new DIV that will act as an option item:*/
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function(e) {
                /*when an item is clicked, update the original select box,
                and the selected item:*/
                var y, i, k, s, h, sl, yl;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                sl = s.length;
                h = this.parentNode.previousSibling;
                for (i = 0; i < sl; i++) {
                  if (s.options[i].innerHTML == this.innerHTML) {
                    s.selectedIndex = i;
                    h.innerHTML = this.innerHTML;
                    y = this.parentNode.getElementsByClassName("same-as-selected");
                    yl = y.length;
                    for (k = 0; k < yl; k++) {
                      y[k].removeAttribute("class");
                    }
                    this.setAttribute("class", "same-as-selected");
                    break;
                  }
                }
                h.click();
            });
            b.appendChild(c);
          }
          x[i].appendChild(b);
          a.addEventListener("click", function(e) {
              /*when the select box is clicked, close any other select boxes,
              and open/close the current select box:*/
              e.stopPropagation();
              closeAllSelect(this);
              this.nextSibling.classList.toggle("select-hide");
              this.classList.toggle("select-arrow-active");
            });
        }
        function closeAllSelect(elmnt) {
          /*a function that will close all select boxes in the document,
          except the current select box:*/
          var x, y, i, xl, yl, arrNo = [];
          x = document.getElementsByClassName("select-items");
          y = document.getElementsByClassName("select-selected");
          xl = x.length;
          yl = y.length;
          for (i = 0; i < yl; i++) {
            if (elmnt == y[i]) {
              arrNo.push(i)
            } else {
              y[i].classList.remove("select-arrow-active");
            }
          }
          for (i = 0; i < xl; i++) {
            if (arrNo.indexOf(i)) {
              x[i].classList.add("select-hide");
            }
          }
        }
        /*if the user clicks anywhere outside the select box,
        then close all select boxes:*/
        document.addEventListener("click", closeAllSelect);
  });
  

  