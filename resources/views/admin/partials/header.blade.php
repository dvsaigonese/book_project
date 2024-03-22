<header id="admin-header" style="position: fixed; top: 0; width: 100%; z-index: 100">
    <div>
        <nav class="navbar navbar-dark bg-primary shadow-sm">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" onclick="toggleNav()">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">{{ auth()->user()->name }}</a>
            </div>
        </nav>
    </div>
</header>
