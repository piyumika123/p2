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
    </style>
</head>
<body>
    <div class="sidebar fixed-top" id="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('images/s-logo.png') }}" alt="Logo" class="img-fluid">
        </div>
        <ul class="nav mt-3">
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('employee.create') }}">
                    <i class="bi bi-person-plus"></i>
                    <span class="menu-title">Employee Create</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#goodsInward" aria-expanded="false" aria-controls="goodsInward">
                    <i class="bi bi-box-arrow-in-down"></i>
                    <span class="menu-title">Registration</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="goodsInward">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{ route('supplier.registration') }}">Supplier Registration</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('item.registration') }}">Item Registration</a></li>
                    </ul>
                </div>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#goodsReturn" aria-expanded="false" aria-controls="goodsReturn">
                    <i class="bi bi-arrow-return-left"></i>
                    <span class="menu-title">Supermarkert</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="goodsReturn">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="#">Option 1</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Option 2</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Option 1</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Option 2</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Option 1</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Option 2</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#goodsReturn" aria-expanded="false" aria-controls="goodsReturn">
                    <i class="bi bi-arrow-return-left"></i>
                    <span class="menu-title">Warehouse</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="goodsReturn">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="#">Option 1</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Option 2</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Option 1</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Option 2</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Option 1</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Option 2</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-trash"></i>
                    <span class="menu-title">Setting</span>
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
            const content = document.getElementById('content');

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
                content.classList.toggle('shifted');
            });
        });
    </script>
</body>
</html>
