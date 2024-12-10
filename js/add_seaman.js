document.addEventListener("DOMContentLoaded", function () {
  const nextButton = document.getElementById("next-button");
  const backButton = document.querySelector(".formbold-back-btn");
  const steps = document.querySelectorAll(".formbold-form-step-1, .formbold-form-step-2, .formbold-form-step-3");
  let currentStep = 0;

  // Step navigation function
  function showStep(stepIndex) {
      steps.forEach((step, index) => {
          step.classList.toggle("active", index === stepIndex);
      });
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
          return false; // Prevent form submission and proceed to next step
      }

      // Validate DOB (check if year is 4 digits)
      if (dob.length !== 10 || !/^\d{4}-\d{2}-\d{2}$/.test(dob)) {
          document.getElementById("dob-error").style.display = "block";
          return false; // Prevent form submission and proceed to next step
      }

      // Check if email addresses match
      if (email !== email2) {
          alert("The emails do not match.");
          return false; // Prevent form submission and proceed to next step
      }

      return true; // Allow step transition if all fields are valid
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
      } else if (currentStep === 2) {
          if (validateStep3()) {
              document.getElementById("register_seaman").submit(); // Submit form
          }
      }
  });

  // Back Button Event
  backButton.addEventListener("click", function (event) {
      event.preventDefault();
      if (currentStep > 0) {
          currentStep--;
          showStep(currentStep);
      }
  });

  // Initial display
  showStep(currentStep);
});
