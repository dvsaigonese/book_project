<style>
    .sidenav {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #0d6efd !important;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
    }

    .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 15px;
        color: white;
        display: block;
        transition: 0.3s;
        cursor: pointer;
    }

    .sidenav a:hover {
        color: #f1f1f1;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    .dropdown-container {
        display: none;
        background-color: #262626;
        padding-left: 8px;
    }

    @media screen and (max-height: 450px) {
        .sidenav {
            padding-top: 15px;
        }

        .sidenav a {
            font-size: 18px;
        }
    }
</style>

<div id="mySidenav" class="sidenav">
    <a href="{{route('admin.dashboard')}}"><i class="ti-bar-chart"></i> Dashboard</a>
    <a href="{{route('admin.order.index')}}"><i class="ti-shopping-cart"></i> Orders</a>
    <a href="{{route('admin.book.index')}}"><i class="ti-book"></i> Books</a>
    <a href="{{route('admin.news.index')}}"><i class="ti-file"></i> News</a>
    <a href="{{route('admin.author.index')}}"><i class="ti-marker-alt"></i> Authors</a>
    <a href="{{route('admin.genre.index')}}"><i class="ti-tag"></i> Genres</a>
    <a href="{{route('admin.user.index')}}"><i class="ti-user"></i> Users</a>
    <a href="{{route('admin.role.index')}}"><i class="ti-notepad"></i> Roles</a>
    <a href="{{route('admin.slider.index')}}"><i class="ti-hand-drag"></i> Sliders</a>
    <a href="{{route('admin.satistics.index')}}"><i class="ti-stats-up"></i> Satistics</a>
    <a href="#">Contact</a>
    <a class="dropdown-btn">Drop
        <i class="ti-angle-down" style="font-size: 0.6rem;"></i>
    </a>
    <div class="dropdown-container">
        <a href="#">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
    </div>
</div>

<script>
    let menuOpen = false;

    function toggleNav() {
        if (menuOpen) {
            closeNav();
        } else {
            openNav();
        }
        menuOpen = !menuOpen;
    }

    function openNav() {
        if (document.documentElement.clientWidth < 992) {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("admin-header").style.marginLeft = "0px";
        } else {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("page").style.marginLeft = "250px";
        }

    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("page").style.marginLeft = "0";
    }

    //Dropdown menu
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }

</script>
