
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
                        <a class="@yield('category')" href="{{ route('category') }}">
                            <span class="nav-link-icon">
                                <i data-feather="pie-chart"></i>
                            </span>
                            <span>Category</span>
                        </a>
                    </li>
                    <li>
                        <a class="@yield('subcategory')" href="{{ route('subcategory') }}">
                            <span class="nav-link-icon">
                                <i data-feather="pie-chart"></i>
                            </span>
                            <span>Subcategory</span>
                        </a>
                    </li>
                    <li>
                        <a class="@yield('product')" href="{{ route('product') }}">
                            <span class="nav-link-icon">
                                <i data-feather="pie-chart"></i>
                            </span>
                            <span>Product</span>
                        </a>
                    </li>
                    <li>
                        <a class="@yield('order')" href="{{ route('order') }}">
                            <span class="nav-link-icon">
                                <i data-feather="pie-chart"></i>
                            </span>
                            <span>Order</span>
                        </a>
                    </li>
                    <li>
                        <a class="@yield('cupon')" href="{{ route('cupon') }}">
                            <span class="nav-link-icon">
                                <i data-feather="pie-chart"></i>
                            </span>
                            <span>Cupon</span>
                        </a>
                    </li>
                    <li>
                        <a class="@yield('brand')" href="{{ route('brand') }}">
                            <span class="nav-link-icon">
                                <i data-feather="pie-chart"></i>
                            </span>
                            <span>Brand</span>
                        </a>
                    </li>
                    <li>
                        <a  href="{{ route('product') }}">
                            <span class="nav-link-icon">
                                <i data-feather="pie-chart"></i>
                            </span>
                            <span>Product</span>
                        </a>
                    </li>
                    <li>
                        <a  href="chat.html">
                    <span class="nav-link-icon">
                        <i data-feather="message-circle"></i>
                    </span>
                            <span>Chat</span>
                            <span class="badge badge-danger">5</span>
                        </a>
                    </li>
                    <li>
                        <a  href="mail.html">
                    <span class="nav-link-icon">
                        <i data-feather="mail"></i>
                    </span>
                            <span>Mail</span>
                        </a>
                    </li>
                    <li>
                        <a  href="todo-list.html">
                    <span class="nav-link-icon">
                        <i data-feather="check-square"></i>
                    </span>
                            <span>Todo List</span>
                            <span class="badge badge-warning">2</span>
                        </a>
                    </li>
                    <li>
                        <a  href="file-manager.html">
                    <span class="nav-link-icon">
                        <i data-feather="file-plus"></i>
                    </span>
                            <span>File Manager</span>
                        </a>
                    </li>
                    <li>
                        <a  href="calendar.html">
                    <span class="nav-link-icon">
                        <i data-feather="calendar"></i>
                    </span>
                            <span>Calendar</span>
                        </a>
                    </li>
                    <li>
                        <a  href="gallery.html">
                    <span class="nav-link-icon">
                        <i data-feather="image"></i>
                    </span>
                            <span>Gallery</span>
                        </a>
                    </li>
                    <li>
                        <a  href="invoice.html">
                    <span class="nav-link-icon">
                        <i data-feather="file-text"></i>
                    </span>
                            <span>Invoice</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                    <span class="nav-link-icon">
                        <i data-feather="shopping-cart"></i>
                    </span>
                            <span>E-commerce</span>
                        </a>
                        <ul>
                            <li>
                                <a  href="orders.html">Orders</a>
                            </li>
                            <li>
                                <a  href="products.html">Products</a>
                            </li>
                            <li>
                                <a  href="product-detail.html">Product Detail</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                    <span class="nav-link-icon">
                        <i data-feather="edit-3"></i>
                    </span>
                            <span>Forms</span>
                        </a>
                        <ul>
                            <li>
                                <a  href="basic-forms.html">Basic Forms</a>
                            </li>
                            <li>
                                <a  href="custom-forms.html">Custom Forms</a>
                            </li>
                            <li>
                                <a  href="advanced-forms.html">Advanced Forms</a>
                            </li>
                            <li>
                                <a  href="form-validation.html">Form Validation</a>
                            </li>
                            <li>
                                <a  href="form-wizard.html">Form Wizard</a>
                            </li>

                            <li>
                                <a  href="form-repeater.html">Form Repeater</a>
                            </li>
                            <li>
                                <a  href="file-upload.html">File Upload</a>
                            </li>
                            <li>
                                <a  href="ckeditor.html">CKEditor</a>
                            </li>
                            <li>
                                <a  href="datepicker.html">Datepicker</a>
                            </li>
                            <li>
                                <a  href="timepicker.html">Timepicker</a>
                            </li>
                            <li>
                                <a  href="colorpicker.html">Colorpicker</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                    <span class="nav-link-icon">
                        <i data-feather="layers"></i>
                    </span>
                            <span>Components</span>
                        </a>
                        <ul>
                            <li>
                                <a href="#">Elements</a>
                                <ul>
                                    <li>
                                        <a  href="alert.html">Alerts</a>
                                    </li>
                                    <li>
                                        <a  href="accordion.html">Accordion</a>
                                    </li>
                                    <li>
                                        <a  href="buttons.html">Buttons</a>
                                    </li>
                                    <li>
                                        <a  href="dropdown.html">Dropdown</a>
                                    </li>
                                    <li>
                                        <a  href="list-group.html">List Group</a>
                                    </li>
                                    <li>
                                        <a  href="pagination.html">Pagination</a>
                                    </li>
                                    <li>
                                        <a  href="typography.html">Typography</a>
                                    </li>
                                    <li>
                                        <a  href="media-object.html">Media Object</a>
                                    </li>
                                    <li>
                                        <a  href="progress.html">Progress</a>
                                    </li>
                                    <li>
                                        <a  href="modal.html">Modal</a>
                                    </li>
                                    <li>
                                        <a  href="spinners.html">Spinners</a>
                                    </li>
                                    <li>
                                        <a  href="navs.html">Navs</a>
                                    </li>
                                    <li>
                                        <a  href="tab.html">Tab</a>
                                    </li>
                                    <li>
                                        <a  href="tooltip.html">Tooltip</a>
                                    </li>
                                    <li>
                                        <a  href="popovers.html">Popovers</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Cards</a>
                                <ul>
                                    <li>
                                        <a  href="basic-cards.html">Basic Cards </a>
                                    </li>
                                    <li>
                                        <a  href="image-cards.html">Image Cards </a>
                                    </li>
                                    <li>
                                        <a  href="scroll-cards.html">Scroll Cards </a>
                                    </li>
                                    <li>
                                        <a  href="other-cards.html">Others Cards</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Tables</a>
                                <ul>
                                    <li>
                                        <a  href="basic-tables.html">Basic Tables</a>
                                    </li>
                                    <li>
                                        <a  href="dataTable.html">Datatable</a>
                                    </li>
                                    <li>
                                        <a  href="responsive-tables.html">Responsive Tables</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Charts</a>
                                <ul>
                                    <li>
                                        <a  href="apexchart.html">Apex Chart</a>
                                    </li>
                                    <li>
                                        <a  href="chartjs.html">Chartjs</a>
                                    </li>
                                    <li>
                                        <a  href="justgage.html">Justgage</a>
                                    </li>
                                    <li>
                                        <a  href="morsis.html">Morsis</a>
                                    </li>
                                    <li>
                                        <a  href="peity.html">Peity</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Maps</a>
                                <ul>
                                    <li>
                                        <a  href="google-map.html">Google Map</a>
                                    </li>
                                    <li>
                                        <a  href="vector-map.html">Vector Map</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a  href="avatar.html">
                                    Avatar
                                </a>
                            </li>
                            <li>
                                <a  href="icons.html">
                                    Icons
                                </a>
                            </li>
                            <li>
                                <a  href="colors.html">
                                    Colors
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                    <span class="nav-link-icon">
                        <i data-feather="gift"></i>
                    </span>
                            <span>Plugins</span>
                        </a>
                        <ul>
                            <li>
                                <a  href="sweet-alert.html">Sweet Alert</a>
                            </li>
                            <li>
                                <a  href="lightbox.html">Lightbox</a>
                            </li>
                            <li>
                                <a  href="toast.html">Toast</a>
                            </li>
                            <li>
                                <a  href="tour.html">Tour</a>
                            </li>
                            <li>
                                <a  href="slick-slide.html">Slick Slide</a>
                            </li>
                            <li>
                                <a  href="nestable.html">Nestable</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                    <span class="nav-link-icon">
                        <i data-feather="copy"></i>
                    </span>
                            <span>Pages</span>
                        </a>
                        <ul>
                            <li>
                                <a  href="profile.html">Profile</a>
                            </li>
                            <li>
                                <a  href="users.html">Users</a>
                            </li>
                            <li>
                                <a  href="settings.html">Settings</a>
                            </li>
                            <li>
                                <a href="login.html" target="_blank">Login</a>
                            </li>
                            <li>
                                <a href="register.html" target="_blank">Register</a>
                            </li>
                            <li>
                                <a href="recovery-password.html" target="_blank">Recovery Password</a>
                            </li>
                            <li>
                                <a href="lock-screen.html" target="_blank">Lock Screen</a>
                            </li>
                            <li>
                                <a  href="timeline.html">Timeline</a>
                            </li>
                            <li>
                                <a  href="pricing-table.html">Pricing Table</a>
                            </li>

                            <li>
                                <a  href="pricing-table-2.html">Pricing Table 2</a>
                            </li>
                            <li>
                                <a  href="search-result.html">Search Result</a>
                            </li>
                            <li>
                                <a href="#">Error Pages</a>
                                <ul>
                                    <li>
                                        <a href="404.html" target="_blank">404</a>
                                    </li>
                                    <li>
                                        <a href="mean-at-work.html" target="_blank">Mean at Work</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a  href="blank-page.html">Blank Page</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a  href="mailing.html">
                    <span class="nav-link-icon">
                        <i data-feather="corner-up-right"></i>
                    </span>
                            <span>Mailing</span>
                        </a>
                        <ul>
                            <li>
                                <a target="_blank" href="email-template-basic.html">Basic</a>
                            </li>
                            <li>
                                <a target="_blank" href="email-template-alert.html">Alert</a>
                            </li>
                            <li>
                                <a target="_blank" href="email-template-billing.html">Billing</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                    <span class="nav-link-icon">
                        <i data-feather="menu"></i>
                    </span>
                            <span>Menu Level</span>
                        </a>
                        <ul>
                            <li>
                                <a href="#">Menu Level</a>
                                <ul>
                                    <li>
                                        <a href="#">Menu Level </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="disabled">
                    <span class="nav-link-icon">
                        <i data-feather="mouse-pointer"></i>
                    </span>
                            <span>Disabled</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
