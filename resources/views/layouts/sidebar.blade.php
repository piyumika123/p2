<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <style>
        .sidebar {
            width: 250px;
            transition: margin-left 0.3s;
        }
        .sidebar.d-none {
            margin-left: -250px;
        }
        .content {
            transition: margin-left 0.3s;
            margin-left: 250px;
        }
        .content.shifted {
            margin-left: 0;
        }
        .nav-item {
            margin-bottom: 10px;
        }
        .nav-link {
            font-size: 1.1rem;
            font-weight: bold;
        }
        .header-image {
    font-size: 40px; /* Adjust size as needed */
    width: 50px;  /* Ensure consistent size */
    height: 50px; 
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 2px solid blue; /* Blue frame */
    border-radius: 8px; /* Optional: Rounded corners */
    padding: 10px; /* Adjust spacing inside the frame */
}


    </style>
</head>
<body>
<div class="sidebar fixed-top" id="sidebar">
<div class="sidebar-logo">
<h5> welcome supermarket</h5>
</div>
        <div class="sidebar-logo">
            <img src="{{ asset('images/s-logo.png') }}" alt="Logo" class="img-fluid">
        </div>

        <ul class="nav mt-3">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('supermarket.sale') }}">
                    <i class="bi bi-person-plus"></i>
                    <span class="menu-title">sale </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('supermarket.goods_inward') }}">
                    <i class="bi bi-box-arrow-in-down"></i>
                    <span class="menu-title">Goods Inward from where hose </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('supermarket.goods_order') }}">
                    <i class="bi bi-cart"></i>
                    <span class="menu-title">Goods Order from wherehose</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('supermarket.goods_return') }}">
                    <i class="bi bi-arrow-return-left"></i>
                    <span class="menu-title">Goods Return to wherehouse</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('supermarket.live_stock') }}">
                    <i class="bi bi-box-seam"></i>
                    <span class="menu-title">Live Stock in supermaket</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('supermarket.wastage_stock') }}">
                    <i class="bi bi-trash"></i>
                    <span class="menu-title">Wastage Stock</span>
                </a>
            </li>
        </ul>
        </div>
    <div class="content" id="content">
        <!-- Dashboard content goes here -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const navLinks = document.querySelectorAll('.nav-link[data-bs-toggle="collapse"]');
            const toggleSidebarBtn = document.getElementById('toggleSidebarBtn');
            const sidebar = document.getElementById('sidebar');

            navLinks.forEach(link => {
                link.addEventListener("click", function () {
                    const targetId = this.getAttribute("href").substring(1);
                    const targetElement = document.getElementById(targetId);

                    if (targetElement.classList.contains("show")) {
                        bootstrap.Collapse.getInstance(targetElement).hide();
                    } else {
                        navLinks.forEach(otherLink => {
                            const otherTargetId = otherLink.getAttribute("href").substring(1);
                            if (otherTargetId !== targetId) {
                                const otherTargetElement = document.getElementById(otherTargetId);
                                if (otherTargetElement.classList.contains("show")) {
                                    bootstrap.Collapse.getInstance(otherTargetElement).hide();
                                }
                            }
                        });

                        bootstrap.Collapse.getOrCreateInstance(targetElement).show();
                    }
                });
            });

            toggleSidebarBtn.addEventListener('click', () => {
                sidebar.classList.toggle('d-none');
            });
        });
    </script>
</body>
</html>
