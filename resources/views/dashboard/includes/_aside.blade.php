{{-- @php
    $url = url()->current()
@endphp --}}
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" style="width: 60px;height:60px" src="{{ asset('uploads/default.png') }}" alt="User Image">
    <div>
      <p class="app-sidebar__user-name">{{  auth()->guard('admin')->user()->name }}</p>
      <p class="app-sidebar__user-designation">{{ implode(',', auth()->guard('admin')->user()->roles->pluck('name')->toArray()) }}</p>
    </div>
  </div>
  <ul class="app-menu">

    <li>
        <a class="app-menu__item active" href="{{ route('dashboard.index') }}">
            <i class="app-menu__icon fa fa-dashboard"></i>
            <span class="app-menu__label">Dashboard</span>
        </a>
    </li>

    @if(auth()->guard('admin')->user()->hasPermission('read_roles'))
      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Roles</span><i class="treeview-indicator fa fa-angle-right"></i></a>

        <ul class="treeview-menu">
          <li><a class="treeview-item" href="{{ route('dashboard.roles.index') }}"><i class="icon fa fa-circle-o"></i> All Roles </a></li>
          <li><a class="treeview-item" href="{{ route('dashboard.roles.create') }}"><i class="icon fa fa-circle-o"></i>Add New Role</a></li>
        </ul>
      </li>
    @endif

    @if(auth()->guard('admin')->user()->hasPermission('read_admins'))
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Admins</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="{{ route('dashboard.admins.index') }}"><i class="icon fa fa-circle-o"></i> All Admins </a></li>
        <li><a class="treeview-item" href="{{ route('dashboard.admins.create') }}"><i class="icon fa fa-circle-o"></i> Add New Admin</a></li>
      </ul>
    </li>
    @endif

    @if(auth()->guard('admin')->user()->hasPermission('read_users'))
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Users</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="{{ route('dashboard.users.index') }}"><i class="icon fa fa-circle-o"></i> All Users </a></li>
        <li><a class="treeview-item" href="{{ route('dashboard.users.create') }}"><i class="icon fa fa-circle-o"></i>   Add New Users    </a></li>
<li><a class="treeview-item" href="{{ route('dashboard.users.charts') }}"><i class="icon fa fa-circle-o"></i> View Users
        Charts</a></li>
      </ul>
    </li>
    @endif

    @if(auth()->guard('admin')->user()->hasPermission('read_categories'))
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Categories</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="{{ route('dashboard.categories.index') }}"><i class="icon fa fa-circle-o"></i> All Categories </a></li>
        <li><a class="treeview-item" href="{{ route('dashboard.categories.create') }}"><i class="icon fa fa-circle-o"></i> Add New Category</a></li>
      </ul>
    </li>
    @endif

    @if(auth()->guard('admin')->user()->hasPermission('read_coupons'))
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Coupons</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="{{ route('dashboard.coupons.index') }}"><i class="icon fa fa-circle-o"></i> All Coupons </a></li>
        <li><a class="treeview-item" href="{{ route('dashboard.coupons.create') }}"><i class="icon fa fa-circle-o"></i>Add New Coupone </a></li>
      </ul>
    </li>
    @endif

    @if(auth()->guard('admin')->user()->hasPermission('read_brands'))
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Brands</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="{{ route('dashboard.brands.index') }}"><i class="icon fa fa-circle-o"></i> All Brands </a></li>
        <li><a class="treeview-item" href="{{ route('dashboard.brands.create') }}"><i class="icon fa fa-circle-o"></i>  Add New Brand    </a></li>
      </ul>
    </li>
    @endif

    @if(auth()->guard('admin')->user()->hasPermission('read_products'))
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Products</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="{{ route('dashboard.products.index') }}"><i class="icon fa fa-circle-o"></i> All Products </a></li>
        <li><a class="treeview-item" href="{{ route('dashboard.products.create') }}"><i class="icon fa fa-circle-o"></i> Add New Product    </a></li>
      </ul>
    </li>
    @endif


    @if(auth()->guard('admin')->user()->hasPermission('read_banners'))
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Banners</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="{{ route('dashboard.banners.index') }}"><i class="icon fa fa-circle-o"></i> All Banners </a></li>
        <li><a class="treeview-item" href="{{ route('dashboard.banners.create') }}"><i class="icon fa fa-circle-o"></i> Add New Banner    </a></li>
      </ul>
    </li>
    @endif

    @if(auth()->guard('admin')->user()->hasPermission(['read_orders','read_orders-details']))
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">orders</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="{{ route('dashboard.viewOrders') }}"><i class="icon fa fa-circle-o"></i> All Orders</a></li>
        <li><a class="treeview-item" href="{{ route('dashboard.viewOrderCharts') }}"><i class="icon fa fa-circle-o"></i>ViewOrder Charts</a></li>
       </ul>
    </li>
    @endif

@if(auth()->guard('admin')->user()->hasPermission('read_cmsPages'))
<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
            class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Cms Pages</span><i
            class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
        <li><a class="treeview-item" href="{{ route('dashboard.cmsPages.index') }}"><i class="icon fa fa-circle-o"></i>
                All Cms Pages </a></li>
        <li><a class="treeview-item" href="{{ route('dashboard.cmsPages.create') }}"><i class="icon fa fa-circle-o"></i>
                Add CMS Page </a></li>
    </ul>
</li>
@endif



   </ul>
</aside>
