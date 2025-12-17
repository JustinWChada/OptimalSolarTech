<?php
// 1. Logic to determine the active page
$activePage = '';
if (!empty($_GET)) {
    // Gets the first key of the $_GET array (e.g., 'dashboard' from ?dashboard)
    $activePage = key($_GET);
} else {
    $activePage = 'dashboard';
}

// Helper function to check if a link is active
function isActive($pageName, $activePage) {
    return $pageName === $activePage ? 'active' : '';
}

// Helper function to keep dropdowns open if a child page is active
function isDropdownOpen($childPages, $activePage) {
    return in_array($activePage, $childPages) ? 'show' : '';
}

// Helper to highlight the parent dropdown link
function isParentActive($childPages, $activePage) {
    return in_array($activePage, $childPages) ? 'active' : '';
}

// Define groups for dropdowns
$projectPages = ['add_projects', 'available_projects'];
$servicePages = ['add_services', 'available_services', 'edit_services'];
$faqPages = ['add_faqs', 'available_faqs'];
?>

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner">
        <div class="sidebar-logo">
            <img src="../images/lights.jpg" alt="Optimal Solar Tech">
            <h2>Optimal Solar Tech</h2>
        </div>

        <nav class="sidebar-menu">
            <ul>
                <li>
                    <a href="?dashboard" class="<?php echo isActive('dashboard', $activePage); ?>">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                
                <li>
                    <a class="position-relative <?php echo isParentActive($projectPages, $activePage); ?>" 
                       data-bs-toggle="collapse" 
                       href="#collapseProjects" 
                       role="button" 
                       aria-expanded="<?php echo in_array($activePage, $projectPages) ? 'true' : 'false'; ?>" 
                       aria-controls="collapseProjects">
                        <i class="bi bi-briefcase"></i> Projects
                        <i class="bi bi-chevron-down position-absolute end-0 top-50 translate-middle-y me-3"></i>
                    </a>
                    <div class="collapse <?php echo isDropdownOpen($projectPages, $activePage); ?>" id="collapseProjects">
                        <ul class="submenu">
                            <li><a href="?add_projects" class="<?php echo isActive('add_projects', $activePage); ?>">Add Project</a></li>
                            <li><a href="?available_projects" class="<?php echo isActive('available_projects', $activePage); ?>">Available Projects</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a class="position-relative <?php echo isParentActive($servicePages, $activePage); ?>" 
                       data-bs-toggle="collapse" 
                       href="#collapseServices" 
                       role="button" 
                       aria-expanded="<?php echo in_array($activePage, $servicePages) ? 'true' : 'false'; ?>" 
                       aria-controls="collapseServices">
                        <i class="bi bi-tools"></i> Services
                        <i class="bi bi-chevron-down position-absolute end-0 top-50 translate-middle-y me-3"></i>
                    </a>
                    <div class="collapse <?php echo isDropdownOpen($servicePages, $activePage); ?>" id="collapseServices">
                        <ul class="submenu">
                            <li><a href="?add_services" class="<?php echo isActive('add_services', $activePage); ?>">Add Service</a></li>
                            <li><a href="?available_services" class="<?php echo isActive('available_services', $activePage); ?>">Available Services</a></li>
                            <li><a href="?edit_services" class="<?php echo isActive('edit_services', $activePage); ?>">Edit Services</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a class="position-relative <?php echo isParentActive($faqPages, $activePage); ?>" 
                       data-bs-toggle="collapse" 
                       href="#collapseFAQs" 
                       role="button" 
                       aria-expanded="<?php echo in_array($activePage, $faqPages) ? 'true' : 'false'; ?>" 
                       aria-controls="collapseFAQs">
                        <i class="bi bi-question-circle"></i> FAQs
                        <i class="bi bi-chevron-down position-absolute end-0 top-50 translate-middle-y me-3"></i>
                    </a>
                    <div class="collapse <?php echo isDropdownOpen($faqPages, $activePage); ?>" id="collapseFAQs">
                        <ul class="submenu">
                            <li><a href="?add_faqs" class="<?php echo isActive('add_faqs', $activePage); ?>">Add FAQs</a></li>
                            <li><a href="?available_faqs" class="<?php echo isActive('available_faqs', $activePage); ?>">Available FAQs</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="?testimonials" class="<?php echo isActive('testimonials', $activePage); ?>">
                        <i class="bi bi-chat-right-quote"></i> Testimonials
                    </a>
                </li>

                <li>
                    <a href="?customers" hidden class="<?php echo isActive('customers', $activePage); ?>">
                        <i class="bi bi-person-lines-fill"></i> Customers
                    </a>
                </li>
                <li>
                    <a href="?messages" class="<?php echo isActive('messages', $activePage); ?>">
                        <i class="bi bi-envelope"></i> Inquiries
                    </a>
                </li>
                <li>
                    <a href="?settings" class="<?php echo isActive('settings', $activePage); ?>">
                        <i class="bi bi-gear"></i> Settings
                    </a>
                </li>
                
                <li>
                    <a href="?emergencies" class="p-0 mt-3">
                        <button class="btn emergency-icon w-100" id="emergencyMessages">
                            Emergencies
                        </button>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>