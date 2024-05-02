<nav class="navbar navbar-expand-sm navbar-light bg-warning">
    <div class="container-fluid navbar-holder">
        <div class="d-flex justify-content-between align-items-center logo-holder">
            <div class="text-center logo-wrapper">
                <a class="navbar-brand mx-auto" href="{{ route('projects.index') }}">
                    <div class="d-flex flex-column align-items-center">
                        <img src="{{ asset('images/logo_footer_black.png') }}" alt="picture of the logo" class="logo-img mx-auto">
                        <p class="fw-bold small m-0">Brainster</p>
                    </div>
                </a>
            </div>
            <button class="navbar-toggler order-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item d-flex align-items-center">
                    <a class="nav-link" href="https://brainster.co/full-stack/" target="_blank">Академија за програмирање</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a class="nav-link" href="https://brainster.co/marketing/" target="_blank">Академија за маркетинг</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a class="nav-link" href="https://brainster.co/graphic-design/" target="_blank">Академија за дизајн</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a class="nav-link" href="https://blog.brainster.co/ux-code-design-international-project/" target="_blank">Блог</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#formModal" id="modalButton">Вработи наши студенти</a>
                </li>
                @if(!session('admin_id'))
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ route('auth.index') }}" class="btn btn-sm btn-primary">Login</a>
                </li>
                @else
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ route('auth.logout') }}" class="btn btn-sm btn-danger">Logout</a>
                </li>
                @endif
            </ul>

        </div>
    </div>
</nav>

<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Вработи наши студенти</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-secondary">Внесете ваши информации за да стапиме во контакт</p>
                <form action="{{route('submit.contact')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Е-маил</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Телефон</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="company" class="form-label">Компанија</label>
                        <input type="text" class="form-control" id="company" name="company">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-warning w-100">Испрати</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>