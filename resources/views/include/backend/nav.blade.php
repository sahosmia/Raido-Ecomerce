
<div class="navigation">
            <div class="navigation-header">
                <span>Navigation</span>
                <a href="#">
                    <i class="ti-close"></i>
                </a>
            </div>
            <div class="navigation-menu-body">
                <ul>
                    <li>
                        <a  class="@yield('dashboard')"  href="{{ route('home') }}">
                            <span class="nav-link-icon">
                                <i data-feather="pie-chart"></i>
                            </span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a class="@yield('category')" href="{{ route('admin.categories.index') }}">
                            <span class="nav-link-icon">
                                <i data-feather="pie-chart"></i>
                            </span>
                            <span>Category</span>
                        </a>
                    </li>
                    <li>
                        <a class="@yield('subcategory')" href="{{ route('admin.subcategories.index') }}">
                            <span class="nav-link-icon">
                                <i data-feather="pie-chart"></i>
                            </span>
                            <span>Subcategory</span>
                        </a>
                    </li>
                    <li>
                        <a class="@yield('product')" href="{{ route('admin.products.index') }}">
                            <span class="nav-link-icon">
                                <i data-feather="pie-chart"></i>
                            </span>
                            <span>Product</span>
                        </a>
                    </li>
                    <li>
                        <a class="@yield('cupon')" href="{{ route('admin.cupons.index') }}">
                            <span class="nav-link-icon">
                                <i data-feather="pie-chart"></i>
                            </span>
                            <span>Cupon</span>
                        </a>
                    </li>
                    <li>
                        <a class="@yield('brand')" href="{{ route('admin.brands.index') }}">
                            <span class="nav-link-icon">
                                <i data-feather="pie-chart"></i>
                            </span>
                            <span>Brand</span>
                        </a>
                    </li>

                    <li>
                        <a class="@yield('message')"  href="chat.html">
                    <span class="nav-link-icon">
                        <i data-feather="message-circle"></i>
                    </span>
                            <span>Chat</span>
                            @if (App\Models\Message::where('action', 1)->count() != 0)
                            <span class="badge badge-danger">{{ App\Models\Message::where('action', 1)->count() }}</span>
                            @endif
                        </a>
                    </li>








                </ul>
            </div>
        </div>
