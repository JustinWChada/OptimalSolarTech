function deleteEmergency(id){
    if (!confirm("Are you sure you want to delete this Emergency?")) return;

    $.ajax({
        url: "emergencies/query_emergencies.php",
        type: "POST",
        data: { action: "delete", emergencyId: id },
        success: function (response) {
            console.log("Delete response:", response); //remove
            
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error("Error deleting Emergency:", status, error);
            alert("Failed to delete the Emergency. Please try again.");
        },
    })
}