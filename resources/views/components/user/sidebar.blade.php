<div class="flex-shrink-0 p-3 bg-white" style="width: 280px;">
    <form>
        <div class="container-fluid">
            <span class="fs-5 fw-semibold">Rechercher</span>
            <div class="row">
                <div class="col p-0 m-0">
                    <input type="search" name="search" class="form-control">
                </div>
                <div class="col-auto p-0 m-0">
                    <button type="submit" class="btn btn-outline-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </form>

    <hr class="my-4">

    <span class="fs-5 fw-semibold">Critères de classement</span>
    <ul class="list-unstyled ps-0">
        <li class="mb-1">
            <input type="checkbox" name="c">
        </li>
    </ul>

    


    <ul class="list-unstyled ps-0">
        <li class="mb-1">
            <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Overview</a></li>
                    <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Updates</a></li>
                    <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Reports</a></li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                Dashboard
            </button>
            <div class="collapse" id="dashboard-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Overview</a></li>
                    <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Weekly</a></li>
                    <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Monthly</a></li>
                    <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Annually</a></li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                Orders
            </button>
            <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New</a></li>
                    <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Processed</a>
                    </li>
                    <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a></li>
                    <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Returned</a></li>
                </ul>
            </div>
        </li>
        <li class="border-top my-3"></li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                Account
            </button>
            <div class="collapse" id="account-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New...</a></li>
                    <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Profile</a></li>
                    <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Settings</a></li>
                    <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Sign out</a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>
