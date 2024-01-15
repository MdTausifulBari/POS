<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>

    <script>
        if(localStorage.getItem('token')===null){
            window.location.href="/userLogin";
        }
    </script>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title></title>

    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('/favicon.ico')); ?>" />
    <link href="<?php echo e(asset('css/bootstrap.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('css/animate.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('css/fontawesome.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('css/toastify.min.css')); ?>" rel="stylesheet" />


    <link href="<?php echo e(asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css')); ?>" rel="stylesheet" />

    <link href="<?php echo e(asset('css/jquery.dataTables.min.css')); ?>" rel="stylesheet" />
    <script src="<?php echo e(asset('js/jquery-3.7.0.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>


    <script src="<?php echo e(asset('js/toastify-js.js')); ?>"></script>
    <script src="<?php echo e(asset('js/axios.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/config.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.bundle.js')); ?>"></script>




</head>

<body>


<div id="loader" class="LoadingOverlay d-none">
    <div class="Line-Progress">
        <div class="indeterminate"></div>
    </div>
</div>


<nav class="navbar fixed-top px-0 shadow-sm bg-white">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">
            <span class="icon-nav m-0 h5" onclick="MenuBarClickHandler()">
                <img class="nav-logo-sm mx-2"  src="<?php echo e(asset('images/menu.svg')); ?>" alt="logo"/>
            </span>
            <img class="nav-logo  mx-2"  src="<?php echo e(asset('images/logo.png')); ?>" alt="logo"/>
        </a>

        <div class="float-right h-auto d-flex">
            <div class="user-dropdown">
                <img class="icon-nav-img" src="<?php echo e(asset('images/user.webp')); ?>" alt=""/>
                <div class="user-dropdown-content ">
                    <div class="mt-4 text-center">
                        <img class="icon-nav-img" src="<?php echo e(asset('images/user.webp')); ?>" alt=""/>
                        <h6>User Name</h6>
                        <hr class="user-dropdown-divider  p-0"/>
                    </div>
                    <a href="<?php echo e(url('/userProfile')); ?>" class="side-bar-item">
                        <span class="side-bar-item-caption">Profile</span>
                    </a>
                    

                    <a onclick="logout()" class="side-bar-item">
                        <span class="side-bar-item-caption">Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>


<div id="sideNavRef" class="side-nav-open">

    <a href="<?php echo e(url("/dashboard")); ?>" class="side-bar-item">
        <i class="bi bi-graph-up"></i>
        <span class="side-bar-item-caption">Dashboard</span>
    </a>

    <a href="<?php echo e(url("/customerPage")); ?>" class="side-bar-item">
        <i class="bi bi-people"></i>
        <span class="side-bar-item-caption">Customer</span>
    </a>

    <a href="<?php echo e(url("/categoryPage")); ?>" class="side-bar-item">
        <i class="bi bi-list-nested"></i>
        <span class="side-bar-item-caption">Category</span>
    </a>

    <a href="<?php echo e(url("/productPage")); ?>" class="side-bar-item">
        <i class="bi bi-bag"></i>
        <span class="side-bar-item-caption">Product</span>
    </a>

    <a href="<?php echo e(url('/salePage')); ?>" class="side-bar-item">
        <i class="bi bi-currency-dollar"></i>
        <span class="side-bar-item-caption">Create Sale</span>
    </a>

    <a href="<?php echo e(url('/invoicePage')); ?>" class="side-bar-item">
        <i class="bi bi-receipt"></i>
        <span class="side-bar-item-caption">Invoice</span>
    </a>

    <a href="<?php echo e(url('/reportPage')); ?>" class="side-bar-item">
        <i class="bi bi-file-earmark-bar-graph"></i>
        <span class="side-bar-item-caption">Report</span>
    </a>


</div>




<div id="contentRef" class="content">
    <?php echo $__env->yieldContent('content'); ?>
</div>



<script>
    function MenuBarClickHandler() {
        let sideNav = document.getElementById('sideNavRef');
        let content = document.getElementById('contentRef');
        if (sideNav.classList.contains("side-nav-open")) {
            sideNav.classList.add("side-nav-close");
            sideNav.classList.remove("side-nav-open");
            content.classList.add("content-expand");
            content.classList.remove("content");
        } else {
            sideNav.classList.remove("side-nav-close");
            sideNav.classList.add("side-nav-open");
            content.classList.remove("content-expand");
            content.classList.add("content");
        }
    }

    async function logout(){

        try{

            showLoader()
            let res = await axios.get('/user-logout', headerToken())
            hideLoader()

            localStorage.clear()
            sessionStorage.clear()

            window.location.href = "/userLogin"

        }catch(e){
            unauthorized(e.response.status)
        }
    }

</script>

</body>
</html>
<?php /**PATH D:\Laravel\Laravel Laptop\0 modules\0 Mega Project (m14 - m18)\POS\resources\views/layout/sidenav-layout.blade.php ENDPATH**/ ?>