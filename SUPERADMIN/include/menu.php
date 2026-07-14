<?php
date_default_timezone_set('Asia/Kolkata');
$query = "SELECT * from sub_admin_user_details where user_id='$_SESSION[admin_user_id]'";
$result = mysqli_query($con, $query);
if ($val1 = mysqli_fetch_array($result)) {
    $name = $val1['name'];
    $user_id = $val1['user_id'];
    $member_id = $val1['member_id'];
} ?>

<body>
   <div id="loading">
      <div id="loading-center"></div>
   </div>
   <div class="wrapper">
      <!-- Sidebar  -->
      <div class="iq-sidebar">
         <div class="iq-sidebar-logo d-flex justify-content-between">
            <a href="dashboard"> <span></span></a>
            <div class="iq-menu-bt-sidebar">
               <div class="iq-menu-bt align-self-center">
                  <div class="wrapper-menu">
                     <div class="main-circle"><i class="ri-more-fill"></i></div>
                     <div class="hover-circle"><i class="ri-more-2-fill"></i></div>
                  </div>
               </div>
            </div>
         </div>
         <div id="sidebar-scrollbar">
            <nav class="iq-sidebar-menu">
               <ul id="iq-sidebar-toggle" class="iq-menu">
                  <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Menu</span></li>
                  <li id="dashboard"><a href="dashboard" class="iq-waves-effect"><i
                           class="ri-calendar-event-fill"></i><span>Dashboard</span></a></li>
                  <li id="member">
                     <a href="#memberArea" class="iq-waves-effect collapsed" data-toggle="collapse"
                        aria-expanded="false"><i class="ri-user-add-fill"></i><span>User Management</span><i
                           class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul id="memberArea" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li id="viewMember"><a href="viewMember"><i class="fa fa-circle-o"></i> View Member</a></li>
                        <li id="searchMember"><a href="searchMember"><i class="fa fa-circle-o"></i> Search Member</a>
                        </li>
                        <li id="viewActiveMember"><a href="viewActiveMember"><i class="fa fa-circle-o"></i> View Active
                              Member</a></li>
                        <li id="viewInActiveMember"><a href="viewInActiveMember"><i class="fa fa-circle-o"></i> View
                              InActive Member</a></li>
                        <!--<li id="activeIncomeUserMember"><a href="activeIncomeUserMember"><i class="fa fa-circle-o"></i> View Active Income Member</a></li>-->
                        <!-- <li id="passiveIncomeUserMember"><a href="passiveIncomeUserMember"><i class="fa fa-circle-o"></i> View Passive Income Member</a></li> -->
                        <!--<li id="investmentHistory"><a href="investmentHistory"><i class="fa fa-circle-o"></i> Business History</a></li>-->
                        <!--<li id="paymentHistory"><a href="paymentHistory"><i class="fa fa-circle-o"></i> Online Payment Status</a></li>-->
                     </ul>
                  </li>

                  <li id="transfer">
                     <a href="#transferArea" class="iq-waves-effect collapsed" data-toggle="collapse"
                        aria-expanded="false"><i class="ri-mail-open-fill"></i><span>Fund Manager</span><i
                           class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul id="transferArea" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li id="fundRequest"><a href="fundRequest"><i class="fa fa-circle-o"></i> Fund Request
                              Details</a></li>
                        <li id="fundTransfer"><a href="fundTransfer"><i class="fa fa-circle-o"></i> Fund Transfer</a>
                        </li>
                        <li id="fundTransferHistory"><a href="fundTransferHistory"><i class="fa fa-circle-o"></i> Fund
                              Transfer History</a></li>

                        <li id="royaltyTransfer"><a href="royaltyTransfer"><i class="fa fa-circle-o"></i> Royalty Transfer</a>
                        </li>
                        <li id="royaltyTransferHistory"><a href="royaltyTransferHistory"><i class="fa fa-circle-o"></i> Royalty
                              Transfer History</a></li>

                        <li id="paymentDetailsUpdate"><a href="paymentDetailsUpdate"><i class="fa fa-circle-o"></i>
                              Payment Details Update</a></li>
                     </ul>
                  </li>
                  <li id="Team">
                     <a href="#teamArea" class="iq-waves-effect collapsed" data-toggle="collapse"
                        aria-expanded="false"><i class="ri-mail-open-fill"></i><span>Team Manager</span><i
                           class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul id="teamArea" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li id="myDirect"><a href="myDirect"><i class="fa fa-circle-o"></i> My Direct</a></li>
                        <li id="levelTeam"><a href="levelTeam"><i class="fa fa-circle-o"></i> Level Team</a></li>
                     <li id="autoPoolEntry"><a href="autoPoolEntry"><i class="fa fa-circle-o"></i> AutoPool Status</a></li>
                        <!--<li id="reEntryPool"><a href="reEntryPool"><i class="fa fa-circle-o"></i> ReEntry Pool</a></li>-->
                     </ul>
                  </li>
                  <li id="payout">
                     <a href="#payoutArea" class="iq-waves-effect collapsed" data-toggle="collapse"
                        aria-expanded="false"><i class="ri-money-dollar-circle-fill"></i><span>Withdraw</span><i
                           class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul id="payoutArea" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li id="walletWithdrawStatus"><a href="walletWithdrawStatus"><i class="fa fa-circle-o"></i>
                              Withdrawal Status </a></li>
                     </ul>
                  </li>
                  <li id="Support">
                     <a href="#supportArea" class="iq-waves-effect collapsed" data-toggle="collapse"
                        aria-expanded="false"><i class="fa fa-envelope"></i><span>Support</span><i
                           class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul id="supportArea" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li id="newSupportTicket"><a href="newSupportTicket"><i class="fa fa-circle-o"></i> New
                              Tickets</a></li>
                        <li id="supportTicket"><a href="supportTicket"><i class="fa fa-circle-o"></i> Support
                              Tickets</a></li>
                     </ul>
                  </li>
                  <!-- <li id="income">
                     <a href="#incomeArea" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="ri-money-dollar-box-fill"></i><span>Bonus</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul id="incomeArea" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li id="partnerIncome"><a href="partnerIncome"><i class="fa fa-circle-o"></i> Daily Growth</a></li>
                        <li id="levelIncome"><a href="levelIncome"><i class="fa fa-circle-o"></i> Level Bonus On Growth</a></li>
                        <li id="referralIncome"><a href="referralIncome"><i class="fa fa-circle-o"></i> Referral Income</a></li>
                     </ul>
                  </li> -->
                  <li id="wallet">
                     <a href="#walletArea" class="iq-waves-effect collapsed" data-toggle="collapse"
                        aria-expanded="false"><i class="ri-wallet-fill"></i><span>Wallet</span><i
                           class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul id="walletArea" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li id="walletOutstanding"><a href="walletOutstanding"><i class="fa fa-circle-o"></i> Wallet
                              Outstanding</a></li>
                        <!-- <li id="walletStatement"><a href="walletStatement"><i class="fa fa-circle-o"></i> Wallet Statement</a></li> -->
                     </ul>
                  </li>
                  <li id="setting">
                     <a href="#settingArea" class="iq-waves-effect collapsed" data-toggle="collapse"
                        aria-expanded="false"><i class="ri-wallet-fill"></i><span>Settings</span><i
                           class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul id="settingArea" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <!-- <li id="miscSetting"><a href="miscSetting"><i class="fa fa-circle-o"></i>Misc Setting</a></li> -->
                        <li id="popupUpdate"><a href="popupUpdate"><i class="fa fa-circle-o"></i>Popup Update</a></li>
                     </ul>
                  </li>

                  <li id="changePassword"><a href="changePassword" class="iq-waves-effect"><i
                           class="ri-lock-password-fill"></i><span>Change Password</span></a></li>
                  <li><a href="signOut" class="iq-waves-effect"><i class="ri-login-box-fill"></i><span>Sign
                           Out</span></a></li>
                  <li>
               </ul>
            </nav>
            <div class="p-3"></div>
         </div>
      </div>