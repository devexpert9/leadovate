<div class="side_bar dark_blue scroll_auto">
	<ul id="dc_accordion" class="sidebar-menu tree">
		<li class="menu_title">Main</li>
		<li class="menu_sub">
			<a href="{{url('/')}}/admin/dashboard"> <i class="fa fa-home"></i> <span>Dashboard</span></a>
		</li>

		<li class="menu_sub">
			<a href="{{url('/')}}/admin/users"> <i class="fa fa-user"></i> <span>Users</span></a>
		</li>

		<li class="menu_sub">
			<a href="{{url('/')}}/admin/mentors"> <i class="fa fa-user-circle-o"></i> <span>Mentors</span></a>
		</li>

        <!--li class="menu_sub">
			<a href="{{url('/')}}/admin/activities"> <i class="icon-list"></i> <span>Activity Type</span></a>
		</li-->
		
		<li class="menu_sub">
			<a href="{{url('/')}}/admin/subscriptions"> <i class="fa fa-file-text-o" aria-hidden="false">
            </i> <span>Subscriptions</span></a>
		</li>
		
		<li class="menu_sub">
			<a href="#"> <i class="icon-book-open"></i> <span>Courses</span> <span class="icon-arrow-down styleicon"></span> </a>
			<ul class="down_menu">
				<li>
				    <a href="{{url('/')}}/admin/courses"><i class="icon-book-open"></i>All Courses</a>
				</li>
				<li>
					<a href="{{url('/')}}/admin/add-course"><i class="fa fa-plus-circle"></i>Add Course</a>
				</li>
			</ul>
		</li>
		
		<li class="menu_sub">
			<a href="{{url('/')}}/admin/activities"> <i class="fa fa-user-circle-o"></i> <span>Activities</span></a>
		</li>
			<li class="menu_sub">
			<a href="{{url('/')}}/admin/archives"> <i class="icon-book-open"></i> <span>Archived Course</span></a>
		</li>


		<!--li class="menu_sub">
			<a href="#"> <i class="icon-grid"></i> <span>Exercise</span> <span class="icon-arrow-down styleicon"></span> </a>
			<ul class="down_menu">
				<li>
					<a href="{{url('/')}}/admin/exercise-list"><i class="icon-list"></i>Exercise List</a>
				</li>
				<li>
					<a href="{{url('/')}}/admin/add-exercise"><i class="fa fa-plus-circle"></i>Add Exercise</a>
				</li>
			</ul>
		</li-->
		
		<li class="menu_sub">
			<a href="{{url('/')}}/admin/notifications"> <i class="fa fa-bell-o"></i> <span>Notifications</span></a>
		</li>
		
		<li class="menu_sub">
			<a href="#" @if(!empty($page))  $page=='Privacy Policy' || $page=='Terms & Conditions' || $page == 'Sociallinks') class="active" @endif  > <i class="fa fa-plus-circle"></i> <span>Manage Pages</span> <span class="icon-arrow-down styleicon"></span> </a>
			<ul class="down_menu">
				<li>
				    <a href="{{url('/')}}/admin/privacy_policy" @if(!empty($page)) @if($page=='Privacy Policy') style="color: white;" @endif @endif ><i class="fa fa-file-text-o"></i>Privacy Policy</a>
				</li>
				<li>
					<a href="{{url('/')}}/admin/terms_conditions" @if(!empty($page)) @if($page=='Terms & Conditions') style="color: white;" @endif @endif><i class="fa fa-file-text-o"></i>Terms & Conditions</a>
				</li>	
				<li>
					<a href="{{url('/')}}/admin/Social_links" @if(!empty($page)) @if($page=='Sociallinks') style="color: white;" @endif @endif><i class="fa fa-file-text-o"></i>Social Links</a>
				</li>
			</ul>
		</li>
		<!--li class="menu_sub">
			<a href="{{url('/')}}/admin/applications"> <i class="fa fa-file-text-o"></i> <span>Aplications</span></a>
		</li-->
		
	</ul>
</div>