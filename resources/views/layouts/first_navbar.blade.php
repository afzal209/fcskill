<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title" id="exampleModalLabel"><img src="images/FCSkillmodal.png">
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div id="msg" style="display: none;color:black"></div>
                    <div class="d-flex justify-content-center">
                        <h3 style="color:#f87b1c;">Sign In</h3>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <input type="email" class="form-control email" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <input type="password" class="form-control password" id="inputPassword3"
                                placeholder="Password">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">
                                <label class="form-check-label" for="gridCheck1">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row mb-3">
                                            <div class="col-sm-12">
                                                <a href="#">Forgot Password?</a>
                                            </div>
                                        </div> --}}
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" id="login"
                            style="background-color:#f87b1c">Login</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center" style="background-color:#f87b1c">
                <a href="javascript:void(0)" onclick="modal_open('exampleModal')">
                    <h5 style="color:aliceblue">Create an account</h5>
                </a>
            </div>
        </div>
    </div>
</div>
<!--    end of sign in button  -->
<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title" id="exampleModalLabel"><img src="images/FCSkillmodal.png"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div id="msg1" style="display: none;color:black"></div>

                    <div class="d-flex justify-content-center">
                        <h3 style="color:#f87b1c;">Free Register</h3>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <input type="text" class="form-control name_reg" id="inputEmail3" placeholder="Username">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <input type="email" class="form-control email_reg" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <input type="password" class="form-control password_reg" id="inputPassword3"
                                placeholder="Password">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <input type="password" class="form-control password_confirmation_reg" id="inputPassword3"
                                placeholder="Confirm
                              Password">
                        </div>
                    </div>
                    <fieldset class="row mb-3">
                        <div class="col-sm-12">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1"
                                    value="1" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    Forex Signals
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2"
                                    value="0">
                                <label class="form-check-label" for="gridRadios2">
                                    Crypto Signals
                                </label>
                            </div>
                            <div class="form-check disabled">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3"
                                    value="2">
                                <label class="form-check-label" for="gridRadios3">
                                    Both Signals
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">
                                <label class="form-check-label" for="gridCheck1">
                                    I agree to the <a href="#">Privacy Policy &
                                        Terms and Conditions</a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            Already have an account? <a href="javascript:void(0)"
                                onclick="modal_open('exampleModal1')">Sign in</a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" style="background-color:#f87b1c"
                            id="register">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End-->
<div class="container-fluid bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0);" id="logo_main"><img
                    src="{{ asset('images/250px-and-100px(1).png') }}" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>

                <!-- <i class="fa fa-bars" aria-hidden="true" style="color:goldenrod"></i>-->
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">
                            <font color="white" style="font-size:20px">Home</font>
                        </a>
                    </li>
                    <li id="nav_signal" class="nav-item">
                        <a class="nav-link" href="javascript::void(0)" onclick="signal_page();">
                            <font color="white" style="font-size:20px">Signals</font><span class="label label-pill label-danger count" style="border-radius:10px;"></span><span class="badge" ></span> 
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="chart-web">
                            <font color="white" style="font-size:20px">Chart</font>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="news-calander">
                            <font color="white" style="font-size:20px">News Calendar</font>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="trading-session">
                            <font color="white" style="font-size:20px">Trading Session</font>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="daily-news">
                            <font color="white" style="font-size:20px">News</font>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <font color="white" style="font-size:20px">
                                Brokers Ranking
                            </font>
                        </a>
                        <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="forex-brokers-ranking">
                                    <font color="white">Forex
                                        Broker Ranking</font>
                                </a></li>
                            <li><a class="dropdown-item" href="crypto-brokers-ranking">
                                    <font color="white">Crypto
                                        Broker Ranking</font>
                                </a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <button class="btn mr-2 after_login" type="button" data-bs-toggle="modal"
                        data-bs-target="#exampleModal"
                        style="background: white; border:
                1px solid #f87b1c; color: black;display:none">Sign
                        in</button>
                    <button class="btn mr-2 after_logout" type="button"
                        style="background: white; border:
                1px solid #f87b1c; color: black;display:none">Logout</button>




                    <button class="btn button-top after_register" type="button" data-bs-toggle="modal"
                        data-bs-target="#exampleModal1"
                        style="background: #f87b1c; border: 1px solid #f87b1c;
                color:white;display:none">Free
                        Register</button>

                    <!--register button-->

                </form>
            </div>
        </div>
    </nav>
</div>
