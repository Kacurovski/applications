<header class="bg-secondary fixed-top">
    <div class="container-fluid d-flex justify-content-between align-items-center w-75">
        <div>
            <a href="/book_app"><img src="/book_app/assets/images/brainster-logo.png" alt="brainster logo" class="logo_img"></a>
        </div>
        <?php
        if ($admin) { ?>
            <div class="w-50">
                <a href="/book_app/admin_dashboard" class="btn btn-primary fw-bold w-100 py-3"><span class="h5 fw-bold">Admin Dashboard</span></a>
            </div>
        <?php } ?>
        <div class="d-flex align-items-center">
            <div>
                <p class="mb-0 me-3 text-light h5 fst-italic"><?= $welcomeText ?></p>
            </div>
            <?php if ($isLoggedIn) { ?>
                <form method="POST" action="/book_app/logout">
                    <button type="submit" class="btn btn-danger fw-bold">
                        <span class="h5 fw-bold">Logout</span>
                    </button>
                </form>
            <?php } else { ?>
                <a href="/book_app/login" class="btn btn-warning"><span class="h5 fw-bold">Login</span></a>
            <?php } ?>
        </div>
    </div>
</header>
