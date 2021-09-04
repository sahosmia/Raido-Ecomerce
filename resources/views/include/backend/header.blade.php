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
                            <a href="#" class="nav-link" title="Actions" data-toggle="dropdown">Create</a>
                            <div class="dropdown-menu">
                                <a href="{{ route('addproduct') }}" class="dropdown-item">Add Products</a>
                                <a href="{{ route('addcategory') }}" class="dropdown-item">Add Category</a>
                                <a href="{{ route('addsubcategory') }}" class="dropdown-item">Add Subcategory</a>
                                <a href="{{ route('adduser') }}" class="dropdown-item">Add User</a>
                                <a href="{{ route('addcupon') }}" class="dropdown-item">Add Cupon</a>
                                <a href="{{ route('addbrand') }}" class="dropdown-item">Add Brand</a>

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
                            <a href="#" class="nav-link {{ App\Models\Message::where('action', 1)->count() == 0 ? "" : "nav-link-notify" }}" title="Chats" data-toggle="dropdown"><i data-feather="message-circle"></i></a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                <div
                                    class="border-bottom px-4 py-3 text-center d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Messages</h5>
                                    @php
                                        $count = App\Models\Message::where('action', 1)->count();
                                    @endphp
                                    <small class="opacity-7">{{ $count == 0 ? "All Read" : "$count unread notifications" }}</small>
                                </div>
                                <div class="dropdown-scroll">
                                    <ul class="list-group list-group-flush">
                                         @foreach (App\Models\Message::latest()->get() as $item)
                                         @php
                                            $name = $item->name;
                                            $first_latter = strtoupper(substr($name, 0,1));
                                            if($first_latter == "A" || $first_latter == "G" || $first_latter == "M" || $first_latter == "S" || $first_latter == "Y"){
                                                $color = "primary";
                                            }
                                            elseif($first_latter == "B" || $first_latter == "H" || $first_latter == "N" || $first_latter == "T" || $first_latter == "Z"){
                                                $color = "secondary";
                                            }
                                            elseif($first_latter == "C" || $first_latter == "I" || $first_latter == "O" || $first_latter == "U"){
                                                $color = "success";
                                            }
                                            elseif($first_latter == "D" || $first_latter == "J" || $first_latter == "P" || $first_latter == "V"){
                                                $color = "danger";
                                            }
                                            elseif($first_latter == "E" || $first_latter == "K" || $first_latter == "Q" || $first_latter == "W"){
                                                $color = "warning";
                                            }
                                            elseif($first_latter == "F" || $first_latter == "L" || $first_latter == "R" || $first_latter == "X"){
                                                $color = "info";
                                            }

                                        @endphp
                                        <li class="px-4 py-3 list-group-item">
                                            <a href="{{ url('message/view') }}/{{ $item->id }}" class="d-flex align-items-center hide-show-toggler">
                                                <div class="flex-shrink-0">
                                                    <figure class="avatar mr-3">
                                                        <span class="avatar-title bg-{{ $color }} rounded-circle">{{ $first_latter }}</span>
                                                    </figure>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="mb-0 line-height-20 d-flex justify-content-between">{{ $item->name }}</p>
                                                    <span class="small text-muted">
                                                    @if ($item->created_at->diffInDays() >= 30)
                                                        {{ $item->created_at->format('d M, Y') }}
                                                    @elseif ($item->created_at->diffInDays() >= 2)
                                                        {{ $item->created_at->diffForHumans() }}
                                                    @else
                                                        {{ $item->created_at->diffForHumans() }}
                                                    @endif
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                         @endforeach
                                    </ul>
                                </div>
                            </div>
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
