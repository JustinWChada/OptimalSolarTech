<nav class="navbar navbar-expand navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" id="sidebarToggle" href="#sidebar" aria-label="Optimal Solar Tech Sidebar" data-bs-toggle="tooltip" title="Dashboard Side Bar" id="sidebarToggle">
            <i class="bi bi-list fs-4" aria-hidden="true"></i>
            <span class="visually-hidden">Sidebar</span>
        </a>

        <ul class="navbar-nav ms-auto d-flex flex-row align-items-center gap-3">
            <li class="nav-item">
                <a class="nav-link text-white" href="/dashboard/home" aria-label="Home" data-bs-toggle="tooltip" title="Home">
                    <i class="bi bi-house fs-5" aria-hidden="true"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="?messages" aria-label="Messages" data-bs-toggle="tooltip" title="Messages">
                    <i class="bi bi-chat-dots fs-5" aria-hidden="true"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="?quotes" aria-label="Quotes" data-bs-toggle="tooltip" title="Quotes">
                    <i class="bi bi-receipt fs-5" aria-hidden="true"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="?free_estimates" aria-label="Free Estimates" data-bs-toggle="tooltip" title="Free Estimates">
                    <i class="bi bi-calculator fs-5" aria-hidden="true"></i>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button"
                     data-bs-toggle="dropdown" aria-expanded="false" aria-label="User menu" data-bs-toggle="tooltip" title="Account">
                    <i class="bi bi-person-circle fs-5" aria-hidden="true"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2" href="/dashboard/account" aria-label="Account" data-bs-toggle="tooltip" title="Account">
                            <i class="bi bi-person"></i>
                            <span class="visually-hidden-not">Account</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2" href="/dashboard/add-user" aria-label="Add user" data-bs-toggle="tooltip" title="Add User">
                            <i class="bi bi-person-plus"></i>
                            <span class="visually-hidden-not">Add User</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2 text-danger" href="/logout" aria-label="Sign out" data-bs-toggle="tooltip" title="Sign Out">
                            <i class="bi bi-box-arrow-right"></i>
                            <span class="visually-hidden-not">Sign Out</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="/dashboard/settings" aria-label="Settings" data-bs-toggle="tooltip" title="Settings">
                    <i class="bi bi-gear fs-5" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>