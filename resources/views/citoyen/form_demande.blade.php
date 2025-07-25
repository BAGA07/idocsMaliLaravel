@extends('layouts.app')
@section('content')
<div class="container body">
    <div class="main_container">


        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Form Wizards</h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5  form-group row pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="button">Go!</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="row">

                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Form Wizards <small>Sessions</small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Settings 1</a>
                                            </li>
                                            <li><a href="#">Settings 2</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">


                                <!-- Smart Wizard -->
                                <p>This is a basic form wizard example that inherits the colors from the selected
                                    scheme.</p>
                                <div id="wizard" class="form_wizard wizard_horizontal">
                                    <ul class="wizard_steps">
                                        <li>
                                            <a href="#step-1">
                                                <span class="step_no">1</span>
                                                <span class="step_descr">
                                                    Step 1<br />
                                                    <small>Step 1 description</small>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-2">
                                                <span class="step_no">2</span>
                                                <span class="step_descr">
                                                    Step 2<br />
                                                    <small>Step 2 description</small>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-3">
                                                <span class="step_no">3</span>
                                                <span class="step_descr">
                                                    Step 3<br />
                                                    <small>Step 3 description</small>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-4">
                                                <span class="step_no">4</span>
                                                <span class="step_descr">
                                                    Step 4<br />
                                                    <small>Step 4 description</small>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div id="step-1">
                                        <form class="form-horizontal form-label-left">

                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                    for="first-name">First Name <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="first-name" required="required"
                                                        class="form-control  ">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                    for="last-name">Last Name <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="last-name" name="last-name"
                                                        required="required" class="form-control ">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="middle-name"
                                                    class="col-form-label col-md-3 col-sm-3 label-align">Middle Name
                                                    / Initial</label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input id="middle-name" class="form-control col" type="text"
                                                        name="middle-name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label
                                                    class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <div id="gender" class="btn-group" data-toggle="buttons">
                                                        <label class="btn btn-secondary" data-toggle-class="btn-primary"
                                                            data-toggle-passive-class="btn-secondary">
                                                            <input type="radio" name="gender" value="male"
                                                                class="join-btn"> &nbsp; Male &nbsp;
                                                        </label>
                                                        <label class="btn btn-primary" data-toggle-class="btn-primary"
                                                            data-toggle-passive-class="btn-secondary">
                                                            <input type="radio" name="gender" value="female"
                                                                class="join-btn"> Female
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Date Of
                                                    Birth <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input id="birthday" class="date-picker form-control"
                                                        required="required" type="text">
                                                </div>
                                            </div>

                                        </form>

                                    </div>
                                    <div id="step-2">
                                        <h2 class="StepTitle">Step 2 Content</h2>
                                        <p>
                                            do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                            ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                            aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                                            in voluptate velit esse cillum dolore eu
                                            fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                                            sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat. Duis aute irure dolor
                                            in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                            qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>
                                    <div id="step-3">
                                        <h2 class="StepTitle">Step 3 Content</h2>
                                        <p>
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                                            enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                            aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                                            in voluptate velit esse cillum dolore
                                            eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat. Duis aute irure dolor
                                            in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                            qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>
                                    <div id="step-4">
                                        <h2 class="StepTitle">Step 4 Content</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat.
                                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                            dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat. Duis aute irure dolor
                                            in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                            qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat. Duis aute irure dolor
                                            in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                            qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>

                                </div>
                                <!-- End SmartWizard Content -->





                                <h2>Example: Vertical Style</h2>
                                <!-- Tabs -->
                                <div id="wizard_verticle" class="form_wizard wizard_verticle">
                                    <ul class="list-unstyled wizard_steps">
                                        <li>
                                            <a href="#step-11">
                                                <span class="step_no">1</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-22">
                                                <span class="step_no">2</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-33">
                                                <span class="step_no">3</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-44">
                                                <span class="step_no">4</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div id="step-11">
                                        <h2 class="StepTitle">Step 1 Content</h2>
                                        <form class="form-horizontal form-label-left">

                                            <span class="section">Personal Info</span>

                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                    for="first-name">First Name <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="text" id="first-name2" required="required"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                    for="last-name">Last Name <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="text" id="last-name2" name="last-name"
                                                        required="required" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="middle-name"
                                                    class="col-form-label col-md-3 col-sm-3 label-align">Middle Name
                                                    / Initial</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input id="middle-name2" class="form-control " type="text"
                                                        name="middle-name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label
                                                    class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <div id="gender2" class="btn-group" data-toggle="buttons">
                                                        <label class="btn btn-secondary" data-toggle-class="btn-primary"
                                                            data-toggle-passive-class="btn-secondary">
                                                            <input type="radio" name="gender" value="male"
                                                                class="join-btn"> &nbsp; Male &nbsp;
                                                        </label>
                                                        <label class="btn btn-primary" data-toggle-class="btn-primary"
                                                            data-toggle-passive-class="btn-secondary">
                                                            <input type="radio" name="gender" value="female"
                                                                class="join-btn" checked=""> Female
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Date Of
                                                    Birth <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input id="birthday2" class="date-picker form-control"
                                                        required="required" type="text">
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    <div id="step-22">
                                        <h2 class="StepTitle">Step 2 Content</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat.
                                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                            dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat. Duis aute irure dolor
                                            in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                            qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat. Duis aute irure dolor
                                            in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                            qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat. Duis aute irure dolor
                                            in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                            qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat. Duis aute irure dolor
                                            in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                            qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>
                                    <div id="step-33">
                                        <h2 class="StepTitle">Step 3 Content</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat.
                                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                            dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat. Duis aute irure dolor
                                            in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                            qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>
                                    <div id="step-44">
                                        <h2 class="StepTitle">Step 4 Content</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat.
                                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                            dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat. Duis aute irure dolor
                                            in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                            qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat. Duis aute irure dolor
                                            in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                            qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>
                                </div>
                                <!-- End SmartWizard Content -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection