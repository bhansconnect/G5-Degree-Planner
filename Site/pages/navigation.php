<!-- Top of Page Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Degree Planner</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="DegreePlanner.php"><i class="fa fa-graduation-cap fa-fw"></i> Degree Plan</a>
                        </li>
                        <li><a href="MajorInfo.php"><i class="fa fa-book fa-fw"></i> Major Info</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

<!-- Sidebar -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <!-- Dashboard tab -->
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <!-- End Dashboard tab -->

                        <!-- Degree Planner tab -->
                        <li>
                            <a href="DegreePlanner.php"><i class="fa fa-list-alt fa-fw"></i> Degree Planner</a>
                        </li>
                        <!-- End Degree Planner tab -->

                        <!-- Majors tab -->
                        <li>
                            <a href="#"><i class="fa fa-book fa-fw"></i> Majors<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                              <!--- Mechanical Eng Drop Down Major --->
                              <li>
                                <a href="#">Mechanical Engineering<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                <li>
                                    <a href="MechanicalEng.php">Major Information</a>
                                </li>
                                <li>
                                    <a href="MEAdvisor.php">Academic Advisor Information</a>
                                <li>
                                </ul>
                              </li>
                              <!--- Electrical Eng Drop Down Major --->
                              <li>
                                <a href="#">Electrical Engineering<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                <li>
                                    <a href="ElectricalEng.php">Major Information</a>
                                </li>
                                <li>
                                    <a href="EEAdvisor.php">Academic Advisor Information</a>
                                <li>
                                </ul>
                              </li>
                              <!--- Comp Sci Drop Down Major --->
                              <li>
                                <a href="#">Computer Science<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                <li>
                                    <a href="ComputerScience.php">Major Information</a>
                                </li>
                                <li>
                                    <a href="CSMajorAdv.php">Academic Advisor Information</a>
                                <li>
                                </ul>
                              </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <!-- End Majors tab -->

                        <!-- Help tab -->
                        <li>
                            <a href="HelpPage.php"><i class="fa fa-question fa-fw"></i> Help</a>
                        </li>
                        <!-- End Help tab -->

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
