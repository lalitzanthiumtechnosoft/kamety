<!-- Page Content  -->
<div id="content-page" class="content-page">
<!-- TOP Nav Bar -->
<div class="iq-top-navbar">
   <div class="iq-navbar-custom">
      <div class="iq-sidebar-logo">
         <div class="top-logo">
            <a href="dashboard" class="logo">
            <!-- <img src="../assets/images/TRONLOGO.png" class="img-fluid" alt=""> -->
            <span>Digital Kamety </span>
            </a>
         </div>
      </div>
      <nav class="navbar navbar-expand-lg navbar-light p-0">
         <div class="iq-search-bar">
            <form action="javascript:void(0)" class="searchbox">
               <input type="text" class="text search-input" placeholder="Type here to search...">
               <a class="search-link" href="#"><i class="ri-search-line"></i></a>
            </form>
         </div>
         <div class="iq-menu-bt align-self-center">
            <div class="wrapper-menu">
               <div class="main-circle"><i class="ri-more-fill"></i></div>
                  <div class="hover-circle"><i class="ri-more-2-fill"></i></div>
            </div>
         </div>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-list">
               <li class="nav-item iq-full-screen">
                  <a href="#" class="iq-waves-effect" id="btnFullscreen"><i class="ri-fullscreen-line"></i></a>
               </li>
            </ul>
         </div>
         <ul class="navbar-list">
            <li>
               <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                  <img src="../assets/images/favicon.png" class="img-fluid rounded mr-3" alt="user">
                  <div class="caption">
                     <h6 class="mb-0 line-height"><?php echo $user_id; ?></h6>
                  </div>
               </a>
               <div class="iq-sub-dropdown iq-user-dropdown">
                  <div class="iq-card shadow-none m-0">
                     <div class="iq-card-body p-0 ">
                        <div class="bg-primary p-3">
                           <h5 class="mb-0 text-white line-height">Hello <?php echo $name; ?></h5>
                           <span class="text-white font-size-12"><?php echo $user_id; ?></span>
                        </div>                     
                        <a href="changePassword" class="iq-sub-card iq-bg-primary-hover">
                           <div class="media align-items-center">
                              <div class="rounded iq-card-icon iq-bg-primary">
                                 <i class="ri-lock-line"></i>
                              </div>
                              <div class="media-body ml-3">
                                 <h6 class="mb-0 ">Password Settings</h6>
                                 <p class="mb-0 font-size-12">Control your privacy parameters.</p>
                              </div>
                           </div>
                        </a>
                        <div class="d-inline-block w-100 text-center p-3">
                           <a class="bg-primary iq-sign-btn" href="signOut" role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
                        </div>
                     </div>
                  </div>
               </div>
            </li>
         </ul>
      </nav>
   </div>
</div>