$(document).ready(function () {
  $("#emergencyForm").on("submit", function (e) {
    e.preventDefault();

    f_name = document.getElementById("emergencyForm").name.value;
    phone = document.getElementById("emergencyForm").phone.value;
    description = document.getElementById("emergencyForm").description.value;
    
    var data = {
      action: "submit_emergency",
      name: f_name,
      phone: phone,
      description: description,
    };

    console.log(data)

    $.ajax({
      url: "../queries/submit_emergencies.php",
      type: "POST",
      data: data,
      success: function (response) {
        alert(response.message)
        $("#emergencyModal").modal("hide");
        $("#emergencyAlert").html(response).fadeIn().delay(3000).fadeOut();
      },
    });
  });
});


function emergencyAlert() {
    alert("Emergency Alert: Please contact the authorities immediately!");
}