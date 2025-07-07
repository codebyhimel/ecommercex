<!-- start: sidebar -->
<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-toggle d-none d-md-flex" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">

                <ul class="nav nav-main">
                    <li>
                        <a class="nav-link" href="dashboard.php">
                            <i class="bx bx-home-alt" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-parent ">
                        <a class="nav-link" href="#">
                            <i class="fa fa-sliders" aria-hidden="true"></i>
                            <span>Slider</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a class="nav-link" href="SliderIndex.php">
                                    - Slider List
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="sliderCreate.php">
                                    - Create Slider
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-parent  ">
                        <a class="nav-link" href="#">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <span>Featured</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a class="nav-link" href="featureIndex.php">
                                    - Featured List
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="featureCreate.php">
                                    - Create Featured
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-parent  ">
                        <a class="nav-link" href="#">
                            <i class="fa fa-briefcase" aria-hidden="true"></i>
                            <span>Brand</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a class="nav-link" href="brandIndex.php">
                                    - Brand List
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="brandCreate.php">
                                    - Create Brand
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-parent  ">
                        <a class="nav-link" href="#">
                            <i class="fa fa-list" aria-hidden="true"></i>
                            <span>Category</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a class="nav-link" href="categoryIndex.php">
                                    - Category List
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="createCategory.php">
                                    - Create Category
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-parent ">
                        <a class="nav-link" href="#">
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <span>Attribute</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a class="nav-link" href="attributeList.php">
                                    - Attribute List
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="attributeCreate.php">
                                    - Create Attribute
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-parent ">
                        <a class="nav-link" href="#">
                            <i class="fa fa-cube" aria-hidden="true"></i>
                            <span>Products</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a class="nav-link" href="productsList.php">
                                    - Products List
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="addproducts.php">
                                    - Create Product
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-parent ">
                        <a class="nav-link" href="#">
                            <i class="fa fa-newspaper" aria-hidden="true"></i>
                            <span>Blog</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a class="nav-link" href="">
                                    - Blog List
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="">
                                    - Create Blog
                                </a>
                            </li>

                        </ul>
                    </li>
                    <!-- <li>
                        <a class="nav-link" href="sliderCreate.php">
                            <i class="bx bx-home-alt" aria-hidden="true"></i>
                            <span>Slider Create</span>
                        </a>
                    </li> -->

                </ul>
            </nav>

            <hr class="separator" />

        </div>

        <script>
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                    sidebarLeft.scrollTop = initialPosition;
                }
            }
        </script>

    </div>

</aside>
<!-- end: sidebar -->