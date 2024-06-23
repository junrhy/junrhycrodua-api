<style type="text/css">
  .logo {
    height: 10vh;
    font-size: 12pt;
    font-weight: bolder;
    color: #cccccc;
    padding-top: 15px;
    border-bottom: 1px dashed #cccccc;
  }

  .navs, .footer {
    color: #cccccc;
    font-size: 16pt;
  }

  .footer {
    margin-top: 150px;
    border-top: 1px dashed #cccccc;
  }

  .navs a, .footer a {
    text-decoration: none;
    color: #cccccc;
  }

  .navs a:hover, .footer a:hover, #dashboard:hover, #profile:hover, #help:hover, #logout:hover {
    color: #ffffff;
    cursor: pointer;
  }

  .nav-item {
    margin-top: 15px;
  }
</style>
<div class="logo">
  <div class="">
    {{ strtoupper(Auth::guard('account')->user()->first_name) }} 
    {{ strtoupper(Auth::guard('account')->user()->last_name) }}
  </div>
  <div class=""><span>@</span>{{ Auth::guard('account')->user()->username }}</div>
</div> 
<div class="navs">
  <div class="nav-item"><i class="fa fa-chart-line"></i> <a href="/account/dashboard">Dashboard</a></div>

  <div class="nav-item"><i class="fa fa-list"></i> <a href="/account/orders">Orders</a></div>
  <div class="nav-item"><i class="fa fa-cash-register"></i> <a href="/account/sales">Sales</a></div>
  <div class="nav-item"><i class="fa fa-box"></i> <a href="/account/inventory">Inventory</a></div>
</div>
<div class="footer">
  <div class="nav-item"><i class="fa fa-user"></i> <a href="/account/profile">Profile</a></div>
  <div class="nav-item"><i class="fa fa-question"></i> <a href="/account/help">Help</a></div>
  <div class="nav-item">
    <!-- Authentication -->
    <form method="POST" action="{{ route('account.logout') }}">
        @csrf

        <a :href="route('account.logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
            <i class="fa fa-arrow-right"></i> {{ __('Log Out') }}
        </a>
    </form>
  </div>
</div>