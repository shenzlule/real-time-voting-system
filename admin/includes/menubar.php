<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
    <div class="flex items-center">
    <div class="flex justify-center items-center my-4">

  <div class="w-48 h-48 rounded-full overflow-hidden border-2 border-gray-300 shadow bg-white p-2">
    <img 
      src="<?php echo '../images/logo1.png'; ?>" 
      alt="UMU Logo" 
      class="w-full h-full object-cover"
    >
  </div>
  </div>
</div>

      <!-- <div class="pull-left info">
        <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div> -->
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu mt-[10px]" data-widget="tree">
     <!-- REPORTS Section -->
<li class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Reports</li>

<li>
  <a href="home.php" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-100 rounded">
    <i class="fas fa-chart-line text-blue-600"></i>
    <span>Dashboard Overview</span>
  </a>
</li>

<li>
  <a href="votes.php" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-100 rounded">
    <i class="fas fa-vote-yea text-green-600"></i>
    <span>Voting Results</span>
  </a>
</li>

<!-- MANAGE Section -->
<li class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider mt-4">Manage</li>

<li>
  <a href="voters.php" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-100 rounded">
    <i class="fas fa-users text-purple-600"></i>
    <span>Manage Voters</span>
  </a>
</li>

<li>
  <a href="positions.php" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-100 rounded">
    <i class="fas fa-briefcase text-yellow-500"></i>
    <span>Manage Positions</span>
  </a>
</li>

<li>
  <a href="candidates.php" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-100 rounded">
    <i class="fas fa-user-tie text-red-500"></i>
    <span>Manage Candidates</span>
  </a>
</li>

<!-- AI Section Header -->
<li class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider mt-4">AI Features</li>


<li>
  <a href="voting_bot.php" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-100 rounded">
    <i class="fas fa-chart-pie text-teal-500"></i>
    <span>AI Insights & Reports</span>
  </a>
</li>


<!-- SETTINGS Section -->
<li class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider mt-4">Settings</li>

<li>
  <a href="ballot.php" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-100 rounded">
    <i class="fas fa-ballot-check text-indigo-500"></i>
    <span>Ballot Setup</span>
  </a>
</li>

<li>
  <a href="#config" data-toggle="modal" class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-100 rounded">
    <i class="fas fa-cogs text-gray-600"></i>
    <span>Election Configuration</span>
  </a>
</li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<?php include 'config_modal.php'; ?>