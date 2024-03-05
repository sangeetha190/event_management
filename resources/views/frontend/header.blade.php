<!-- header section strats -->
<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="index.html"><img width="250" src="../frontend/images/logo.png"
                    alt="#" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages nnn <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="about.html">About</a></li>
                            <li><a href="testimonial.html">Testimonial</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="product.html">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog_list.html">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                    @auth
                        <!-- Show welcome message for authenticated users -->
                        {{-- <li class="nav-item">

                            <span class="nav-link">Welcome, {{ Auth::user()->name }}!</span>
                        </li> --}}

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="true"> <span class="nav-label">
                                    {{ Auth::user()->name }}!<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="about.html">Welcome, {{ Auth::user()->name }}!</a></li>
                                <li><a href="{{ route('frontend_login.logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @endauth

                    @guest
                        <!-- Show login and register buttons for guests -->
                        <li class="nav-item">
                            <a class="btn btn-danger" href="{{ route('frontend_login.index') }}">Login</a>
                        </li>

                        <li class="nav-item mx-2">
                            <a class="btn btn-danger" href="{{ route('frontend_register.index') }}">Register</a>
                        </li>
                    @endguest
                    <form class="form-inline">
                        <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- end header section -->
