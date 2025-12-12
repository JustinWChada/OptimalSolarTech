
const deleteButtons = document.querySelectorAll(".delete-button");
deleteButtons.forEach((button) => {
  button.addEventListener("click", function () {
    const messageId = this.dataset.id;

    let res = confirm("Are you sure you want to delete this message?"); 
    
    if (!res) return;

    $.ajax({
        url: "messages/query_messages.php",
        type: "POST",
        data: {  action: "delete", messageId: messageId  },
        success: function(response) {
            // Refresh the FAQs section
            location.reload();
        },
        error: function(xhr, status, error) {
            console.log("Error: " + error);
        }
    });

    
  });
});

document.querySelectorAll(".message-card").forEach((card) => {
  card.addEventListener("click", () => {
    const id = card.getAttribute("data-id");
    const modal = document.getElementById(`messageModal`);
    modal.style.display = "block";

    //modal.querySelector(".modal-content") //.innerHTML = `<button class="close-button">&times;</button>`;
    const modalContent = document.getElementById(`messageModalContentDetails`);
    modalContent.innerHTML = "";
    
    const nameElement = document.createElement("p");
    nameElement.className = "modal-name";
    let text = "<strong>Name: </strong> ";
    nameElement.innerHTML =text + card.querySelector(".message-name").textContent;
    modalContent.appendChild(nameElement);

    const phoneElement = document.createElement("p");
    phoneElement.className = "modal-phone";
    text = "<strong>Phone: </strong> ";
    phoneElement.innerHTML = text + card.querySelector(".message-phone").textContent;
    modalContent.appendChild(phoneElement);

    const emailElement = document.createElement("p");
    emailElement.className = "modal-email";
    text = "<strong>Email: </strong> ";
    emailElement.innerHTML = text+ card.querySelector(".message-email").textContent;
    modalContent.appendChild(emailElement);

    const messageElement = document.createElement("p");
    messageElement.className = "modal-message";
    text = "<strong>Subject: </strong> ";
    messageElement.innerHTML = text + card.querySelector(".message-message").textContent;
    modalContent.appendChild(messageElement);
  });

  card.querySelector(".delete-button").addEventListener("click", (e) => {
    e.stopPropagation();
  });
});

document.querySelectorAll(".close-button").forEach((button) => {
  button.addEventListener("click", () => {
    const modal = button.closest(".message-modal");
    modal.style.display = "none";
  });
});
