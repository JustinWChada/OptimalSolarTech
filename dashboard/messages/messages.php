<link rel="stylesheet" href="css/messages.css">

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="?messages"><i class="bi bi-box-seam-fill"></i> Messages</a>
    </div>
</nav>

<div class="container my-5">
    <header class="text-center mb-4">
        <h1 class="display-4 fw-bold">New Messages</h1>
        <p class="lead text-secondary">View and manage all your message entries.</p>
        <hr class="w-25 mx-auto">
    </header>

    <div id="message-list-container" class="row">
        <?php
        require_once '../config/miscellanea_db.php';
        
        // Fetch all data from the table
        $sql = "SELECT * FROM contact_form_inputs";
        $stmt = $OstMiscellaneaConn->prepare($sql);
        $stmt->execute();
        $messages = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        
        // Display messages
        foreach ($messages as $message) {
        
        ?>
        <div class="message-card" data-id="<?php echo htmlspecialchars($message['id']); ?>">
            <p class="message-name"><strong></strong> <?php echo htmlspecialchars($message['name']); ?></p>
            <p class="message-phone"><strong></strong> <?php echo htmlspecialchars($message['phone']); ?></p>
            <p class="message-email" hidden><strong></strong> <?php echo htmlspecialchars($message['email']); ?></p>
            <p class="message-service" hidden><strong></strong> <?php echo htmlspecialchars($message['service']); ?></p>
            <p class="message-message" hidden><strong></strong> <?php echo htmlspecialchars($message['message']); ?></p>
        
            <button class="delete-button" data-id="<?php echo htmlspecialchars($message['id']); ?>"><i class="bi bi-trash"></i></button>
        </div>
        <?php
        }
        ?>
    </div>
</div>

<div id="messageModal" class="message-modal">
    <div id="messageModalContent" class="message-modal-content">
        <span class="close-button">&times;</span>
        <h2 class="modal-title my-2 text-success fw-bold" >Message Details:</h2>
        
    </div>
</div>

<script src="js/messages.js"></script>