let form = document.getElementById("userCreationForm");
let feedbackDiv = document.getElementById("feedbackMessage");
let passwordInput = document.getElementById("password_hash");
let toggleButton = document.getElementById("togglePassword");

$("#togglePassword").click(function () {
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }
});

$("#userCreationForm").on("submit", function (e) {
  e.preventDefault();

  // Clear previous feedback
  feedbackDiv.classList.add("d-none");
  feedbackDiv.textContent = "";
  feedbackDiv.className = "alert"; // Reset all classes

  const adminPass = document.getElementById("admin_password").value;
  const username = document.getElementById("username").value;

  // Collect Form Data
  const formData = {
    action: "add_user",
    admin_password: adminPass,
    username: username,
    email: document.getElementById("email").value,
    password_hash: passwordInput.value,
    first_name: document.getElementById("first_name").value,
    last_name: document.getElementById("last_name").value,
    user_phone: document.getElementById("user_phone").value,
    is_active: document.getElementById("is_active").checked,
  };

  // Submit the form
  $.ajax({
    url: "settings/query_add_user.php",
    type: "POST",
    data: formData,
    success: function (response) {
      const data = JSON.parse(response);
      alert(data.message);
    },
    error: function (xhr, status, error) {
      alert("Error: " + error);
      console.log(xhr.responseText);
    },
  });

  // Clear the form on successful submission
  form.reset();
});

document.getElementById("admin_password").addEventListener("blur", function () {
  const adminPass = document.getElementById("admin_password").value;
  const feedbackDiv = document.getElementById("feedbackMessage");

  $.ajax({
    url: "settings/query_add_user.php",
    type: "POST",
    data: { verify_admin_password: adminPass, action: "verify_admin_password" },
    success: function (response) {
      const data = JSON.parse(response);
      
      if (data.status == 200) {
        feedbackDiv.classList.remove("alert-danger");
        feedbackDiv.classList.add("alert-success");
        feedbackDiv.textContent = "Admin password verified successfully.";
        $("#userDetails").attr("disabled", false);
       
      } else {
        feedbackDiv.classList.remove("alert-success");
        feedbackDiv.classList.add("alert-danger");
        feedbackDiv.textContent = "Error: Invalid admin password.";
        $("#userDetails").attr("disabled", true);
      }
    },
    error: function (xhr, status, error) {
      feedbackDiv.classList.remove("alert-success");
      feedbackDiv.classList.add("alert-danger");
      feedbackDiv.textContent = "Error: Unable to verify admin password.";

      console.error(xhr.responseText);
    },
  });

  // Scroll to the feedback message
  feedbackDiv.scrollIntoView({ behavior: "smooth", block: "start" });
});
