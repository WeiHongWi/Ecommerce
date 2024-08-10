<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="dropdown active">
          <a href="{{route('admin.dashboard')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>
        <li class="menu-header">Starter</li>
        <li class="dropdown {{ setsidebarActive([
            'admin.category.*',
            'admin.subcategory.*',
            'admin.childcategory.*'
        ])}}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Categories</span></a>
            <ul class="dropdown-menu">
              <li class="{{ setsidebarActive(['admin.category.*'])}}">
                <a class="nav-link" href="{{route('admin.category.index')}}">Category</a></li>
              <li class="{{ setsidebarActive(['admin.subcategory.*'])}}">
                <a class="nav-link" href="{{route('admin.subcategory.index')}}">Sub Category</a></li>
              <li class="{{ setsidebarActive(['admin.childcategory.*'])}}">
                <a class="nav-link" href="{{route('admin.childcategory.index')}}">Child Category</a></li>
            </ul>
          </li>
          <li class="dropdown {{ setsidebarActive([
            'admin.brand.*',
        ])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Product</span></a>
          <ul class="dropdown-menu">
            <li class="{{ setsidebarActive([
                'admin.brand.*',
            ])}}"><a class="nav-link" href="{{route('admin.brand.index')}}">Brand</a></li>
          </ul>
        </li>
        <li class="dropdown {{ setsidebarActive([
            'admin.slider.*',
        ])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Website</span></a>
          <ul class="dropdown-menu">
            <li class="{{ setsidebarActive([
                'admin.slider.*',
            ])}}"><a class="nav-link" href="{{route('admin.slider.index')}}">Slider</a></li>
          </ul>
        </li>
        {{--<li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
              <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
              <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
            </ul>
          </li>
        <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>
         --}}
      </ul>
   </aside>
</div>
