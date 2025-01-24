<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor.bundle.base.css') }}">
</head>
<body>
    
    
    <div class="sidebar" id="sidebar">
        <button class="btn btn-primary" id="toggleSidebarBtn">slidebar close</button>

        <ul class="nav">
            
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#goodsBilling" aria-expanded="false" aria-controls="goodsBilling">
                    <i class="icon typcn typcn-document-text"></i>
                    <span class="menu-title">Goods Billing</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="goodsBilling">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="#">Option 1</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Option 2</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#goodsInward" aria-expanded="false" aria-controls="goodsInward">
                    <i class="icon typcn typcn-film"></i>
                    <span class="menu-title">Goods Inward</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="goodsInward">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="#">Option 1</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Option 2</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="icon typcn typcn-mortar-board"></i>
                    <span class="menu-title">Goods Order</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#goodsReturn" aria-expanded="false" aria-controls="goodsReturn">
                    <i class="icon typcn typcn-chart-pie"></i>
                    <span class="menu-title">Goods Return</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="goodsReturn">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="#">Option 1</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Option 2</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="icon typcn typcn-folder"></i>
                    <span class="menu-title">Live Stock</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="icon typcn typcn-folder"></i>
                    <span class="menu-title">Wastage Stock</span>
                </a>
            </li>
        </ul>
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
