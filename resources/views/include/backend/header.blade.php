 <div class="header d-print-none">
        <div class="header-container">
            <div class="header-left">
                <div class="navigation-toggler">
                    <a href="#" data-action="navigation-toggler">
                        <i data-feather="menu"></i>
                    </a>
                </div>

                <div class="header-logo">
                    <a href=index.html>
                        <img class="logo" src="{{ asset('backend/assets/media/image/logo.png') }}" alt="logo">
                    </a>
                </div>
            </div>

            <div class="header-body">
                <div class="header-body-left">
                    <ul class="navbar-nav">
                        <li class="nav-item mr-3">
                            <div class="header-search-form">
                                <form>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn">
                                                <i data-feather="search"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn header-search-close-btn">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown d-none d-md-block">
                            <a href="#" class="nav-link" title="Apps" data-toggle="dropdown">Apps</a>
                            <div class="dropdown-menu dropdown-menu-big">
                                <div class="border-bottom px-4 py-3 text-center d-flex justify-content-between">
                                    <h5 class="mb-0">Apps</h5>
                                </div>
                                <div class="p-3">
                                    <div class="row row-xs">
                                        <div class="col-6">
                                            <a href="chat.html">
                                                <div class="border-radius-1 text-center mb-3">
                                                    <figure class="avatar avatar-lg border-0">
                                                <span class="avatar-title bg-primary text-white rounded-circle">
                                                    <i class="width-30 height-30" data-feather="message-circle"></i>
                                                </span>
                                                    </figure>
                                                    <div class="mt-2">Chat</div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="mail.html">
                                                <div class="border-radius-1 text-center mb-3">
                                                    <figure class="avatar avatar-lg border-0">
                                                <span class="avatar-title bg-secondary text-white rounded-circle">
                                                    <i class="width-30 height-30" data-feather="mail"></i>
                                                </span>
                                                    </figure>
                                                    <div class="mt-2">Mail</div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="todo-list.html">
                                                <div class="border-radius-1 text-center">
                                                    <figure class="avatar avatar-lg border-0">
                                                <span class="avatar-title bg-info text-white rounded-circle">
                                                    <i class="width-30 height-30" data-feather="check-circle"></i>
                                                </span>
                                                    </figure>
                                                    <div class="mt-2">Todo List</div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="file-manager.html">
                                                <div class="border-radius-1 text-center">
                                                    <figure class="avatar avatar-lg border-0">
                                                <span class="avatar-title bg-warning text-white rounded-circle">
                                                    <i class="width-30 height-30" data-feather="file"></i>
                                                </span>
                                                    </figure>
                                                    <div class="mt-2">File Manager</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown d-none d-md-block">
                            <a href="#" class="nav-link" title="Actions" data-toggle="dropdown">Create</a>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item">Add Products</a>
                                <a href="#" class="dropdown-item">Add Category</a>
                                <a href="#" class="dropdown-item">Add Report</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">Reports</a>
                                <a href="#" class="dropdown-item">Customers</a>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="header-body-right">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link mobile-header-search-btn" title="Search">
                                <i data-feather="search"></i>
                            </a>
                        </li>

                        <li class="nav-item dropdown d-none d-md-block">
                            <a href="#" class="nav-link" title="Fullscreen" data-toggle="fullscreen">
                                <i class="maximize" data-feather="maximize"></i>
                                <i class="minimize" data-feather="minimize"></i>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link nav-link-notify" title="Chats" data-sidebar-target="#chat-list">
                                <i data-feather="message-circle"></i>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link nav-link-notify" title="Notifications" data-toggle="dropdown">
                                <i data-feather="bell"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                <div
                                    class="border-bottom px-4 py-3 text-center d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Notifications</h5>
                                    <small class="opacity-7">2   unread notifications</small>
                                </div>
                                <div class="dropdown-scroll">
                                    <ul class="list-group list-group-flush">
                                        <li class="px-4 py-2 text-center small text-muted bg-light">Today</li>
                                        <li class="px-4 py-3 list-group-item">
                                            <a href="#" class="d-flex align-items-center hide-show-toggler">
                                                <div class="flex-shrink-0">
                                                    <figure class="avatar mr-3">
                                                        <span
                                                            class="avatar-title bg-info-bright text-info rounded-circle">
                                                            <i class="ti-lock"></i>
                                                        </span>
                                                    </figure>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                        2 steps verification
                                                        <i title="Mark as read" data-toggle="tooltip"
                                                           class="hide-show-toggler-item fa fa-circle-o font-size-11"></i>
                                                    </p>
                                                    <span class="text-muted small">20 min ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="px-4 py-3 list-group-item">
                                            <a href="#" class="d-flex align-items-center hide-show-toggler">
                                                <div class="flex-shrink-0">
                                                    <figure class="avatar mr-3">
                                                        <span
                                                            class="avatar-title bg-warning-bright text-warning rounded-circle">
                                                            <i class="ti-server"></i>
                                                        </span>
                                                    </figure>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                        Storage is running low!
                                                        <i title="Mark as read" data-toggle="tooltip"
                                                           class="hide-show-toggler-item fa fa-circle-o font-size-11"></i>
                                                    </p>
                                                    <span class="text-muted small">45 sec ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="px-4 py-2 text-center small text-muted bg-light">Old Notifications</li>
                                        <li class="px-4 py-3 list-group-item">
                                            <a href="#" class="d-flex align-items-center hide-show-toggler">
                                                <div class="flex-shrink-0">
                                                    <figure class="avatar mr-3">
                                                        <span class="avatar-title bg-secondary-bright text-secondary rounded-circle">
                                                            <i class="ti-file"></i>
                                                        </span>
                                                    </figure>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                        1 person sent a file
                                                        <i title="Mark as unread" data-toggle="tooltip"
                                                           class="hide-show-toggler-item fa fa-check font-size-11"></i>
                                                    </p>
                                                    <span class="text-muted small">Yesterday</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="px-4 py-3 list-group-item">
                                            <a href="#" class="d-flex align-items-center hide-show-toggler">
                                                <div class="flex-shrink-0">
                                                    <figure class="avatar mr-3">
                                                        <span class="avatar-title bg-success-bright text-success rounded-circle">
                                                            <i class="ti-download"></i>
                                                        </span>
                                                    </figure>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                        Reports ready to download
                                                        <i title="Mark as unread" data-toggle="tooltip"
                                                           class="hide-show-toggler-item fa fa-check font-size-11"></i>
                                                    </p>
                                                    <span class="text-muted small">Yesterday</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="px-4 py-3 list-group-item">
                                            <a href="#" class="d-flex align-items-center hide-show-toggler">
                                                <div class="flex-shrink-0">
                                                    <figure class="avatar mr-3">
                                                        <span class="avatar-title bg-primary-bright text-primary rounded-circle">
                                                            <i class="ti-arrow-top-right"></i>
                                                        </span>
                                                    </figure>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                        The invitation has been sent.
                                                        <i title="Mark as unread" data-toggle="tooltip"
                                                           class="hide-show-toggler-item fa fa-check font-size-11"></i>
                                                    </p>
                                                    <span class="text-muted small">Last Week</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="px-4 py-3 text-right border-top">
                                    <ul class="list-inline small">
                                        <li class="list-inline-item mb-0">
                                            <a href="#">Mark All Read</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a href="#" title="Cart" class="nav-link" data-toggle="dropdown">
                                <i data-feather="shopping-bag"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                <div
                                    class="border-bottom px-4 py-3 text-center d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Cart</h5>
                                    <small class="opacity-7">4 products</small>
                                </div>
                                <div class="dropdown-scroll">
                                    <div class="list-group list-group-flush">
                                        <a href="#" class="px-4 py-3 list-group-item d-flex">
                                            <div class="flex-shrink-0">
                                                <figure class="avatar mr-3">
                                                    <img class="rounded" src="{{ asset('backend/assets/media/image/products/product6.png') }}"
                                                         alt="Canon 4000D 18-55 MM">
                                                </figure>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                    Canon 4000D 18-55 MM
                                                    <i title="Close" data-toggle="tooltip"
                                                       class="hide-show-toggler-item small ti-close"></i>
                                                </p>
                                                <span class="text-muted small">X $1,200</span>
                                            </div>
                                        </a>
                                        <a href="#" class="px-4 py-3 list-group-item d-flex">
                                            <div class="flex-shrink-0">
                                                <figure class="avatar mr-3">
                                                    <img class="rounded" src="{{ asset('backend/assets/media/image/products/product3.png') }}"
                                                         alt="pineapple">
                                                </figure>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                    Snopy SN-BT96 Pretty
                                                    <i title="Close" data-toggle="tooltip"
                                                       class="hide-show-toggler-item small ti-close"></i>
                                                </p>
                                                <span class="text-muted small">X $250</span>
                                            </div>
                                        </a>
                                        <a href="#" class="px-4 py-3 list-group-item d-flex">
                                            <div class="flex-shrink-0">
                                                <figure class="avatar mr-3">
                                                    <img src="{{ asset('backend/assets/media/image/products/product7.png') }}"
                                                         class="rounded" alt="pineapple">
                                                </figure>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                    Lenovo Tab E10 TB-X104F 32GB
                                                    <i title="Close" data-toggle="tooltip"
                                                       class="hide-show-toggler-item small ti-close"></i>
                                                </p>
                                                <span class="text-muted small">X $100</span>
                                            </div>
                                        </a>
                                        <a href="#" class="px-4 py-3 list-group-item d-flex">
                                            <div class="flex-shrink-0">
                                                <figure class="avatar mr-3">
                                                    <img class="rounded" src="{{ asset('backend/assets/media/image/products/product6.png') }}"
                                                         alt="Canon 4000D 18-55 MM">
                                                </figure>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                    Canon 4000D 18-55 MM
                                                    <i title="Close" data-toggle="tooltip"
                                                       class="hide-show-toggler-item small ti-close"></i>
                                                </p>
                                                <span class="text-muted small">X $1,200</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="px-4 py-3 border-top text-right small">
                                    <p class="d-flex justify-content-between align-items-center mb-1">
                                        <span>Sub Total</span>
                                        <span>$1,650</span>
                                    </p>
                                    <p class="d-flex justify-content-between align-items-center mb-1">
                                        <span>Taxes</span>
                                        <span>$15</span>
                                    </p>
                                    <p class="d-flex justify-content-between align-items-center mb-1 font-weight-bold">
                                        <span>Total</span>
                                        <span>$1,665</span>
                                    </p>
                                    <button class="btn btn-primary btn-block mt-2">
                                        Order and Payment <i class="ti-arrow-right ml-2"></i>
                                    </button>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link" title="Settings" data-sidebar-target="#settings">
                                <i data-feather="settings"></i>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" title="User menu" data-toggle="dropdown">
                                <figure class="avatar avatar-sm">
                                    <img src="{{ asset('upload/users') }}/{{ Auth::user()->img }}"
                                         class="rounded-circle border"
                                         alt="avatar">
                                </figure>
                                <span class="ml-2 d-sm-inline d-none">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                <div class="text-center py-4">
                                    <figure class="avatar avatar-lg mb-3 border-0">
                                        <img src="{{ asset('upload/users') }}/{{ Auth::user()->img }}"
                                             class="rounded-circle" alt="image">
                                    </figure>
                                    <h5 class="text-center">{{ Auth::user()->name }}</h5>
                                    <div class="mb-3 small text-center text-muted">@bonygidden</div>
                                    <a href="#" class="btn btn-outline-light btn-rounded">Manage Your Account</a>
                                </div>
                                <div class="list-group">
                                    <a href="{{ route('profile') }}" class="list-group-item">View Profile</a>
                                    <a href="{{ route('logout') }}" class="list-group-item text-danger"
                                       data-sidebar-target="#settings" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign Out!</a>
                                       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                <div class="p-4">
                                    <div class="mb-4">
                                        <h6 class="d-flex justify-content-between">
                                            Storage
                                            <span>%25</span>
                                        </h6>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-success-gradient" role="progressbar" style="width: 40%;"
                                                 aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <hr class="mb-3">
                                    <p class="small mb-0">
                                        <a href="#">Privacy policy</a>
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item header-toggler">
                    <a href="#" class="nav-link">
                        <i data-feather="arrow-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
